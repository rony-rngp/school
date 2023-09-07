<?php

namespace App\Http\Controllers\Backend\Website;

use App\Http\Controllers\Controller;
use App\Model\Headline;
use Illuminate\Http\Request;

class HeadlineController extends Controller
{
    public function show()
    {
        $headline = Headline::all();
        return view('backend.website.headline.view_headline', compact('headline'));
    }

    public function edit($id)
    {
        $headline = Headline::find($id);
        return view('backend.website.headline.edit_headline', compact('headline'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
           'headline' => 'required|min:10'
        ]);

        $headline = Headline::find($id);
        $headline->headline = $request->headline;
        $headline->save();

        $notification=array(
            'messege' => "Headline Updated Successfully",
            'alert-type' => 'success'
        );
        return redirect()->route('view.headline')->with($notification);
    }
}
