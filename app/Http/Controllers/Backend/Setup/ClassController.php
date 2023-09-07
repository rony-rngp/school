<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Http\Controllers\Controller;
use App\Model\StudentClass;
use Illuminate\Http\Request;

class ClassController extends Controller
{
    public function show()
    {
        $classes = StudentClass::all();
        return view('backend.setup.class.view_class', compact('classes'));
    }

    public function add()
    {
        return view('backend.setup.class.add_class');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:student_classes'
        ]);

        $class = new StudentClass();
        $class->name = $request->name;
        $class->save();
        $notification=array(
            'messege' => 'Class Added Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('view.class')->with($notification);
    }

    public function edit($id)
    {
        $class = StudentClass::find($id);
        return view('backend.setup.class.edit_class', compact('class'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required'
        ]);

        $class = StudentClass::find($id);
        if($request->name != $class->name){
            $this->validate($request, [
                'name' => 'required|unique:student_classes'
            ]);
        }

        $class->name = $request->name;
        $class->save();
        $notification=array(
            'messege' => 'Class Updated Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('view.class')->with($notification);
    }

    public function destroy($id)
    {
        StudentClass::find($id)->delete();
        $notification=array(
            'messege' => 'Class Deleted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('view.class')->with($notification);
    }
}
