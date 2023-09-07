<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Http\Controllers\Controller;
use App\Model\AssignSubject;
use App\Model\StudentClass;
use App\Model\Subject;
use Illuminate\Http\Request;

class AssignSubjectController extends Controller
{
    public function show()
    {
        $assign_subjects = AssignSubject::select('class_id')->groupBy('class_id')->get();
        return view('backend.setup.assign_subject.view_assign_subject', compact('assign_subjects'));
    }

    public function add()
    {
        $data['classes'] = StudentClass::all();
        $data['subjects'] = Subject::all();
        return view('backend.setup.assign_subject.add_assign_subject', $data);
    }

    public function store(Request $request)
    {
        $count_subject = count($request->subject_id);
        if(!empty($count_subject)){
            for ($i=0; $i<$count_subject; $i++){
                $assign_subject = new AssignSubject();
                $assign_subject->class_id = $request->class_id;
                $assign_subject->subject_id = $request->subject_id[$i];
                $assign_subject->full_mark = $request->full_mark[$i];
                $assign_subject->pass_mark = $request->pass_mark[$i];
                $assign_subject->save();
            }
        }
        $notification=array(
            'messege' => "Assign Subject Added Successfully",
            'alert-type' => 'success'
        );
        return redirect()->route('view.assign.subject')->with($notification);
    }


    public function edit($class_id)
    {
        $data['edit_data'] = AssignSubject::where('class_id', $class_id)->orderBy('subject_id', 'ASC')->get();
        $data['subjects'] = Subject::all();
        $data['classes'] = StudentClass::all();
        return view('backend.setup.assign_subject.edit_assign_subject', $data);
    }

    public function update(Request $request, $class_id)
    {
        $assign_subjects = AssignSubject::where('class_id', $class_id)->get();
        foreach ($assign_subjects as $key => $assign_subject){
            $assign_subject->subject_id = $request->subject_id[$key];
            $assign_subject->full_mark = $request->full_mark[$key];
            $assign_subject->pass_mark = $request->pass_mark[$key];
            $assign_subject->save();
        }

        $notification=array(
            'messege' => "Assign Subject Updated Successfully",
            'alert-type' => 'success'
        );
        return redirect()->route('view.assign.subject')->with($notification);
    }

    public function details($class_id)
    {
        $data['details'] = AssignSubject::where('class_id', $class_id)->orderBy('subject_id', 'ASC')->get();
        return view('backend.setup.assign_subject.details_assign_subject', $data);
    }

    public function destroy($class_id)
    {
        AssignSubject::where('class_id', $class_id)->delete();
        $notification=array(
            'messege' => "Assign Subject Deleted Successfully",
            'alert-type' => 'success'
        );
        return redirect()->route('view.assign.subject')->with($notification);
    }
}
