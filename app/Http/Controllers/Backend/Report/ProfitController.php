<?php

namespace App\Http\Controllers\Backend\Report;

use App\Http\Controllers\Controller;
use App\Model\AccountEmployeeSalary;
use App\Model\AccountOtherCost;
use App\Model\AccountStudentFee;
use Illuminate\Http\Request;
use niklasravnsborg\LaravelPdf\Facades\Pdf;

class ProfitController extends Controller
{
    public function show()
    {
        return view('backend.report.profit.view_profit');
    }

    public function profit_get(Request $request)
    {
        $start_date = date('Y-m', strtotime($request->start_date));
        $end_date = date('Y-m', strtotime($request->end_date));

        $where[] = ['date', ['like',$start_date.'%', 'like',$end_date.'%']];

        $student_fee = AccountStudentFee::whereBetween('date', [$start_date, $end_date])->sum('amount');
        $other_cost = AccountOtherCost::whereBetween('s_date', [$start_date, $end_date])->sum('amount');
        $employee_salary = AccountEmployeeSalary::whereBetween('date', [$start_date, $end_date])->sum('amount');
        $total_cost = $other_cost+$employee_salary;
        $profit = $student_fee-$total_cost;

        $html['thsource'] =  '<th>Student Fee</th>';
        $html['thsource'] .= '<th>Other Cost</th>';
        $html['thsource'] .= '<th>Employee Salary</th>';
        $html['thsource'] .= '<th>Total Cost</th>';
        $html['thsource'] .= '<th>Profit</th>';
        $html['thsource'] .= '<th>Action</th>';

        $color = 'success';

        $html['tdsource'] =  '<td>'.$student_fee.'</td>';
        $html['tdsource'] .=  '<td>'.$other_cost.'</td>';
        $html['tdsource'] .=  '<td>'.$employee_salary.'</td>';
        $html['tdsource'] .=  '<td>'.$total_cost.'</td>';
        $html['tdsource'] .=  '<td>'.$profit.'</td>';
        $html['tdsource'] .= '<td>';
        $html['tdsource'] .= ' <a href="'.route("report.profit.pdf").'?start_date='.$start_date.'&end_date='.$end_date.'" class="btn btn-sm btn-'.$color.'" title="PDF" target="_blank"><i class="fa fa-file-pdf"></i></a> ';
        $html['tdsource'] .= '</td>';

        return response()->json(@$html);
    }

    public function profit_pdf(Request $request){
        $data['start_date'] = date('Y-m', strtotime($request->start_date));
        $data['end_date'] = date('Y-m', strtotime($request->end_date));

        $pdf = PDF::loadView('backend.report.profit.monthly_profit_pdf', $data);
        return $pdf->stream('document.pdf');
    }
}
