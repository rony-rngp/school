<?php

namespace App\Http\Controllers\Backend\Student;

use App\Http\Controllers\Controller;
use App\Model\AssignStudent;
use App\Model\DiscountStudent;
use App\Model\StudentClass;
use App\Model\Year;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use niklasravnsborg\LaravelPdf\Facades\Pdf;

class StudentRegController extends Controller
{
    public function show()
    {
        $data['class']= StudentClass::orderBy('id', 'asc')->get();
        $data['year']= Year::orderBy('id', 'desc')->get();
        $data['year_id'] = Year::orderBy('id', 'desc')->first()->id;
        $data['class_id']= StudentClass::orderBy('id', 'asc')->first()->id;
        $data['student_reg'] = AssignStudent::where('year_id', $data['year_id'])->where('class_id', $data['class_id'])->orderBy('roll', 'ASC')->get();
        return view('backend.student.student_reg.view_student', $data);
    }

    public function yearClassWise(Request $request)
    {
        $data['class']= StudentClass::orderBy('id', 'asc')->get();
        $data['year']= Year::orderBy('id', 'desc')->get();
        $data['year_id'] = $request->year_id;
        $data['class_id']= $request->class_id;
        $data['student_reg'] = AssignStudent::where('year_id', $data['year_id'])->where('class_id', $data['class_id'])->orderBy('roll', 'ASC')->get();
        return view('backend.student.student_reg.view_student', $data);
    }

    public function add()
    {
        $data['class'] = StudentClass::all();
        $data['year'] = Year::all();
        return view('backend.student.student_reg.add_student', $data);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'fname' => 'required',
            'mname' => 'required',
            'mobile' => 'required|numeric',
            'address' => 'required',
            'gender' => 'required',
            'religion' => 'required',
            'dob' => 'required',
            'discount' => 'required|required|numeric',
            'year_id' => 'required',
            'class_id' => 'required',
            'image' => 'mimes:jpeg,jpg,png,PNG | max:1000',
        ]);

        DB::transaction(function () use ($request){
            $check_year = 1995;
            $student = User::where('user_type', 'Student')->orderBy('id_no', 'desc')->first();
            if($student == NULL){
                $first_reg = 0;
                $student_id = $first_reg+1;
                if($student_id < 10){
                    $id_no = '000'.$student_id;
                }elseif ($student_id < 100){
                    $id_no = '00'.$student_id;
                }elseif ($student_id < 1000){
                    $id_no = '0'.$student_id;
                }
                $final_id_no = $check_year.$id_no;
            }else{
                $student = User::where('user_type', 'Student')->orderBy('id_no', 'desc')->first()->id_no;
                $student_id = $student+1;
                $final_id_no = $student_id;
            }

            $code = rand(0000,9999);
            $user = new User();
            $user->id_no = $final_id_no;
            $user->user_type = 'Student';
            $user->code = $code;
            $user->password = bcrypt($code);
            $user->name = $request->name;
            $user->fname = $request->fname;
            $user->mname = $request->mname;
            $user->mobile = $request->mobile;
            $user->address = $request->address;
            $user->gender = $request->gender;
            $user->religion = $request->religion;
            $user->dob = date('Y-m-d', strtotime($request->dob));
            $image = $request->file('image');
            //Student Image
            if($image){
                $image_name = hexdec(uniqid());
                $ext = strtolower($image->getClientOriginalExtension());
                $image_fill_name = $image_name . '.' . $ext;
                $upload_path = 'public/backend/upload/students/';
                $image_url = $upload_path . $image_fill_name;
                $success = $image->move($upload_path, $image_fill_name);
                $user->image = $image_url;
            }
            $user->save();
            //Assign Student
            $assign_student = new AssignStudent();
            $assign_student->student_id = $user->id;
            $assign_student->year_id = $request->year_id;
            $assign_student->class_id = $request->class_id;
            $assign_student->roll = '';
            $assign_student->save();
            //Discount Student
            $discount_student = new DiscountStudent();
            $discount_student->assign_student_id = $assign_student->id;
            $discount_student->fee_category_id = 1;
            $discount_student->discount = $request->discount;
            $discount_student->save();
        });

        $notification=array(
            'messege' => "Student Added Successfully",
            'alert-type' => 'success'
        );
        return redirect()->route('view.student')->with($notification);
    }

    public function edit($id)
    {
        $student_id = AssignStudent::where('id', $id)->first()->student_id;
        $data['edit_data'] = AssignStudent::with('user', 'discount_student')->where('student_id', $student_id)->where('id', $id)->first();
        $data['class'] = StudentClass::all();
        $data['year'] = Year::all();
        return view('backend.student.student_reg.edit_student', $data);
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'fname' => 'required',
            'mname' => 'required',
            'mobile' => 'required',
            'address' => 'required',
            'gender' => 'required',
            'religion' => 'required',
            'dob' => 'required',
            'discount' => 'required|required|numeric',
            'year_id' => 'required',
            'class_id' => 'required',
            'image' => 'mimes:jpeg,jpg,png,PNG | max:1000',
        ]);

        DB::transaction(function () use ($request, $id){
            $student_id = AssignStudent::where('id', $id)->first()->student_id;
            $user = User::where('id', $student_id)->first();


            $user->name = $request->name;
            $user->fname = $request->fname;
            $user->mname = $request->mname;
            $user->mobile = $request->mobile;
            $user->address = $request->address;
            $user->gender = $request->gender;
            $user->religion = $request->religion;
            $user->dob = date('Y-m-d', strtotime($request->dob));
            $user->student_attendance = $request->student_attendance;
            $image = $request->file('image');
            //Student Image
            if($image){
                $image_name = hexdec(uniqid());
                $ext = strtolower($image->getClientOriginalExtension());
                $image_fill_name = $image_name . '.' . $ext;
                $upload_path = 'public/backend/upload/students/';
                $image_url = $upload_path . $image_fill_name;
                $success = $image->move($upload_path, $image_fill_name);
                if($success){
                    $user->image = $image_url;
                    $img = User::where('id', $student_id)->first();
                    if (file_exists($img->image)) {
                        $done = unlink($img->image);
                    }
                }
            }
            $user->save();
            //End User
            $assign_student = AssignStudent::where('student_id', $student_id)->where('id', $request->id)->first();
            $assign_student->year_id = $request->year_id;
            $assign_student->class_id = $request->class_id;
            $assign_student->save();
            //Discount Student
            $discount_student = DiscountStudent::where('assign_student_id', $request->id)->first();
            $discount_student->discount = $request->discount;
            $discount_student->save();
        });

        $notification=array(
            'messege' => "Student Updated Successfully",
            'alert-type' => 'success'
        );
        //return redirect()->route('view.student')->with($notification);
        return redirect()->back()->with($notification);
    }

    public function promotion($id)
    {
        $student_id = AssignStudent::where('id', $id)->first()->student_id;
        $data['promotion'] = AssignStudent::with('user', 'discount_student')->where('student_id', $student_id)->where('id', $id)->first();
        $data['class']= StudentClass::orderBy('id', 'asc')->get();
        $data['year']= Year::orderBy('id', 'desc')->get();
        return view('backend.student.student_reg.promotion_student', $data);
    }

    public function promotion_store(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'fname' => 'required',
            'mname' => 'required',
            'mobile' => 'required',
            'address' => 'required',
            'gender' => 'required',
            'religion' => 'required',
            'dob' => 'required',
            'discount' => 'required|required|numeric',
            'year_id' => 'required',
            'class_id' => 'required',
            'image' => 'mimes:jpeg,jpg,png,PNG | max:1000',
        ]);

        $all_assign_students = AssignStudent::all();

        foreach ($all_assign_students as $all_assign_student){
            if($all_assign_student->student_id == $request->student_id && $all_assign_student->class_id == $request->class_id && $all_assign_student->year_id == $request->year_id){
                $notification=array(
                    'messege' => "This Student Already Exits",
                    'alert-type' => 'error'
                );
                return redirect()->back()->with($notification);
            }
        }

        DB::transaction(function () use ($request, $id){

            $student_id = AssignStudent::where('id', $id)->first()->student_id;
            $user = User::where('id', $student_id)->first();
            if($request->mobile){
                if ($user->mobile != $request->mobile) {
                    $validatedData = $request->validate([
                        'mobile' => 'unique:users|numeric',
                    ]);
                }
            }
            $user->name = $request->name;
            $user->fname = $request->fname;
            $user->mname = $request->mname;
            $user->mobile = $request->mobile;
            $user->address = $request->address;
            $user->gender = $request->gender;
            $user->religion = $request->religion;
            $user->dob = date('Y-m-d', strtotime($request->dob));
            $image = $request->file('image');
            //Student Image
            if($image){
                $image_name = hexdec(uniqid());
                $ext = strtolower($image->getClientOriginalExtension());
                $image_fill_name = $image_name . '.' . $ext;
                $upload_path = 'public/backend/upload/students/';
                $image_url = $upload_path . $image_fill_name;
                $success = $image->move($upload_path, $image_fill_name);
                if($success){
                    $user->image = $image_url;
                    $img = User::where('id', $student_id)->first();
                    if (file_exists($img->image)) {
                        $done = unlink($img->image);
                    }
                }
            }
            $user->save();
            //End User
            $assign_student = new AssignStudent();
            $assign_student->student_id = $student_id;
            $assign_student->year_id = $request->year_id;
            $assign_student->class_id = $request->class_id;
            $assign_student->roll = '';
            $assign_student->save();
            //Discount Student
            $discount_student = new DiscountStudent();
            $discount_student->assign_student_id = $assign_student->id;
            $discount_student->fee_category_id = 1;
            $discount_student->discount = $request->discount;
            $discount_student->save();
        });
        $notification=array(
            'messege' => "Student Promotion Successfully",
            'alert-type' => 'success'
        );
        return redirect()->route('view.student')->with($notification);

    }

    public function details($id)
    {
        $student_id = AssignStudent::where('id', $id)->first()->student_id;
        $data['details'] = AssignStudent::with('user', 'discount_student')->where('student_id', $student_id)->where('id', $id)->first();
        $pdf = PDF::loadView('backend.student.student_reg.student_details_pdf', $data);
        return $pdf->stream('document.pdf');
    }
}
