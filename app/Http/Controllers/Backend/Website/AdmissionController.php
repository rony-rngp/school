<?php

namespace App\Http\Controllers\Backend\Website;

use App\Http\Controllers\Controller;
use App\Model\Admission;
use Illuminate\Http\Request;

class AdmissionController extends Controller
{
    public function show()
    {
        $admission = Admission::latest()->get();
        return view('backend.website.admission.view_admission', compact('admission'));
    }

    public function details($id){
        $admission = Admission::find($id);
        return view('backend.website.admission.details_admission', compact('admission'));
    }

    public function destroy(Request $request){
        $admission = Admission::find($request->id);
        if(file_exists($admission->image)){
            unlink($admission->image);
        }
        $admission->delete();

        $notification=array(
            'messege' => "Admission Successfully",
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
}
