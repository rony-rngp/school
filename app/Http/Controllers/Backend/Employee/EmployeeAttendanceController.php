<?php

namespace App\Http\Controllers\Backend\Employee;

use App\Http\Controllers\Controller;
use App\Model\EmployeeAttendance;
use App\Model\EmployeeLeave;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class EmployeeAttendanceController extends Controller
{
    public function show()
    {
        $attendance = EmployeeAttendance::select('date')->groupBy('date')->orderBy('date', 'desc')->get();
        return view('backend.employee.employee_attendance.view_employee_attendance', compact('attendance'));
    }

    public function add()
    {
        $data['employee_leave'] = EmployeeLeave::whereDate('start_date', '<=', date('Y-m-d', strtotime(Carbon::today())))->whereDate('end_date', '>=', date('Y-m-d', strtotime(Carbon::today())))->get();
        $data['employees'] = User::where('user_type', 'Employee')->get();
        return view('backend.employee.employee_attendance.add_employee_attendance', $data);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'date' => 'required',
        ]);
        $date = date('Y-m-d', strtotime($request->date));
        $att_date = EmployeeAttendance::where('date', $date )->first();
        if($att_date){
            $notification=array(
                'messege' => 'Today Attendences Alreary Taken!',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }else{
            $count_employee = count($request->employee_id);
            for ($i=0; $i<$count_employee; $i++){
                $attend_status = 'attend_status'.$i;
                $attend = new EmployeeAttendance();
                $attend->date = $date;
                $attend->employee_id = $request->employee_id[$i];
                $attend->attend_status = $request->$attend_status;
                $attend->save();
            }
            $notification = array(
                'messege' => "Attendance Added Successfully",
                'alert-type' => 'success'
            );
            return redirect()->route('view.employee.attendance')->with($notification);
        }
    }

    public function edit($date)
    {
        $data['edit_data'] = EmployeeAttendance::where('date', $date)->get();
        $data['employees'] = User::where('user_type', 'Employee')->get();
        return view('backend.employee.employee_attendance.edit_employee_attendance', $data);
    }

    public function update(Request $request, $date)
    {
        $validatedData = $request->validate([
            'date' => 'required',
        ]);

        EmployeeAttendance::where('date', date('Y-m-d', strtotime($request->date)))->delete();
        $count_employee = count($request->employee_id);
        for ($i=0; $i<$count_employee; $i++){
            $attend_status = 'attend_status'.$i;
            $attend = new EmployeeAttendance();
            $attend->date = date('Y-m-d', strtotime($request->date));
            $attend->employee_id = $request->employee_id[$i];
            $attend->attend_status = $request->$attend_status;
            $attend->save();
        }
        $notification = array(
            'messege' => "Attendance Updated Successfully",
            'alert-type' => 'success'
        );
        return redirect()->route('view.employee.attendance')->with($notification);
    }

    public function details($date)
    {
        $data['details'] = EmployeeAttendance::where('date', $date)->get();
        return view('backend.employee.employee_attendance.details_employee_attendance', $data);
    }
}
