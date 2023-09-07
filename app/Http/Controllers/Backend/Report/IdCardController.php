<?php

namespace App\Http\Controllers\Backend\Report;

use App\Http\Controllers\Controller;
use App\Model\AssignStudent;
use App\Model\StudentClass;
use App\Model\Year;
use Illuminate\Http\Request;
use niklasravnsborg\LaravelPdf\Facades\Pdf;

class IdCardController extends Controller
{
    public function show()
    {
        $data['years'] = Year::latest()->get();
        $data['classes'] = StudentClass::all();
        return view('backend.report.student_id_card.view_id_card', $data);
    }

    public function get_id_card(Request $request)
    {
        $year_id = $request->year_id;
        $class_id = $request->class_id;
        $check_data = AssignStudent::where('class_id', $class_id)->where('year_id', $year_id)->first();
        if ($check_data == true) {
            $data['all_data'] = AssignStudent::where('class_id', $class_id)->where('year_id', $year_id)->orderBy('roll', 'ASC')->get();
            $pdf = PDF::loadView('backend.report.student_id_card.id_card_pdf', $data);
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
