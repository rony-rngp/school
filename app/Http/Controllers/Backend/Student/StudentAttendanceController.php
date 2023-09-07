<?php

namespace App\Http\Controllers\Backend\Student;

use App\Http\Controllers\Controller;
use App\Model\AssignStudent;
use App\Model\FeeAmount;
use App\Model\StudentAttendance;
use App\Model\StudentClass;
use App\Model\Year;
use App\Notifications\TestMailNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use Nexmo\Laravel\Facade\Nexmo;

class StudentAttendanceController extends Controller
{
    public function show()
    {

        $student_attendance = StudentAttendance::select('date', 'class_id', 'year_id')
            ->groupBy('class_id')
            ->groupBy('date')
            ->groupBy('year_id')
            ->orderBy('date', 'desc')
            ->orderBy('class_id', 'asc')
            ->get();
        return view('backend.student.attendance.view_attendance', compact('student_attendance'));
    }

    public function add()
    {
        $data['class']= StudentClass::orderBy('id', 'asc')->get();
        $data['year']= Year::orderBy('id', 'desc')->get();
        return view('backend.student.attendance.add_attendance', $data);
    }

    public function get_attend_student(Request $request)
    {
        $date = date('Y-m-d', strtotime($request->date));
        $all_student = AssignStudent::with('user')->where('year_id', $request->year_id)->where('class_id', $request->class_id)->orderBy('roll', 'ASC')->get();

        $html['thsource'] =  '<th>SL</th>';
        $html['thsource'] .= '<th>ID NO</th>';
        $html['thsource'] .= '<th>Student Name</th>';
        $html['thsource'] .= '<th>Roll</th>';
        $html['thsource'] .= '<th colspan="3" class="text-center" style="vertical-align: middle; width: 25%">Attendance Status</th>';

        foreach ($all_student as $key => $v){
            $color = 'success';
            $html[$key]['tdsource'] =  '<td>'.($key+1).'</td><input type="hidden" name="year_id" value="'.$request->year_id.'">';
            $html[$key]['tdsource'] .= '<td>'.$v['user']['id_no'].'</td><input type="hidden" name="class_id" value="'.$request->class_id.'">';
            $html[$key]['tdsource'] .= '<td>'.$v['user']['name'].'</td><input type="hidden" name="date" value="'.$date.'">';
            $html[$key]['tdsource'] .= '<td>'.$v['roll'].'</td><input type="hidden" name="roll[]" value="'.$v['roll'].'">';
            $html[$key]['tdsource'] .= '<td>'.'<input type="hidden" name="student_id[]" value="'.$v->student_id.'">'.'<input type="radio" class="present" id="present'.$key.'" name="attend_status'.$key.'" value="Present" checked="checked"> <label for="present'.$key.'">Present</label>'.'</td>';
            $html[$key]['tdsource'] .= '<td>'.'<input type="radio" class="absent" id="absent'.$key.'" name="attend_status'.$key.'" value="Absent"> <label for="absent'.$key.'">Absent</label>'.'</td>';
        }

        return response()->json(@$html);
    }

    public function store(Request $request)
    {
        if($request->student_id == null){
            $notification=array(
                'messege' => 'Student Not Found!',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }

        $date = date('Y-m-d', strtotime($request->date));
        $att_date = StudentAttendance::where('date', $date)->where('year_id', $request->year_id)->where('class_id', $request->class_id)->first();

        if($att_date){
            $notification=array(
                'messege' => 'Today Attendences Alreary Taken!',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }else{
            $count_student = count($request->student_id);
            for ($i=0; $i<$count_student; $i++){
                $attend_status = 'attend_status'.$i;
                $attend = new StudentAttendance();
                $attend->year_id = $request->year_id;
                $attend->class_id = $request->class_id;
                $attend->roll = $request->roll[$i];
                $attend->date = $date;
                $attend->student_id = $request->student_id[$i];
                $attend->attend_status = $request->$attend_status;
                $attend->save();
            }

            $notify = StudentAttendance::where('year_id', $request->year_id)->where('class_id', $request->class_id)->where('date', $date)->where('attend_status', 'Absent')->get();

            foreach ($notify as $row){
                /*Notification::send($row->user, new TestMailNotification($row));*/

                $smsid= $row['id'];
                $number = $row->user->mobile;
                $text = "আপনার সন্তান আজকে স্কুলে আনুপস্থিত ছিল।\r\n নাম : ".$row->user->name;

                $url = "http://66.45.237.70/api.php";
                $data= array(
                    'username'=>"01792702312",
                    'password'=>"8PD3433532",
                    'number'=>"$number",
                    'message'=>"$text"
                );

                $ch = curl_init(); // Initialize cURL
                curl_setopt($ch, CURLOPT_URL,$url);
                curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                $smsresult = curl_exec($ch);
                $p = explode("|",$smsresult);
                $sendstatus = $p[0];
            }


            $notification = array(
                'messege' => "Attendance Added Successfully",
                'alert-type' => 'success'
            );
            return redirect()->route('view.student.attendance')->with($notification);
        }
    }

    public function edit($date, $class_id, $year_id)
    {
        $edit_data = StudentAttendance::where('date', $date)->where('class_id', $class_id)->where('year_id', $year_id)->orderBy('roll', 'asc')->get();
        return view('backend.student.attendance.edit_attendance', compact('edit_data'));
    }

    public function update(Request $request, $date)
    {
        StudentAttendance::where('date', $date)->where('class_id', $request->class_id)->where('year_id', $request->year_id)->delete();
        $count_student = count($request->student_id);
        for ($i=0; $i<$count_student; $i++){
            $attend_status = 'attend_status'.$i;
            $attend = new StudentAttendance();
            $attend->year_id = $request->year_id;
            $attend->class_id = $request->class_id;
            $attend->roll = $request->roll[$i];
            $attend->date = $date;
            $attend->student_id = $request->student_id[$i];
            $attend->attend_status = $request->$attend_status;
            $attend->save();
        }
        $notification = array(
            'messege' => "Attendance Updated Successfully",
            'alert-type' => 'success'
        );
        return redirect()->route('view.student.attendance')->with($notification);
    }

    public function details($date, $class_id, $year_id)
    {
        $data['details'] = StudentAttendance::where('date', $date)->where('class_id', $class_id)->where('year_id', $year_id)->orderBy('roll', 'asc')->get();
        return view('backend.student.attendance.details_attendance', $data);
    }
}
