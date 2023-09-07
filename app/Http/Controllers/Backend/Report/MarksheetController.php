<?php

namespace App\Http\Controllers\Backend\Report;

use App\Http\Controllers\Controller;
use App\Model\AssignSubject;
use App\Model\ExamType;
use App\Model\MarksGrade;
use App\Model\StudentClass;
use App\Model\StudentMarks;
use App\Model\Year;
use Illuminate\Http\Request;

class MarksheetController extends Controller
{
    public function show()
    {
        $data['classes'] = StudentClass::all();
        $data['years'] = Year::latest()->get();
        $data['exam_type'] = ExamType::all();
        return view('backend.report.marksheet.view_marksheet', $data);
    }

    public function get_marksheet(Request $request)
    {
        $year_id = $request->year_id;
        $class_id = $request->class_id;
        $exam_type_id = $request->exam_type_id;
        $id_no = $request->id_no;

        $data['assign_subject'] = AssignSubject::where('class_id', $class_id)->count();



        $check_datass = StudentMarks::with('assign_subject')->where('year_id', $year_id)->where('class_id', $class_id)->where('exam_type_id', $exam_type_id)->where('id_no', $id_no)->get();
        $total_fail = 0;
        foreach ($check_datass as $dt){
             $dt->assign_subject->full_mark;

            if($dt->assign_subject->full_mark == '100'){
                $count_fails = StudentMarks::where('year_id', $year_id)->where('class_id', $class_id)->where('exam_type_id', $exam_type_id)->where('id_no', $id_no)->where('assign_subject_id', $dt->assign_subject->id)->where('total_marks', '<', '40')->count();
            }elseif ($dt->assign_subject->full_mark == '50'){
                $count_fails = StudentMarks::where('year_id', $year_id)->where('class_id', $class_id)->where('exam_type_id', $exam_type_id)->where('id_no', $id_no)->where('assign_subject_id', $dt->assign_subject->id)->where('total_marks', '<', '20')->count();
            }elseif ($dt->assign_subject->full_mark == '25'){
                $count_fails = StudentMarks::where('year_id', $year_id)->where('class_id', $class_id)->where('exam_type_id', $exam_type_id)->where('id_no', $id_no)->where('assign_subject_id', $dt->assign_subject->id)->where('total_marks', '<', '10')->count();
            }
            $data['count_fail'] =  $total_fail += $count_fails;
        }




        $check_data = StudentMarks::where('year_id', $year_id)->where('class_id', $class_id)->where('exam_type_id', $exam_type_id)->where('id_no', $id_no)->first();
        if ($check_data == true){
            $data['all_marks'] = StudentMarks::where('year_id', $year_id)->where('class_id', $class_id)->where('exam_type_id', $exam_type_id)->where('id_no', $id_no)->get();
            $data['all_greades'] = MarksGrade::all();

            return view('backend.report.marksheet.marksheet_pdf', $data);
        }else{
            $notification=array(
                'messege' => "Sorry ! These criteria does not match",
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }
    }
}
