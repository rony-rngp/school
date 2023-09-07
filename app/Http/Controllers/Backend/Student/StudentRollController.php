<?php

namespace App\Http\Controllers\Backend\Student;

use App\Http\Controllers\Controller;
use App\Model\AssignStudent;
use App\Model\StudentClass;
use App\Model\Year;
use Illuminate\Http\Request;

class StudentRollController extends Controller
{
    public function show()
    {
        $data['class']= StudentClass::orderBy('id', 'asc')->get();
        $data['year']= Year::orderBy('id', 'desc')->get();
        return view('backend.student.student_roll.view_roll', $data);
    }

    public function get_student(Request $request){
        $get_student = AssignStudent::with('user')->where('year_id', $request->year_id)->where('class_id', $request->class_id)->orderBy('roll', 'ASC')->get();
        return response()->json($get_student);
    }

    public function store(Request $request){

        $year_id = $request->year_id;
        $class_id = $request->class_id;
        if($request->id != NULL){
            for ($i=0; $i<count($request->id); $i++){
                $student_id = AssignStudent::where('id', $request->id[$i])->first()->student_id;
                AssignStudent::where('id', $request->id[$i])->where('class_id', $class_id)->where('year_id', $year_id)->where('student_id', $student_id)->update(['roll' => $request->roll[$i]]);
            }

            $notification=array(
                'messege' => "Well done !  Roll Generate Successfully",
                'alert-type' => 'success'
            );
            return redirect()->route('view.student.roll')->with($notification);
        }else{
            $notification=array(
                'messege' => "Sorry ! There are no student",
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }


    }
}
