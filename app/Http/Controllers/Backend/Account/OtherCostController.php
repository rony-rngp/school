<?php

namespace App\Http\Controllers\Backend\Account;

use App\Http\Controllers\Controller;
use App\Model\AccountOtherCost;
use Illuminate\Http\Request;

class OtherCostController extends Controller
{
    public function show()
    {
        $data = AccountOtherCost::orderBy('id', 'desc')->get();
        return view('backend.account.cost.view_other_cost', compact('data'));
    }

    public function add()
    {
        return view('backend.account.cost.add_other_cost');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'date' => 'required',
            'amount' => 'required',
            'description' => 'required',
            'image' => 'mimes:jpeg,jpg,png,PNG|max:1000',
        ]);

        $data = new AccountOtherCost();
        $data->date = date('Y-m-d', strtotime($request->date));
        $data->amount = $request->amount;
        $data->description = $request->description;
        $data->s_date = date('Y-m', strtotime($request->date));
        $image = $request->file('image');
        //Student Image
        if($image){
            $image_name = hexdec(uniqid());
            $ext = strtolower($image->getClientOriginalExtension());
            $image_fill_name = $image_name . '.' . $ext;
            $upload_path = 'public/backend/upload/other_cost/';
            $image_url = $upload_path . $image_fill_name;
            $success = $image->move($upload_path, $image_fill_name);
            $data->image = $image_url;
        }
        $data->save();
        $notification=array(
            'messege' => "Cost Added Successfully",
            'alert-type' => 'success'
        );
        return redirect()->route('view.other.cost')->with($notification);
    }

    public function edit($id){
        $edit_data = AccountOtherCost::find($id);
        return view('backend.account.cost.edit_other_cost', compact('edit_data'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'date' => 'required',
            'amount' => 'required',
            'description' => 'required',
            'image' => 'mimes:jpeg,jpg,png,PNG|max:1000',
        ]);

        $data = AccountOtherCost::find($id);
        $data->date = date('Y-m-d', strtotime($request->date));
        $data->amount = $request->amount;
        $data->description = $request->description;
        $data->s_date = date('Y-m', strtotime($request->date));
        $image = $request->file('image');
        //Student Image
        if($image){
            $image_name = hexdec(uniqid());
            $ext = strtolower($image->getClientOriginalExtension());
            $image_fill_name = $image_name . '.' . $ext;
            $upload_path = 'public/backend/upload/other_cost/';
            $image_url = $upload_path . $image_fill_name;
            $success = $image->move($upload_path, $image_fill_name);
            if($success){
                $data->image = $image_url;
                $img = AccountOtherCost::where('id', $id)->first();
                if ($img->image) {
                    $done = unlink($img->image);
                }
            }
        }
        $data->save();
        $notification=array(
            'messege' => "Cost Updated Successfully",
            'alert-type' => 'success'
        );
        return redirect()->route('view.other.cost')->with($notification);
    }

    public function destroy($id)
    {
        $other_cost = AccountOtherCost::find($id);
        if ($other_cost->image) {
            unlink($other_cost->image);
        }
        $other_cost->delete();

        $notification=array(
            'messege' => "Cost Deleted Successfully",
            'alert-type' => 'success'
        );
        return redirect()->route('view.other.cost')->with($notification);
    }
}
