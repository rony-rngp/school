<?php

namespace App\Http\Controllers\Backend\Sms;

use App\Model\Year;
use App\Model\StudentClass;
use App\Model\AssignStudent;
use App\TeacherSms;
use App\User;
use Illuminate\Http\Request;
use Laravel\Ui\Presets\React;
use App\Http\Controllers\Controller;
use App\Model\BulkSms;

class BulkSmsController extends Controller
{
    public function show()
    {
        $data['years'] = Year::latest()->get();
        $data['classes'] = StudentClass::all();
        return view('backend.sms.view_bulk_sms', $data);
    }

    public function get_student(Request $request)
    {
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
            $html[$key]['tdsource'] .= '<td>'.$v['user']['name'].'</td>';
            $html[$key]['tdsource'] .= '<td>'.$v['roll'].'</td><input type="hidden" name="roll[]" value="'.$v['roll'].'">';
            $html[$key]['tdsource'] .= '<td>'.'<input type="hidden" name="student_id[]" value="'.$v->student_id.'">'.'<input type="radio" class="check" id="check'.$key.'" name="status'.$key.'" value="Check" checked="checked"> <label for="check'.$key.'">Check</label>'.'</td>';
            $html[$key]['tdsource'] .= '<td>'.'<input type="radio" class="uncheck" id="uncheck'.$key.'" name="status'.$key.'" value="Uncheck"> <label for="uncheck'.$key.'">Uncheck</label>'.'</td>';
        }

        return response()->json(@$html);
    }

    public function send(Request $request)
    {
        if($request->student_id == null){
            $notification=array(
                'messege' => 'Student Not Found!',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }

        if($request->body == null){
            $notification=array(
                'messege' => 'Text Filed is Required!',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }



        $count_student = count($request->student_id);
            for ($i=0; $i<$count_student; $i++){
                $status = 'status'.$i;
                $attend = new BulkSms();
                $attend->year_id = $request->year_id;
                $attend->class_id = $request->class_id;
                $attend->roll = $request->roll[$i];
                $attend->body = $request->body;
                $attend->student_id = $request->student_id[$i];
                $attend->status = $request->$status;
                $attend->save();
            }
            $notify = BulkSms::where('year_id', $request->year_id)->where('class_id', $request->class_id)->where('status', 'Check')->get();

            foreach ($notify as $row){

                $smsid= $row['id'];
                $number = $row->user->mobile;
                $text = $row->body;

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

            BulkSms::where('year_id', $request->year_id)->where('class_id', $request->class_id)->delete();


            $notification = array(
                'messege' => "SMS Send Successfully",
                'alert-type' => 'success'
            );
            return redirect()->back()->with($notification);

    }

    public function teacher_show()
    {
        $employees = User::where('user_type', 'Employee')->get();
        return view('backend.sms.teacher_bulk_sms', compact('employees'));
    }

    public function teacher_send(Request $request)
    {
        if($request->teacher_id == null){
            $notification=array(
                'messege' => 'Teacher Not Found!',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }

        if($request->body == null){
            $notification=array(
                'messege' => 'Text Filed is Required!',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }

        $token = uniqid();

        foreach ($request->teacher_id as $key=> $val){
            $status = 'status'.$key;
            $attend = new TeacherSms();
            $attend->teacher_id = $val;
            $attend->body = $request->body;
            $attend->token = $token;
            $attend->status = $request->$status;
            $attend->save();
        }

        $notify = TeacherSms::where('token', $token)->where('status', 'Check')->get();
        foreach ($notify as $row){
                $smsid= $row['id'];
                $number = $row->user->mobile;
                $text = $row->body;


//                $url = "http://66.45.237.70/api.php";
//                $data= array(
//                    'username'=>"01792702312",
//                    'password'=>"8PDS4FC7",
//                    'number'=>"$number",
//                    'message'=>"$text"
//                );
//
//                $ch = curl_init(); // Initialize cURL
//                curl_setopt($ch, CURLOPT_URL,$url);
//                curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
//                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//                $smsresult = curl_exec($ch);
//                $p = explode("|",$smsresult);
//                $sendstatus = $p[0];
            }

        TeacherSms::where('token', $token)->delete();

        $notification = array(
            'messege' => "SMS Send Successfully",
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

}
