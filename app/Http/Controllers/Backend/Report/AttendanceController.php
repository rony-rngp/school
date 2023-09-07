<?php

namespace App\Http\Controllers\Backend\Report;

use App\Http\Controllers\Controller;
use App\Model\EmployeeAttendance;
use App\User;
use Illuminate\Http\Request;
use niklasravnsborg\LaravelPdf\Facades\Pdf;


class AttendanceController extends Controller
{
    public function show()
    {
        $employees = User::where('user_type', 'Employee')->get();
        return view('backend.report.attendance.view_attendance_report', compact('employees'));
    }

    public function get_attendance(Request $request)
    {
        $date = date('Y-m', strtotime($request->date));
        $check_data = EmployeeAttendance::where('date', 'LIKE', $date.'%')->where('employee_id', $request->employee_id)->first();
        if($check_data == true){
            $data['all_data'] = EmployeeAttendance::where('date', 'LIKE', $date.'%')->where('employee_id', $request->employee_id)->orderBy('date', 'ASC')->get();
            $data['absents'] = $data['all_data']->where('attend_status', 'Absent')->count();
            $data['leaves'] = $data['all_data']->where('attend_status', 'Leave')->count();
            $data['month'] = date('M Y', strtotime($request->date));
            $pdf = PDF::loadView('backend.report.attendance.attendance_report_pdf', $data);
            return $pdf->stream('document.pdf');
        }else{
            $notification=array(
                'messege' => "Sorry ! These criteria does not match",
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }
    }
}
