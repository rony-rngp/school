<?php

namespace App\Http\Controllers\Backend\Account;

use App\Http\Controllers\Controller;
use App\Model\AccountEmployeeSalary;
use App\Model\EmployeeAttendance;
use Illuminate\Http\Request;

class SalaryController extends Controller
{
    public function show()
    {
        $data = AccountEmployeeSalary::select('date')->groupBy('date')->orderBy('date', 'desc')->get();
        return view('backend.account.employee.employee_salary_view', compact('data'));
    }

    public function add()
    {
        return view('backend.account.employee.employee_salary_add');
    }

    public function get_student_fee(Request $request){
        $date = date('Y-m', strtotime($request->date));
        if($date != ''){
            $where[] = ['date', 'like',$date.'%'];
        }
        $data = EmployeeAttendance::select('employee_id')->groupBy('employee_id')->with('user')->where($where)->get();

        $html['thsource'] =  '<th>SL</th>';
        $html['thsource'] .=  '<th>ID NO</th>';
        $html['thsource'] .= '<th>Employee Name</th>';
        $html['thsource'] .= '<th>Basic Salary</th>';
        $html['thsource'] .= '<th>Salary (This Month)</th>';
        $html['thsource'] .= '<th>Select</th>';

        foreach ($data as $key => $attend){
            $account_salary = AccountEmployeeSalary::where('employee_id', $attend->employee_id)->where('date', $date)->first();
            if($account_salary != NULL){
                $checked = 'checked';
            }else{
                $checked = '';
            }

            $total_attend = EmployeeAttendance::with('user')->where($where)->where('employee_id', $attend->employee_id)->get();
            $absent_count = count($total_attend->where('attend_status', 'Absent'));

            $color = 'success';
            $html[$key]['tdsource'] =  '<td>'.($key+1).'</td>';
            $html[$key]['tdsource'] .= '<td>'.$attend['user']['id_no'].'<input type="hidden" name="date" value="'.$date.'">'.'</td>';
            $html[$key]['tdsource'] .= '<td>'.$attend['user']['name'].'</td>';
            $html[$key]['tdsource'] .= '<td>'.$attend['user']['salary'].'</td>';
            $salary = (int)$attend['user']['salary'];
            $salary_per_day = (int)$salary/30;
            $total_salary_minus = (int)$absent_count*(int)$salary_per_day;
            $total_salary = (int)$salary-(int)$total_salary_minus;
            $html[$key]['tdsource'] .= '<td>'.$total_salary.'<input type="hidden" name="amount[]" value="'.$total_salary.'">'.'</td>';

            $html[$key]['tdsource'] .= '<td>'.'<input type="hidden" name="employee_id[]" value="'.$attend->employee_id.'">'.'<input type="checkbox" name="checkmanage[]" value="'.$key.'" '.$checked.' style="transform: scale(1.5);margin-left:10px;">'.'</td>';
        }
        return response()->json(@$html);
    }

    public function store(Request $request)
    {
        $date = date('Y-m', strtotime($request->date));
        AccountEmployeeSalary::where('date', $date)->delete();

        $checkdata = $request->checkmanage;
        if($checkdata != NULL){
            for ($i = 0; $i<count($checkdata); $i++){
                $data = new AccountEmployeeSalary();
                $data->employee_id = $request->employee_id[$checkdata[$i]];
                $data->date = $date;
                $data->amount = $request->amount[$checkdata[$i]];
                $data->save();
            }
        }
        $notification=array(
            'messege' => "Well done !  Salary Added Successfully",
            'alert-type' => 'success'
        );
        return redirect()->route('account.view.employee.salary')->with($notification);
    }

    public function details($date)
    {
        $data = AccountEmployeeSalary::where('date', $date)->get();
        return view('backend.account.employee.employee_salary_details', compact('data'));
    }
}
