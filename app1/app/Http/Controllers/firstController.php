<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class firstController extends Controller
{
    
    public function index(){

        // String
        $name = "Kiel";

        // Number
        $angka1 = 20; //integer
        $angka2 = 12.5; //float (desimal)

        $boolean1 = true;
        $boolean2 = false;

        echo $name . "<br>";
        echo $angka1 . "<br>";
        echo $angka2 . "<br>";
        echo $boolean1 . "<br>";
        echo $boolean2 . "<br>";

        $hasil = $angka1 + $angka2 . "<br>";

        $hasil2 = $boolean1 + $boolean2;

        echo $hasil;
        echo $hasil2;
    }
}
