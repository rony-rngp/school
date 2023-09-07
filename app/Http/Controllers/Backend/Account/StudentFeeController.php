<?php

namespace App\Http\Controllers\Backend\Account;

use App\Http\Controllers\Controller;
use App\Model\AccountStudentFee;
use App\Model\AssignStudent;
use App\Model\FeeAmount;
use App\Model\FeeCategory;
use App\Model\StudentClass;
use App\Model\Year;
use Illuminate\Http\Request;

class StudentFeeController extends Controller
{
    public function show(){
        $student_fee = AccountStudentFee::select('date')->groupBy('date')->orderBy('date','DESC')->get();
        return view('backend.account.student.view_student_fee', compact('student_fee'));
    }

    public function add()
    {
        $data['year'] = Year::orderBy('id', 'desc')->get();
        $data['class'] = StudentClass::all();
        $data['fee_categories'] = FeeCategory::all();
        return view('backend.account.student.add_student_fee', $data);
    }

    public function get_student_fee(Request $request)
    {
        $year_id = $request->year_id;
        $class_id = $request->class_id;
        $fee_category_id = $request->fee_category_id;
        $date = date('Y-m', strtotime($request->date));

        $data = AssignStudent::with('discount_student')->where('year_id', $year_id)->where('class_id', $class_id)->orderBy('roll', 'ASC')->get();
        $html['thsource'] =  '<th>ID No</th>';
        $html['thsource'] .= '<th>Student Name</th>';
        $html['thsource'] .= '<th>Roll</th>';
        $html['thsource'] .= '<th>Orginal Fee</th>';
        $html['thsource'] .= '<th>Discount Amount</th>';
        $html['thsource'] .= '<th>Fee This Student</th>';
        $html['thsource'] .= '<th>Select</th>';

        foreach ($data as $key => $student){
            $student_fee = FeeAmount::where('fee_category_id', $fee_category_id)->where('class_id', $student->class_id)->first();
            $account_student_fee = AccountStudentFee::where('student_id', $student->student_id)
                ->where('year_id', $student->year_id)
                ->where('class_id', $student->class_id)
                ->where('fee_category_id', $request->fee_category_id)
                ->where('date', $date)->first();
            if ($account_student_fee != NULL){
                $checked = 'checked';
            }else{
                $checked = '';
            }
            $html[$key]['tdsource'] =  '<td>'.$student['user']['id_no'].'<input type="hidden" name="fee_category_id" value="'.$fee_category_id.'">'.'</td>';
            $html[$key]['tdsource'] .= '<td>'.$student['user']['name'].'<input type="hidden" name="year_id" value="'.$student->year_id.'">'.'</td>';
            $html[$key]['tdsource'] .= '<td>'.$student['roll'].'<input type="hidden" name="class_id" value="'.$student->class_id.'">'.'</td>';
            $html[$key]['tdsource'] .= '<td>'.$student_fee->amount.'TK'.'<input type="hidden" name="date" value="'.$date.'">'.'</td>';
            $html[$key]['tdsource'] .= '<td>'.$student['discount_student']['discount'].'%'.'</td>';
            $orginal_fee = $student_fee->amount;
            $discount = $student['discount_student']['discount'];
            $discountablefee = $discount/100*$orginal_fee;
            $final_fee = (int)$orginal_fee-(int)$discountablefee;
            $html[$key]['tdsource'] .= '<td>'.'<input type="text" name="amount[]" value="'.$final_fee.'" class="form-control form-control-sm" readonly>'.'</td>';
            $html[$key]['tdsource'] .= '<td>'.'<input type="hidden" name="student_id[]" value="'.$student->student_id.'">'.'<input type="checkbox" name="checkmanage[]" value="'.$key.'" '.$checked.' style="transform: scale(1.5);margin-left:10px;">'.'</td>';
        }
        return response()->json(@$html);
    }

    public function store(Request $request)
    {
        $date = date('Y-m', strtotime($request->date));
        AccountStudentFee::where('year_id', $request->year_id)->where('class_id', $request->class_id)
            ->where('fee_category_id', $request->fee_category_id)->where('date', $date)->delete();
        $checkdata = $request->checkmanage;
        if($checkdata != NULL){
            for ($i =0; $i<count($checkdata); $i++){
                $data = new AccountStudentFee();
                $data->year_id = $request->year_id;
                $data->class_id = $request->class_id;
                $data->student_id = $request->student_id[$i];
                $data->fee_category_id = $request->fee_category_id;
                $data->date = $date;
                $data->amount = $request->amount[$i];
                $data->save();
            }
        }

        $notification=array(
            'messege' => "Well done !  Data Updated Successfully",
            'alert-type' => 'success'
        );
        return redirect()->route('view.student.fee')->with($notification);
    }

    public function details($date){
        $data = AccountStudentFee::where('date', $date)->get();
        return view('backend.account.student.details_student_fee', compact('data'));
    }
}
