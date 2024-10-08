<?php

namespace App\Http\Controllers;

use App\Models\barangKeluar;
use App\Models\pelanggan;
use App\Models\stok;
use App\Models\suplier;
use Illuminate\Http\Request;

class dashboardController extends Controller
{
    public function index(){

        $getSuplier = suplier::count();
        $totalPelanggan = pelanggan::count();
        $getStok = stok::count();
        $totalPendapatam = barangKeluar::sum('sub_total');
        return view('Dashboard.dashboard', compact(
            'getSuplier',
            'totalPelanggan',
            'getStok',
            'totalPendapatam',
        ));
    }

    public function DataA(){
        return view('Nota.nota');
    }

    public function data_getData(Request $request){
        
        $getData1 = $request->data1;
        $getData2 = $request->data2;
        $getData3 = $request->data3;

        return view('Z-testing.show', compact(
            'getData1',
            'getData2',
            'getData3',
        ));

    }
    // public function testGetData(){

    // }
    public function testGetData_Process(Request $req){

        $req = [
            'getData1' => $req->data1,
            'getData2' => $req->data2,
            'getData3' => $req->data3,
            'getData4' => $req->data4,
            'getData5' => $req->data5,
            'getData6' => $req->data6,
        ];

        dd($req);


    }
}
