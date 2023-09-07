<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
        $data['students'] = User::where('user_type', 'Student')->count();
        $data['teachers'] = User::where('user_type', 'Employee')->count();

    	return view('backend.home', $data);
    }
}
