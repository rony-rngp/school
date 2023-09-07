<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function show()
    {
        $users = User::where('user_type', 'Admin')->get();
        return view('backend.users.view_user', compact('users'));
    }

    public function add()
    {
        return view('backend.users.add_user');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'role' => 'required|min:3|max:30',
            'name' => 'required',
            'email' => 'required|unique:users',
        ]);

        $code = rand(0000,9999);
        $data = new User;
        $data->user_type = 'Admin';
        $data->role = $request->role;
        $data->name = $request->name;
        $data->email = $request->email;
        $data->code = $code;
        $data->password = bcrypt($code);
        $data->save();

        $notification=array(
            'messege' => "User Added Successfully",
            'alert-type' => 'success'
        );
        return redirect()->route('view.user')->with($notification);

    }

    public function edit($id)
    {
        $user = User::find($id);
        return view('backend.users.edit_user', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'role' => 'required',
            'name' => 'required|min:3|max:20',
            'email' => 'required',
        ]);

        $user = User::find($id);

        if ($user->email != $request->email) {
            $validatedData = $request->validate([
                'email' => 'unique:users',
            ]);
        }
        $user->role = $request->role;
        $user->name = $request->name;
        $user->email = $request->email;

        $save = $user->save();
        if($save){
            $notification = array(
                'messege' => "User Updated Successfully",
                'alert-type' => 'success'
            );
            return redirect()->route('view.user')->with($notification);
        }
    }

    public function destroy($id)
    {
        $user = User::find($id);
        if($user->image){
            unlink($user->image);
        }
        $dlt_user = $user->delete();
        if($dlt_user){
            $notification=array(
                'messege' => 'User Deleted Successfully',
                'alert-type' => 'success'
            );
            return redirect()->route('view.user')->with($notification);
        }
    }
}
