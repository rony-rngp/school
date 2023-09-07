<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Http\Controllers\Controller;
use App\Model\FeeCategory;
use Illuminate\Http\Request;

class FeeCategoryController extends Controller
{
    public function show()
    {
        $fee_category = FeeCategory::all();
        return view('backend.setup.fee_category.view_fee_categoy', compact('fee_category'));
    }

    public function edit($id)
    {
        $fee_category = FeeCategory::find($id);
        return view('backend.setup.fee_category.edit_fee_categoy', compact('fee_category'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required'
        ]);
        $fee_category = FeeCategory::find($id);
        if($request->name != $fee_category->name){
            $this->validate($request, [
                'name' => 'required|unique:fee_categories'
            ]);
        }
        $fee_category->name = $request->name;
        $fee_category->save();
        $notification=array(
            'messege' => 'Fee Category Updated Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('view.fee.category')->with($notification);
    }
}
