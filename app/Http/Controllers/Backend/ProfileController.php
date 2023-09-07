<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function show()
    {
        $id = Auth::user()->id;
        $user = User::find($id);
        return view('backend.users.view_profile', compact('user'));
    }

    public function edit($id)
    {
        $edit_user = User::find($id);
        return view('backend.users.edit_profile', compact('edit_user'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|min:3|max:30',
            'email' => 'required',
            'image' => 'mimes:jpeg,jpg,png,PNG | max:1000',
        ]);

        $edit_user = User::find($id);

        if ($edit_user->email != $request->email) {
            $validatedData = $request->validate([
                'email' => 'unique:users',
            ]);
        }

        if($request->mobile){
            if ($edit_user->mobile != $request->mobile) {
                $validatedData = $request->validate([
                    'mobile' => 'unique:users',
                ]);
            }
        }

        $edit_user->name = $request->name;
        $edit_user->email = $request->email;
        $edit_user->mobile = $request->mobile;
        $edit_user->address = $request->address;
        $edit_user->gender = $request->gender;

        $image = $request->file('image');

        if($image){
            $image_name = hexdec(uniqid());
            $ext = strtolower($image->getClientOriginalExtension());
            $image_fill_name = $image_name . '.' . $ext;
            $upload_path = 'public/backend/upload/users/';
            $image_url = $upload_path . $image_fill_name;
            $success = $image->move($upload_path, $image_fill_name);

            if($success){
                $edit_user->image = $image_url;
                $img = User::find($id);
                if (file_exists($img->image)) {
                    $done = unlink($img->image);
                }
            }else{
                return redirect()->back();
            }
        }

        $save = $edit_user->save();
        if($save){
            $notification = array(
                'messege' => "Profile Updated Successfully",
                'alert-type' => 'success'
            );
            return redirect()->route('view.profile')->with($notification);
        }else{
            $notification = array(
                'messege' => "Something Went to Wrong",
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }
    }

    public function show_password()
    {
        return view('backend.users.edit_password');
    }

    public function update_password(Request $request)
    {
        $this->validate($request, [
            'current_password' => 'required',
            'new_password' => 'required|min:8|max:32',
            'passwordd' => 'required|min:8|max:32',
        ]);

        $hashpassword = Auth::user()->password;
        if($request->new_password == $request->passwordd){
            if(Hash::check($request->current_password, $hashpassword)){
                if(!Hash::check($request->passwordd, $hashpassword)){
                    $user = User::find(Auth::user()->id);
                    $user->password = Hash::make($request->passwordd);
                    $user->save();
                    $notification = array(
                        'messege' => "Password Successfully Changed!",
                        'alert-type' => 'success'
                    );
                    Auth::logout();
                    return redirect()->back()->with($notification);
                }else{
                    $notification = array(
                        'messege' => "Sorry ! New password connot be same as old password!",
                        'alert-type' => 'error'
                    );
                    return redirect()->back()->with($notification);
                }
            }else{
                $notification = array(
                    'messege' => "Sorry ! Your Current Password is Wrong",
                    'alert-type' => 'error'
                );
                return redirect()->back()->with($notification);
            }
        }else{
            $notification = array(
                'messege' => "Password Don't Match",
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }
    }
}
