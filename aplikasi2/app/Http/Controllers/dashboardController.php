<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class dashboardController extends Controller
{
    public function index(){
        return view('Dashboard.dashboard');
    }

    public function DataA(){
        return view('data-a');
    }
}
