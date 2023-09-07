<?php

namespace App\Http\Controllers\Backend\Website;

use App\Http\Controllers\Controller;
use App\Model\Slider;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class SliderController extends Controller
{
    public function show()
    {
        $slider = Slider::all();
        return view('backend.website.slider.view_slider', compact('slider'));
    }

    public function edit($id)
    {
        $slider = Slider::find($id);
        return view('backend.website.slider.edit_slider', compact('slider'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'image' => 'mimes:jpeg,jpg,png,PNG|max:10000',
        ]);

        $slider = Slider::find($id);
        $image = $request->file('image');
        if($image){
            $image_name = hexdec(uniqid());
            $ext = strtolower($image->getClientOriginalExtension());
            $image_fill_name = $image_name . '.' . $ext;
            $upload_path = 'public/backend/upload/slider/';
            $image_url = $upload_path . $image_fill_name;
            Image::make($image)->resize(1920, 1200)->save($image_url);
            if (file_exists($slider->image)) {
                $done = unlink($slider->image);
            }
            $slider->image = $image_url;
        }

        $slider->save();

        $notification=array(
            'messege' => "Slider Updated Successfully",
            'alert-type' => 'success'
        );
        return redirect()->route('view.slider')->with($notification);
    }
}
