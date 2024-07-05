<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class stokController extends Controller
{
    public function index(){

        return view('Stok.stok');
    }
}
