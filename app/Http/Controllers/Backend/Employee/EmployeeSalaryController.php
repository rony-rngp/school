<?php

namespace App\Http\Controllers\Backend\Employee;

use App\Http\Controllers\Controller;
use App\Model\EmployeeSalary;
use App\User;
use Illuminate\Http\Request;

class EmployeeSalaryController extends Controller
{
    public function show()
    {
        $employee_salary = User::where('user_type', 'Employee')->get();
        return view('backend.employee.employee_salary.view_employee_salary', compact('employee_salary'));
    }

    public function increment($id)
    {
        $increment = User::find($id);
        return view('backend.employee.employee_salary.increment_salary', compact('increment'));
    }

    public function store(Request $request, $id)
    {
        $validatedData = $request->validate([
            'increment_salary' => 'required|numeric',
            'effected_date' => 'required',
        ]);
        $user = User::find($id);
        $previous_salary = $user->salary;
        $present_salary = (float)$previous_salary+(float)$request->increment_salary;
        $user->salary = $present_salary;
        $user->save();
        //end
        $salary_data = new EmployeeSalary();
        $salary_data->employee_id = $id;
        $salary_data->previous_salary = $previous_salary;
        $salary_data->present_salary = $present_salary;
        $salary_data->increment_salary = $request->increment_salary;
        $salary_data->effected_date = date('y-m-d', strtotime($request->effected_date));
        $salary_data->save();

        $notification=array(
            'messege' => "Salary Incremented Successfully",
            'alert-type' => 'success'
        );
        return redirect()->route('view.employee.salary')->with($notification);
    }

    public function details($id){
        $data['details'] = User::find($id);
        $data['salary'] = EmployeeSalary::where('employee_id', $id)->get();
        return view('backend.employee.employee_salary.details_increment_salary',$data);
    }
}
