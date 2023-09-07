<?php

namespace App\Http\Controllers\Backend\Employee;

use App\Http\Controllers\Controller;
use App\Model\Designation;
use App\Model\EmployeeSalary;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use niklasravnsborg\LaravelPdf\Facades\Pdf;

class EmployeeRegController extends Controller
{
    public function show()
    {
        $employees = User::where('user_type', 'Employee')->get();
        return view('backend.employee.employee_reg.view_employee', compact('employees'));
    }

    public function add()
    {
        $designations = Designation::all();
        return view('backend.employee.employee_reg.add_employee', compact('designations'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'fname' => 'required',
            'mname' => 'required',
            'mobile' => 'required|unique:users|numeric',
            'address' => 'required',
            'gender' => 'required',
            'religion' => 'required',
            'dob' => 'required',
            'designation_id' => 'required',
            'salary' => 'required|numeric',
            'join_date' => 'required',
            'image' => 'mimes:jpeg,jpg,png,PNG | max:1000',
        ]);

        DB::transaction(function () use ($request){
            $check_year = 199506;
            $employee = User::where('user_type', 'Employee')->orderBy('id_no', 'desc')->first();
            if($employee == NULL){
                $first_reg = 0;
                $employee_id = $first_reg+1;
                if($employee_id < 10){
                    $id_no = '000'.$employee_id;
                }elseif ($employee_id < 100){
                    $id_no = '00'.$employee_id;
                }elseif ($employee_id < 1000){
                    $id_no = '0'.$employee_id;
                }
                $final_id_no = $check_year.$id_no;
            }else{
                $employee = User::where('user_type', 'Employee')->orderBy('id_no', 'desc')->first()->id_no;
                $employee_id = $employee+1;
                $final_id_no = $employee_id;
            }

            $code = rand(0000,9999);
            $user = new User();
            $user->id_no = $final_id_no;
            $user->user_type = 'Employee';
            $user->code = $code;
            $user->password = bcrypt($code);
            $user->name = $request->name;
            $user->fname = $request->fname;
            $user->mname = $request->mname;
            $user->mobile = $request->mobile;
            $user->address = $request->address;
            $user->gender = $request->gender;
            $user->religion = $request->religion;
            $user->designation_id = $request->designation_id;
            $user->salary = $request->salary;
            $user->about = $request->about;
            $user->dob = date('Y-m-d', strtotime($request->dob));
            $user->join_date = date('Y-m-d', strtotime($request->join_date));
            $image = $request->file('image');
            //Employee Image
            if($image){
                $image_name = hexdec(uniqid());
                $ext = strtolower($image->getClientOriginalExtension());
                $image_fill_name = $image_name . '.' . $ext;
                $upload_path = 'public/backend/upload/employees/';
                $image_url = $upload_path . $image_fill_name;
                $success = $image->move($upload_path, $image_fill_name);
                $user->image = $image_url;
            }
            $user->save();
            //End User
            $employee_salary = new EmployeeSalary();
            $employee_salary->employee_id  = $user->id;
            $employee_salary->previous_salary  = $request->salary;
            $employee_salary->present_salary  = $request->salary;
            $employee_salary->increment_salary  = '0';
            $employee_salary->effected_date  = date('Y-m-d', strtotime($request->join_date));
            $employee_salary->save();
        });
        $notification=array(
            'messege' => "Employee Added Successfully",
            'alert-type' => 'success'
        );
        return redirect()->route('view.employee')->with($notification);

    }

    public function edit($id)
    {
        $designations = Designation::all();
        $employee = User::find($id);
        return view('backend.employee.employee_reg.edit_employee', compact('employee', 'designations'));
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
            'designation_id' => 'required',
            'image' => 'mimes:jpeg,jpg,png,PNG | max:1000',
        ]);

        $user = User::find($id);
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
        $user->designation_id = $request->designation_id;
        $user->about = $request->about;
        $user->dob = date('Y-m-d', strtotime($request->dob));
        $image = $request->file('image');
        if($image){
            $image_name = hexdec(uniqid());
            $ext = strtolower($image->getClientOriginalExtension());
            $image_fill_name = $image_name . '.' . $ext;
            $upload_path = 'public/backend/upload/employees/';
            $image_url = $upload_path . $image_fill_name;
            $success = $image->move($upload_path, $image_fill_name);
            if($success){
                $user->image = $image_url;
                $img = User::find($id);
                if ($img->image) {
                    $done = unlink($img->image);
                }
            }
        }
        $user->save();

        $notification=array(
            'messege' => "Employee Updated Successfully",
            'alert-type' => 'success'
        );
        return redirect()->route('view.employee')->with($notification);
    }

    public function details($id){
        $data['details'] = User::find($id);
        $pdf = Pdf::loadView('backend.employee.employee_reg.employee_details_pdf', $data);
        return $pdf->stream('document.pdf');
    }
}
