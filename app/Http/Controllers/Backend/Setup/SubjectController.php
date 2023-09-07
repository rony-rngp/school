<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Subject;

class SubjectController extends Controller
{
    public function show()
    {
    	$subjects = Subject::all();
    	return view('backend.setup.subject.view_subject', compact('subjects'));
    }

    public function add()
    {
    	return view('backend.setup.subject.add_subject');
    }

    public function store(Request $request)
    {
    	$this->validate($request, [
            'name' => 'required|unique:subjects'
        ]);

        $subject = new Subject();
        $subject->name = $request->name;
        $subject->save();
        $notification=array(
            'messege' => 'Subject Added Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('view.subject')->with($notification);
    }

    public function edit($id)
    {
        $subject = Subject::find($id);
        return view('backend.setup.subject.edit_subject', compact('subject'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required'
        ]);

        $subject = Subject::find($id);
        if($request->name != $subject->name){
            $this->validate($request, [
                'name' => 'required|unique:subjects'
            ]);
        }

        $subject->name = $request->name;
        $subject->save();
        $notification=array(
            'messege' => 'Subject Updated Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('view.subject')->with($notification);
    }

    public function destroy($id)
    {
        Subject::find($id)->delete();
        $notification=array(
            'messege' => 'Subject Deleted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('view.subject')->with($notification);
    }
}
