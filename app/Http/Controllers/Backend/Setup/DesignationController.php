<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Http\Controllers\Controller;
use App\Model\Designation;
use Illuminate\Http\Request;

class DesignationController extends Controller
{
    public function show()
    {
        $designations = Designation::all();
        return view('backend.setup.designation.view_designation', compact('designations'));
    }

    public function add()
    {
        return view('backend.setup.designation.add_designation');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:designations'
        ]);

        $designation = new Designation();
        $designation->name = $request->name;
        $designation->save();
        $notification=array(
            'messege' => 'Designation Added Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('view.designation')->with($notification);
    }

    public function edit($id)
    {
        $designation = Designation::find($id);
        return view('backend.setup.designation.edit_designation', compact('designation'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required'
        ]);

        $designation = Designation::find($id);
        if($request->name != $designation->name){
            $this->validate($request, [
                'name' => 'required|unique:designations'
            ]);
        }

        $designation->name = $request->name;
        $designation->save();
        $notification=array(
            'messege' => 'Designation Updated Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('view.designation')->with($notification);
    }

    public function destroy($id)
    {
        Designation::find($id)->delete();
        $notification=array(
            'messege' => 'Designation Deleted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('view.designation')->with($notification);
    }
}
