<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Model\Headline;
use App\Model\MainDescription;
use App\Model\Slider;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $data['headline'] = Headline::first();
        $data['main_description'] = MainDescription::first();
        $data['sliders'] = Slider::get();
        return view('frontend.home', $data);
    }
}
