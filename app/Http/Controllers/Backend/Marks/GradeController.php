<?php

namespace App\Http\Controllers\Backend\Marks;

use App\Http\Controllers\Controller;
use App\Model\MarksGrade;
use Illuminate\Http\Request;

class GradeController extends Controller
{
    public function show()
    {
        $grade = MarksGrade::all();
        return view('backend.marks.view_grade', compact('grade'));
    }

    public function add()
    {
        return view('backend.marks.add_grade');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'grade_name' => 'required',
            'grade_point' => 'required',
            'start_marks' => 'required',
            'end_marks' => 'required',
            'start_point' => 'required',
            'end_point' => 'required',
            'remarks' => 'required',
        ]);
        $data = new MarksGrade();
        $data->grade_name = $request->grade_name;
        $data->grade_point = $request->grade_point;
        $data->start_marks = $request->start_marks;
        $data->end_marks = $request->end_marks;
        $data->start_point = $request->start_point;
        $data->end_point = $request->end_point;
        $data->remarks = $request->remarks;
        $data->save();

        $notification = array(
            'messege' => "Grade Points Added Successfully",
            'alert-type' => 'success'
        );
        return redirect()->route('view.grade')->with($notification);
    }

    public function edit($id)
    {
        $data = MarksGrade::find($id);
        return view('backend.marks.edit_grade', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'grade_name' => 'required',
            'grade_point' => 'required',
            'start_marks' => 'required',
            'end_marks' => 'required',
            'start_point' => 'required',
            'end_point' => 'required',
            'remarks' => 'required',
        ]);
        $data = MarksGrade::find($id);
        $data->grade_name = $request->grade_name;
        $data->grade_point = $request->grade_point;
        $data->start_marks = $request->start_marks;
        $data->end_marks = $request->end_marks;
        $data->start_point = $request->start_point;
        $data->end_point = $request->end_point;
        $data->remarks = $request->remarks;
        $data->save();

        $notification = array(
            'messege' => "Grade Points Updated Successfully",
            'alert-type' => 'success'
        );
        return redirect()->route('view.grade')->with($notification);
    }
}
