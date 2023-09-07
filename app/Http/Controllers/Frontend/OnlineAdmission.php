<?php

namespace App\Http\Controllers\Frontend;

use App\Model\Year;
use App\Model\Admission;
use App\Model\StudentClass;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;

class OnlineAdmission extends Controller
{
    public function index(){
        $years = Year::get();
        $classes = StudentClass::all();
        $reference = rand(00000, 99999);
        return view('frontend.admission.add_admission', compact('years', 'classes', 'reference'));
    }

    public function store(Request $request){
        $this->validate($request, [
            'name' => 'required',
            'fname' => 'required',
            'mname' => 'required',
            'mobile' => 'required|unique:admissions',
            'address' => 'required',
            'gender' => 'required',
            'religion' => 'required',
            'dob' => 'required',
            'year_id' => 'required',
            'class_id' => 'required',
            'transaction' => 'required',
        ]);

        $admission = new Admission();
        $admission->name = $request->name;
        $admission->fname = $request->fname;
        $admission->mname = $request->mname;
        $admission->mobile = $request->mobile;
        $admission->address = $request->address;
        $admission->gender = $request->gender;
        $admission->religion = $request->religion;
        $admission->dob = $request->dob;
        $admission->year_id = $request->year_id;
        $admission->class_id = $request->class_id;
        $admission->transaction = $request->transaction;
        $admission->reference = $request->reference;
        $admission->amount = $request->amount;
        $image = $request->file('image');
        if($image){
            $image_name = hexdec(uniqid());
            $ext = strtolower($image->getClientOriginalExtension());
            $image_fill_name = $image_name . '.' . $ext;
            $upload_path = 'public/backend/upload/admission/';
            $image_url = $upload_path . $image_fill_name;
            Image::make($image)->resize(445, 278)->save($image_url);
            $admission->image = $image_url;
        }
        $admission->save();

        $student = Admission::where('id', $admission->id)->first();

        //---------Send Messege---------
        $url = "http://66.45.237.70/api.php";
        $number="$student->mobile";
        $text="Your Admission Submited.\r\n ID : ".$student->id." \r\n Name : ".$student->name." \r\n Class : ".$student->class->name." \r\n Session : ".$student->year->name;
        $data= array(
        'username'=>"01792702312",
        'password'=>"8PDS4FC7",
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

        $notification = array(
            'messege' => "Admission Successfully Submitted ",
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
}
