<?php

namespace App\Http\Controllers\Backend\Marks;

use App\Http\Controllers\Controller;
use App\Model\AssignStudent;
use App\Model\AssignSubject;
use App\Model\ExamType;
use App\Model\StudentClass;
use App\Model\StudentMarks;
use App\Model\Year;
use Illuminate\Http\Request;

class MarksController extends Controller
{
    public function add()
    {
        $data['class']= StudentClass::orderBy('id', 'asc')->get();
        $data['year']= Year::orderBy('id', 'desc')->get();
        $data['exam_types']= ExamType::orderBy('id', 'asc')->get();
        return view('backend.marks.add_marks', $data);
    }

    public function get_subject(Request $request)
    {
        $assign_subject = AssignSubject::with('subject')->where('class_id', $request->class_id)->get();
        return response()->json($assign_subject);
    }

    public function get_student(Request $request)
    {
        $subject_info = AssignSubject::where('id', $request->assign_subject_id)->first();
        $get_student = AssignStudent::with('user')->where('year_id', $request->year_id)->where('class_id', $request->class_id)->orderBy('roll', 'ASC')->get();
        return response()->json(['get_students'=>$get_student, 'subject_info'=>$subject_info]);
    }

    //ALTER TABLE `student_marks` ADD `other_marks` DOUBLE NULL DEFAULT NULL AFTER `marks`, ADD `total_marks` DOUBLE NULL DEFAULT NULL AFTER `other_marks`;


    public function store(Request $request)
    {
        if($request->student_id == NULL){
            $notification=array(
                'messege' => "Student Not Found",
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }

        $validatedData = $request->validate([
            'marks.*' => 'required',
            'other_marks.*' => 'required',
        ]);

        $exits_marks = StudentMarks::all();
        foreach ($exits_marks as $data) {
            if ($request->year_id == $data->year_id && $request->class_id == $data->class_id && $request->assign_subject_id == $data->assign_subject_id && $request->exam_type_id == $data->exam_type_id) {
                $notification=array(
                    'messege' => "Sorry !  Marks Already Taken",
                    'alert-type' => 'error'
                );
                return redirect()->back()->with($notification);
            }
        }

        $student_count = count($request->student_id);
        if (!empty($student_count)){
            for ($i=0; $i<$student_count; $i++){
                $total_marks = $request->marks[$i]+$request->other_marks[$i];
                $data = new StudentMarks();
                $data->year_id = $request->year_id;
                $data->class_id = $request->class_id;
                $data->assign_subject_id = $request->assign_subject_id;
                $data->exam_type_id = $request->exam_type_id;
                $data->student_id = $request->student_id[$i];
                $data->id_no = $request->id_no[$i];
                $data->marks = $request->marks[$i];
                $data->other_marks = $request->other_marks[$i];
                $data->total_marks = $total_marks;
                $data->save();
            }
        }

        $notification=array(
            'messege' => "Well done !  Marks Entry Successfully",
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    public function edit(){
        $data['class']= StudentClass::orderBy('id', 'asc')->get();
        $data['year']= Year::orderBy('id', 'desc')->get();
        $data['exam_types']= ExamType::orderBy('id', 'asc')->get();
        return view('backend.marks.edit_marks', $data);
    }

    public function get_student_marks(Request $request){
        $subject_info = AssignSubject::where('id', $request->assign_subject_id)->first();
        $student_marks = StudentMarks::with('user')->where('year_id', $request->year_id)->where('class_id', $request->class_id)->where('assign_subject_id', $request->assign_subject_id)->where('exam_type_id', $request->exam_type_id)->get();
        return response()->json(['student_marks'=>$student_marks, 'subject_info'=>$subject_info]);
    }

    public function update(Request $request)
    {
        if($request->student_id == NULL){
            $notification=array(
                'messege' => "Student Not Found",
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }

        StudentMarks::where('year_id', $request->year_id)
            ->where('class_id', $request->class_id)
            ->where('assign_subject_id', $request->assign_subject_id)
            ->where('exam_type_id', $request->exam_type_id)->delete();


        $student_count = count($request->student_id);
        if (!empty($student_count)){
            for ($i=0; $i<$student_count; $i++){

                $total_marks = $request->marks[$i]+$request->other_marks[$i];

                $data = new StudentMarks();
                $data->year_id = $request->year_id;
                $data->class_id = $request->class_id;
                $data->assign_subject_id = $request->assign_subject_id;
                $data->exam_type_id = $request->exam_type_id;
                $data->student_id = $request->student_id[$i];
                $data->id_no = $request->id_no[$i];
                $data->marks = $request->marks[$i];
                $data->other_marks = $request->other_marks[$i];
                $data->total_marks = $total_marks;
                $data->save();
            }
        }

        $notification=array(
            'messege' => "Well done !  Marks Updated Successfully",
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
}
