<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Http\Controllers\Controller;
use App\Model\Year;
use Illuminate\Http\Request;

class YearController extends Controller
{
    public function show()
    {
        $years = Year::latest()->get();
        return view('backend.setup.year.view_year', compact('years'));
    }

    public function add()
    {
        return view('backend.setup.year.add_year');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:years'
        ]);

        $class = new Year();
        $class->name = $request->name;
        $class->save();
        $notification=array(
            'messege' => 'Year Added Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('view.year')->with($notification);
    }

    public function edit($id)
    {
        $year = Year::find($id);
        return view('backend.setup.year.edit_year', compact('year'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required'
        ]);

        $year = Year::find($id);
        if($request->name != $year->name){
            $this->validate($request, [
                'name' => 'required|unique:years'
            ]);
        }

        $year->name = $request->name;
        $year->save();
        $notification=array(
            'messege' => 'Year Updated Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('view.year')->with($notification);
    }

    public function destroy($id)
    {
        Year::find($id)->delete();
        $notification=array(
            'messege' => 'Year Deleted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('view.year')->with($notification);
    }
}
