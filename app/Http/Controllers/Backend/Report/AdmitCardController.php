<?php

namespace App\Http\Controllers\Backend\Report;

use App\Model\Year;
use App\Model\StudentClass;
use App\Model\AssignStudent;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\ExamType;
use niklasravnsborg\LaravelPdf\Facades\Pdf;

class AdmitCardController extends Controller
{
    public function show()
    {
        $data['years'] = Year::latest()->get();
        $data['classes'] = StudentClass::all();
        $data['exam_types'] = ExamType::all();
        return view('backend.report.student_admit_card.view_admit_card', $data);
    }


    public function get_admit_card(Request $request)
    {
        $year_id = $request->year_id;
        $class_id = $request->class_id;
        $data['exam_type'] = ExamType::where('id', $request->exam_type_id)->first()->name;
        $check_data = AssignStudent::where('class_id', $class_id)->where('year_id', $year_id)->first();
        if ($check_data == true) {
            $data['all_data'] = AssignStudent::with('user','year','class')->where('class_id', $class_id)->where('year_id', $year_id)->orderBy('roll', 'ASC')->get();
            $pdf = Pdf::loadView('backend.report.student_admit_card.admit_card_pdf', $data);
            return $pdf->stream('document.pdf');
        } else {
            $notification = array(
                'messege' => "Sorry ! These criteria does not match",
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }
    }
}
