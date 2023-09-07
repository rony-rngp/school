<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Http\Controllers\Controller;
use App\Model\FeeAmount;
use App\Model\FeeCategory;
use App\Model\StudentClass;
use Illuminate\Http\Request;

class FeeAmountController extends Controller
{
    public function show()
    {
        $free_ammount = FeeAmount::select('fee_category_id')->groupBy('fee_category_id')->get();
        return view('backend.setup.fee_amount.view_fee_amount', compact('free_ammount'));
    }

    public function add()
    {
        $classes = StudentClass::all();
        $fee_categories = FeeCategory::all();
        return view('backend.setup.fee_amount.add_fee_amount', compact('classes', 'fee_categories'));
    }

    public function store(Request $request)
    {
        if($request->fee_category_id == ''){
            $notification=array(
                'messege' => 'Filed Must Not be Empty!',
                'alert-type' => 'success'
            );
            return redirect()-back()->with($notification);
        }

        $class_count = count($request->class_id);
        if(!empty($class_count)){
            for ($i=0; $i<$class_count; $i++){
                $fee_amount = new FeeAmount();
                $fee_amount->fee_category_id = $request->fee_category_id;
                $fee_amount->class_id = $request->class_id[$i];
                $fee_amount->amount = $request->amount[$i];
                $fee_amount->save();
            }
        }
        $notification=array(
            'messege' => "Fee Amount Added Successfully",
            'alert-type' => 'success'
        );
        return redirect()->route('view.fee.amount')->with($notification);
    }

    public function edit($fee_category_id)
    {
        $data['edit_data'] = FeeAmount::where('fee_category_id', $fee_category_id)->orderBy('id', 'ASC')->get();
        $data['fee_categories'] = FeeCategory::all();
        $data['classes'] = StudentClass::all();
        return view('backend.setup.fee_amount.edit_fee_amount', $data);
    }

    public function update(Request $request, $fee_category_id)
    {
        if($request->class_id == NULL){
            $notification=array(
                'messege' => "Sorry ! you do not select any class",
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }

        FeeAmount::where('fee_category_id', $fee_category_id)->delete();
        $class_count = count($request->class_id);
        if(!empty($class_count)){
            for ($i=0; $i<$class_count; $i++){
                $fee_amount = new FeeAmount();
                $fee_amount->fee_category_id = $request->fee_category_id;
                $fee_amount->class_id = $request->class_id[$i];
                $fee_amount->amount = $request->amount[$i];
                $fee_amount->save();
            }
        }
        $notification=array(
            'messege' => "Fee Amount Updated Successfully",
            'alert-type' => 'success'
        );
        return redirect()->route('view.fee.amount')->with($notification);
    }

    public function details($fee_category_id){
        $data['details'] = FeeAmount::where('fee_category_id', $fee_category_id)->orderBy('class_id', 'ASC')->get();
        $data['fee_categories'] = FeeCategory::all();
        $data['classes'] = StudentClass::all();
        return view('backend.setup.fee_amount.details_fee_amount', $data);
    }
}
