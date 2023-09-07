<?php

namespace App\Http\Controllers\Backend\Report;

use App\Http\Controllers\Controller;
use App\Model\AssignSubject;
use App\Model\ExamType;
use App\Model\StudentClass;
use App\Model\StudentMarks;
use App\Model\Year;
use Illuminate\Http\Request;
use niklasravnsborg\LaravelPdf\Facades\Pdf;
use DB;

class ResultController extends Controller
{
    public function show()
    {
        $data['classes'] = StudentClass::all();
        $data['years'] = Year::latest()->get();
        $data['exam_type'] = ExamType::all();
        return view('backend.report.student_result.view_result', $data);
    }

    public function get_result(Request $request)
    {
        $year_id = $request->year_id;
        $class_id = $request->class_id;
        $exam_type_id = $request->exam_type_id;

        $total_assign_subject = AssignSubject::where('class_id', $class_id)->count();

        $single_result = StudentMarks::where('year_id', $year_id)->where('class_id', $class_id)->where('exam_type_id', $exam_type_id)->first();
        if ($single_result == true){
            $dt = StudentMarks::where('year_id', $year_id)->where('class_id', $class_id)
                ->where('exam_type_id', $exam_type_id)
                ->select([DB::raw("SUM(total_marks) as total_marks"), 'year_id', 'class_id','exam_type_id', 'student_id'])
                ->groupBy('student_id','year_id', 'class_id', 'exam_type_id')
                ->get();

            $student_data = array();

            foreach ($dt as $key=> $r_dta){
                $total_fail = 0;
                $total_point = 0;
                $std_marks = StudentMarks::with('user:id,name,id_no')->where('year_id', $year_id)->where('class_id', $class_id)
                    ->where('exam_type_id', $exam_type_id)
                    ->where('student_id', $r_dta->student_id)
                    ->get();
                foreach ($std_marks as $value){
                    if($value->assign_subject->full_mark == '100'){
                        $count_fails = \App\Model\StudentMarks::where('year_id', $value->year_id)->where('class_id', $value->class_id)->where('exam_type_id', $value->exam_type_id)->where('student_id', $value->student_id)->where('assign_subject_id', $value->assign_subject->id)->where('total_marks', '<', '40')->count();
                    }elseif ($value->assign_subject->full_mark == '50'){
                        $count_fails = \App\Model\StudentMarks::where('year_id', $value->year_id)->where('class_id', $value->class_id)->where('exam_type_id', $value->exam_type_id)->where('student_id', $value->student_id)->where('assign_subject_id', $value->assign_subject->id)->where('total_marks', '<', '20')->count();
                    }elseif ($value->assign_subject->full_mark == '25'){
                        $count_fails = \App\Model\StudentMarks::where('year_id', $value->year_id)->where('class_id', $value->class_id)->where('exam_type_id', $value->exam_type_id)->where('student_id', $value->student_id)->where('assign_subject_id', $value->assign_subject->id)->where('total_marks', '<', '10')->count();
                    }
                    $total_fail += $count_fails;

                    $get_mark = $value->total_marks;
                    if($value->assign_subject->full_mark == 100){
                        $grade_marks = \App\Model\MarksGrade::where([['start_marks', '<=', (int)$get_mark], ['end_marks', '>=', (int)$get_mark]])->first();
                    }elseif($value->assign_subject->full_mark == 50){
                        $grade_marks = \App\Model\MarksGrade::where([['start_marks', '<=', (int)$get_mark*2], ['end_marks', '>=', (int)$get_mark*2]])->first();
                    }elseif($value->assign_subject->full_mark == 25){
                        $grade_marks = \App\Model\MarksGrade::where([['start_marks', '<=', (int)$get_mark*4], ['end_marks', '>=', (int)$get_mark*4]])->first();
                    }

                    $grade_name = $grade_marks->grade_name;
                    $grade_point = number_format((float)$grade_marks->grade_point, 2);
                    $total_point = (float)$total_point + $grade_point;
                }

                $total_subject = $std_marks->count();

                if ($total_fail > 0 || ($total_assign_subject != $total_subject )){
                    $grade_point_average = 0;
                }else{
                    $grade_point_average = (float)$total_point/(float)$total_subject;
                }
                $grade_point_info = \App\Model\MarksGrade::where([['start_point', '<=', $grade_point_average], ['end_point', '>=', $grade_point_average]])->first();

                $student_data[$key] = ['student_name'=>@$value['user']['name'],'id_no'=>@$value['user']['id_no'],'total_marks'=>$r_dta['total_marks'],'grade_point' => $grade_point_average, 'grade_name' => @$grade_point_info->grade_name, 'remarks' => @$grade_point_info->remarks, 'total_fail'=>$total_fail];
            }

            $pass_students =  collect($student_data)->where('total_fail', 0)->sortByDesc('total_marks')->all();
            $fail_students =  collect($student_data)->where('total_fail', '>',0)->sortByDesc('total_marks')->all();
            $data['final_data'] = collect($pass_students)->merge($fail_students);
            $data['session'] = @$dt[0]['year']['name'];
            $data['class'] = @$dt[0]['class']['name'];
            $data['exam'] = @$dt[0]['exam_type']['name'];

            $pdf = PDF::loadView('backend.report.student_result.result_pdf_update', $data,[ 'format' => 'a4']);
            return $pdf->stream('result.pdf');
        }else{
            $notification = array(
                'messege' => "Sorry ! These criteria does not match",
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }

    }

    // public function get_result(Request $request)
    // {
    //     $year_id = $request->year_id;
    //     $class_id = $request->class_id;
    //     $exam_type_id = $request->exam_type_id;

    //     $data['assign_subject'] = AssignSubject::where('class_id', $class_id)->count();
    //     $single_result = StudentMarks::where('year_id', $year_id)->where('class_id', $class_id)->where('exam_type_id', $exam_type_id)->first();
    //     if ($single_result == true){
    //         $data['all_data'] = StudentMarks::select('year_id', 'class_id', 'student_id', 'exam_type_id')->where('year_id', $year_id)->where('class_id', $class_id)->where('exam_type_id', $exam_type_id)
    //             ->groupBy('year_id')
    //             ->groupBy('class_id')
    //             ->groupBy('student_id')
    //             ->groupBy('exam_type_id')
    //             ->get();


    //         $pdf = PDF::loadView('backend.report.student_result.result_pdf', $data);
    //         return $pdf->stream('document.pdf');
    //     }else{
    //         $notification = array(
    //             'messege' => "Sorry ! These criteria does not match",
    //             'alert-type' => 'error'
    //         );
    //         return redirect()->back()->with($notification);
    //     }
    // }
}
