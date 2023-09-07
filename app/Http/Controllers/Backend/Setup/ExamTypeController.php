<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\ExamType;

class ExamTypeController extends Controller
{
    public function show()
    {
    	$exam_types = ExamType::all();
    	return view('backend.setup.exam_type.view_exam_type', compact('exam_types'));
    }

    public function add()
    {
    	return view('backend.setup.exam_type.add_exam_type');
    }

    public function store(Request $request)
    {
    	$this->validate($request, [
            'name' => 'required|unique:exam_types'
        ]);

        $exam_type = new ExamType();
        $exam_type->name = $request->name;
        $exam_type->save();
        $notification=array(
            'messege' => 'Exam Added Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('view.exam')->with($notification);
    }

    public function edit($id)
    {
        $exam_type = ExamType::find($id);
        return view('backend.setup.exam_type.edit_exam_type', compact('exam_type'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required'
        ]);

        $exam_type = ExamType::find($id);
        if($request->name != $exam_type->name){
            $this->validate($request, [
                'name' => 'required|unique:exam_types'
            ]);
        }

        $exam_type->name = $request->name;
        $exam_type->save();
        $notification=array(
            'messege' => 'Exam Updated Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('view.exam')->with($notification);
    }

    public function destroy($id)
    {
        ExamType::find($id)->delete();
        $notification=array(
            'messege' => 'Exam Deleted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('view.exam')->with($notification);
    }
}
