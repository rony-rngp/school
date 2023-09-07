<?php

namespace App\Http\Controllers\Backend\Employee;

use App\Http\Controllers\Controller;
use App\Model\EmployeeAttendance;
use Illuminate\Http\Request;
use niklasravnsborg\LaravelPdf\Facades\Pdf;

class EmployeeMonthlySalaryController extends Controller
{
    public function show()
    {
        return view('backend.employee.monthly_salary.view_monthly_salary');
    }

    public function get_salary(Request $request)
    {
        $date = date('Y-m', strtotime($request->date));

        $data = EmployeeAttendance::with('user')->select('employee_id')->groupBy('employee_id')->where('date', 'like',$date.'%')->get();

        $html['thsource'] = '<th>SL</th>';
        $html['thsource'] .= '<th>Employee Name</th>';
        $html['thsource'] .= '<th>Basic Salary</th>';
        $html['thsource'] .= '<th>Salary (This Month)</th>';
        $html['thsource'] .= '<th>Action</th>';

        foreach ($data as $key => $attend){
            $total_attend = EmployeeAttendance::with('user')->where('date', 'like',$date.'%')->where('employee_id', $attend->employee_id)->get();
            $absent_count = count($total_attend->where('attend_status', 'Absent'));

            $color = 'success';
            $html[$key]['tdsource'] =  '<td>'.($key+1).'</td>';
            $html[$key]['tdsource'] .= '<td>'.$attend['user']['name'].'</td>';
            $html[$key]['tdsource'] .= '<td>'.$attend['user']['salary'].'</td>';
            $salary = (int)$attend['user']['salary'];
            $salary_per_day = (int)$salary/30;
            $total_salary_minus = (int)$absent_count*(int)$salary_per_day;
            $total_salary = (int)$salary-(int)$total_salary_minus;
            $html[$key]['tdsource'] .= '<td>'.$total_salary.'</td>';
            $html[$key]['tdsource'] .= '<td>';
            $html[$key]['tdsource'] .= ' <a href="'.route("payslip.employee.monthly.salary").'?employee_id='.$attend->employee_id.'&date='.$date.'" class="btn btn-sm btn-'.$color.'" title="PaySlip" target="_blank">Pay Slip</a> ';
            $html[$key]['tdsource'] .= '</td>';
        }

        return response()->json(@$html);
    }

    public function pay_slip( Request $request)
    {
        if($request->date != ''){
            $where[] = ['date', 'like',$request->date.'%'];
        }
        $data['employee_monthly_salary'] = EmployeeAttendance::with('user')->where($where)->where('employee_id', $request->employee_id)->get();
        $pdf = PDF::loadView('backend.employee.monthly_salary.payslip_monthly_salary_pdf', $data);
        return $pdf->stream('document.pdf');
    }
}
