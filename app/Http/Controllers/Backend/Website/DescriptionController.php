<?php

namespace App\Http\Controllers\Backend\Website;

use App\Http\Controllers\Controller;
use App\Model\Designation;
use App\Model\MainDescription;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class DescriptionController extends Controller
{
    public function show()
    {
        $descriptions = MainDescription::all();
        return view('backend.website.main_description.view_description', compact('descriptions'));
    }

    public function edit($id)
    {
        $description = MainDescription::find($id);
        return view('backend.website.main_description.edit_description', compact('description'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required',
            'body' => 'required|min:15',
            'image' => 'mimes:jpeg,jpg,png,PNG|max:1000',
        ]);

        $description = MainDescription::find($id);
        $description->title = $request->title;
        $description->body = $request->body;
        $description->title = $request->title;
        $image = $request->file('image');
        if($image){
            $image_name = hexdec(uniqid());
            $ext = strtolower($image->getClientOriginalExtension());
            $image_fill_name = $image_name . '.' . $ext;
            $upload_path = 'public/backend/upload/main_description/';
            $image_url = $upload_path . $image_fill_name;
            Image::make($image)->resize(445, 278)->save($image_url);
            if (file_exists($description->image)) {
                $done = unlink($description->image);
            }
            $description->image = $image_url;
        }

        $description->save();
        $notification=array(
            'messege' => "Main Description Updated Successfully",
            'alert-type' => 'success'
        );
        return redirect()->route('view.description')->with($notification);
    }
}
