<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SettingsController extends Controller
{
    public function show()
    {
        $settings = DB::table('settings')->first();
        return view('backend.settings.view', compact('settings'));
    }

    public function update(Request $request)
    {
        DB::table('settings')->update(
            [
                'working_days' => $request->working_days
            ]
        );

        $notification=array(
            'messege' => "Settings Updated Successfully",
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
}
