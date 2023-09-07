<?php

namespace App\Http\Controllers\Backend\Website;

use App\Http\Controllers\Controller;
use App\Model\ResultPublishedDate;
use Illuminate\Http\Request;

class PublishedDateController extends Controller
{
    public function show()
    {
        $published_date = ResultPublishedDate::all();
        return view('backend.website.result_published_date.view_date', compact('published_date'));
    }

    public function edit($id)
    {
        $published_date = ResultPublishedDate::find($id);
        return view('backend.website.result_published_date.edit_date', compact('published_date'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
           'published_date' => 'required'
        ]);

        $published_date = ResultPublishedDate::find($id);
        $published_date->published_date = date('Y-m-d', strtotime($request->published_date));
        $published_date->save();
        $notification=array(
            'messege' => "Date Updated Successfully",
            'alert-type' => 'success'
        );
        return redirect()->route('view.date')->with($notification);
    }
}
