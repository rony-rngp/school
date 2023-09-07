<?php

namespace App\Http\Controllers\Backend\Employee;

use App\Http\Controllers\Controller;
use App\Model\EmployeeLeave;
use App\Model\LeavePurpose;
use App\User;
use Illuminate\Http\Request;

class EmployeeLeaveController extends Controller
{
    public function show()
    {
        $employee_leave = EmployeeLeave::orderBy('id', 'desc')->get();
        return view('backend.employee.employee_leave.view_employee_leave', compact('employee_leave'));
    }

    public function add()
    {
        $leave_purpose = LeavePurpose::all();
        $employees = User::where('user_type', 'Employee')->get();
        return view('backend.employee.employee_leave.add_employee_leave', compact('leave_purpose', 'employees'));
    }

    public function store(Request $request)
    {
        if($request->leave_purposes_id == '0'){
            $leave_purposes = new LeavePurpose();
            $leave_purposes->name = $request->name;
            $leave_purposes->save();
            $leave_purposes_id = $leave_purposes->id;
        }else{
            $leave_purposes_id = $request->leave_purposes_id;
        }
        $employee_leave = new EmployeeLeave();
        $employee_leave->employee_id = $request->employee_id;
        $employee_leave->leave_purposes_id = $leave_purposes_id;
        $employee_leave->start_date = date('Y-m-d', strtotime($request->start_date));
        $employee_leave->end_date = date('Y-m-d', strtotime($request->end_date));
        $employee_leave->save();

        $notification=array(
            'messege' => "Employee Leave Added Successfully",
            'alert-type' => 'success'
        );
        return redirect()->route('view.employee.leave')->with($notification);
    }

    public function edit($id)
    {
        $data['employee_leave'] = EmployeeLeave::find($id);
        $data['leave_purpose'] = LeavePurpose::all();
        $data['employees'] = User::where('user_type', 'Employee')->get();
        return view('backend.employee.employee_leave.edit_employee_leave', $data);
    }

    public function update(Request $request, $id){
        if($request->leave_purposes_id == '0'){
            $leave_purposes = new LeavePurpose();
            $leave_purposes->name = $request->name;
            $leave_purposes->save();
            $leave_purposes_id = $leave_purposes->id;
        }else{
            $leave_purposes_id = $request->leave_purposes_id;
        }
        $employee_leave = EmployeeLeave::find($id);
        $employee_leave->employee_id = $request->employee_id;
        $employee_leave->leave_purposes_id = $leave_purposes_id;
        $employee_leave->start_date = date('Y-m-d', strtotime($request->start_date));
        $employee_leave->end_date = date('Y-m-d', strtotime($request->end_date));
        $employee_leave->save();

        $notification=array(
            'messege' => "Employee Leave Updated Successfully",
            'alert-type' => 'success'
        );
        return redirect()->route('view.employee.leave')->with($notification);
    }
}
