<?php

namespace App\Http\Controllers\Backend\Student;

use App\Http\Controllers\Controller;
use App\Model\AssignStudent;
use App\Model\FeeAmount;
use App\Model\StudentClass;
use App\Model\Year;
use Illuminate\Http\Request;
use niklasravnsborg\LaravelPdf\Facades\Pdf;

class MonthlyFeeController extends Controller
{
    public function show()
    {
        $data['class']= StudentClass::orderBy('id', 'asc')->get();
        $data['year']= Year::orderBy('id', 'desc')->get();
        return view('backend.student.monthly_fee.view_monthly_fee', $data);
    }

    public function get_student(Request $request)
    {
        $all_student = AssignStudent::with('user', 'discount_student')->where('year_id', $request->year_id)->where('class_id', $request->class_id)->orderBy('roll', 'ASC')->get();

        $html['thsource'] =  '<th>SL</th>';
        $html['thsource'] .= '<th>ID No</th>';
        $html['thsource'] .= '<th>Student Name</th>';
        $html['thsource'] .= '<th>Roll No</th>';
        $html['thsource'] .= '<th>Monthly Fee</th>';
        $html['thsource'] .= '<th>Discount Amount</th>';
        $html['thsource'] .= '<th>Fee (This student)</th>';
        $html['thsource'] .= '<th>Action</th>';

        foreach ($all_student as $key => $v){
            $monthly_fee = FeeAmount::where('fee_category_id', '2')->where('class_id', $v->class_id)->first();

            $color = 'success';
            $html[$key]['tdsource'] =  '<td>'.($key+1).'</td>';
            $html[$key]['tdsource'] .= '<td>'.$v['user']['id_no'].'</td>';
            $html[$key]['tdsource'] .= '<td>'.$v['user']['name'].'</td>';
            $html[$key]['tdsource'] .= '<td>'.$v['roll'].'</td>';
            $html[$key]['tdsource'] .= '<td>'.$monthly_fee->amount.'</td>';
            $html[$key]['tdsource'] .= '<td>'.$v['discount_student']['discount']. '%'.'</td>';
            $orginal_fee = $monthly_fee->amount;
            $discount = $v['discount_student']['discount'];
            $discountablefee = $discount/100*$orginal_fee;
            $final_fee = (int)$orginal_fee-(int)$discountablefee;
            $html[$key]['tdsource'] .= '<td>'.$final_fee.'TK'.'</td>';
            $html[$key]['tdsource'] .= '<td>';
            $html[$key]['tdsource'] .= ' <a href="'.route('student.monthly.fee.payslip').'?class_id='.$v->class_id.'&year_id='.$v->year_id.'&id='.$v->id.'&month='.$request->month_id.'" class="btn btn-sm btn-'.$color.'" title="PaySlip" target="_blank">Pay Slip</a> ';
            $html[$key]['tdsource'] .= '</td>';
        }

        return response()->json(@$html);
    }

    public function payslip(Request $request)
    {
        $class_id = $request->class_id;
        $year_id = $request->year_id;
        $student_id = AssignStudent::where('id', $request->id)->first()->student_id;
        $data['month'] = $request->month;
        $data['std'] = AssignStudent::with('user', 'discount_student')->where('id', $request->id)->where('student_id', $student_id)->where('class_id', $class_id)->where('year_id', $year_id)->first();

        $pdf = PDF::loadView('backend.student.monthly_fee.pay_slip_pdf', $data);
        return $pdf->stream('document.pdf');
    }
}
