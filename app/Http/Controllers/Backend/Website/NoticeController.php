<?php

namespace App\Http\Controllers\Backend\Website;

use App\Http\Controllers\Controller;
use App\Model\MainDescription;
use App\Model\Notice;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class NoticeController extends Controller
{
    public function show()
    {
        $notices = Notice::OrderBy('id', 'desc')->get();
        return view('backend.website.notice.view_notice', compact('notices'));
    }

    public function add()
    {
        return view('backend.website.notice.add_notice');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'body' => 'required|min:15',
            'image' => 'mimes:jpeg,jpg,png,PNG|max:5000',
        ]);

        $notice = new Notice();
        $notice->title = $request->title;
        $notice->slug = Str::slug($request->title);
        $notice->body = $request->body;
        $notice->title = $request->title;
        $image = $request->file('image');
        if($image){
            $image_name = hexdec(uniqid());
            $ext = strtolower($image->getClientOriginalExtension());
            $image_fill_name = $image_name . '.' . $ext;
            $upload_path = 'public/backend/upload/notice/';
            $image_url = $upload_path . $image_fill_name;
            Image::make($image)->resize(1000, 667)->save($image_url);
            $notice->image = $image_url;
        }

        $notice->save();
        $notification=array(
            'messege' => "Notice Added Successfully",
            'alert-type' => 'success'
        );
        return redirect()->route('view.notice')->with($notification);
    }

    public function edit($id)
    {
        $notice = Notice::find($id);
        return view('backend.website.notice.edit_notice', compact('notice'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required',
            'body' => 'required|min:15',
            'image' => 'mimes:jpeg,jpg,png,PNG|max:2000',
        ]);

        $notice = Notice::find($id);
        $notice->title = $request->title;
        $notice->slug = Str::slug($request->title);
        $notice->body = $request->body;
        $notice->title = $request->title;
        $image = $request->file('image');
        if($image){
            $image_name = hexdec(uniqid());
            $ext = strtolower($image->getClientOriginalExtension());
            $image_fill_name = $image_name . '.' . $ext;
            $upload_path = 'public/backend/upload/notice/';
            $image_url = $upload_path . $image_fill_name;
            Image::make($image)->resize(1000, 667)->save($image_url);
            if(file_exists($notice->image)){
                unlink($notice->image);
            }
            $notice->image = $image_url;
        }

        $notice->save();
        $notification=array(
            'messege' => "Notice Updated Successfully",
            'alert-type' => 'success'
        );
        return redirect()->route('view.notice')->with($notification);
    }

    public function destroy($id)
    {
        $notice = Notice::find($id);
        if(!empty($notice->image)){
            unlink($notice->image);
        }
        $notice->delete();
        $notification=array(
            'messege' => "Notice Deleted Successfully",
            'alert-type' => 'success'
        );
        return redirect()->route('view.notice')->with($notification);
    }
}
