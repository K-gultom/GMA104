<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class secondController extends Controller
{
    public function operasi(){

        $nilaiA = 100;
        $nilaiB = 100;
        
        $nilaiC = 100;

        /**
         * Operator-operator 
         */

        //Operator aritmatika
        /**
         * Penjumlahan (+)
         * Pengurangan (-)
         * Perkalian (*)
         * Pembagian (/)
         */
        $penjumlahan = $nilaiA + $nilaiB;
        $pengurangan = $nilaiA - $nilaiB;
        $perkalian = $nilaiA * $nilaiB;
        $pembagian = $nilaiA / $nilaiB;
        
        echo "<p>Operator Penjumlahan</p>" . $penjumlahan . "<br>";
        echo "<p>Operator Pengurangan</p>" . $pengurangan . "<br>";
        echo "<p>Operator Perkalian</p>" . $perkalian . "<br>";
        echo "<p>Operator Pembagian</p>" . $pembagian . "<br>";

        //Operator Pengkondisian
        /**
         * if Else
         */
        if ($nilaiA != 100) {
            echo "Saya Kiel";

        }else {

            echo "Nilai anda salah" . "<br>";
        }


        if ($nilaiB == 50) {
            echo "NilaiB = 50";
        } elseif ($nilaiB == 100) {
            echo "NilaiB = 100";
        }else {
            echo "Nilai Salah";
        }
        
         //Operator Perbandingan
         /**
          * And (&&)
          * Or (||)
          * Not Or (!=) 
          */
        
    }
}
