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
    
    public function first(){
        
        return view('firstScreen');
    }

    public function info(){
        
        // Kita Akan kenalan Materi Baru (Variabel dan Tipe Data)

        $string = "Nama saya Kiel";

        $char = 'A';

        $number1 = 100;
        $number2 = 100;

        $jumlah = $number1 + $number2;

        $desimal = 1.5;
        
        $campur = $number1 + $desimal;

        $bool1 = true;
        $bool2 = false;

        // Ini memanggil variabel menggunakan echo

        // echo $string . "<br>";
        // echo $char . "<br>";

        echo $jumlah . "<br>";
        
        echo $campur . "<br>";

        // echo $bool1 . "<br>";
        // echo $bool2 . "<br>";

    }
}
