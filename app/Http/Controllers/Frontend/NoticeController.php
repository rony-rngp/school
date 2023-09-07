<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Model\Notice;
use Illuminate\Http\Request;

class NoticeController extends Controller
{
    public function index()
    {
        $notices = Notice::orderBy('id', 'desc')->paginate(5);
        return view('frontend.noticeboard.noticeboard', compact('notices'));
    }

    public function singe_notice($slug, $id)
    {
        $single_notice = Notice::where('id', $id)->where('slug', $slug)->first();
        return view('frontend.noticeboard.single_noticeboard', compact('single_notice'));
    }
}
