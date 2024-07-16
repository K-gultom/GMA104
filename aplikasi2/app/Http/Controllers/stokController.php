<?php

namespace App\Http\Controllers;

use App\Models\stok;
use App\Models\suplier;
use Illuminate\Http\Request;

class stokController extends Controller
{
    public function index(Request $r){
        $search = $r->input('search');

        $getData = stok::with('getSuplier')
        ->where('kode_barang', 'like', "%{$search}%") //fitur search
        ->orWhere('nama_barang', 'like', "%{$search}%") //fitur search
        ->paginate(25);

        return view('Stok.stok', compact('getData'));
    }

    public function add(){

        $getSuplier = suplier::all();
        return view('Stok.addStok', compact('getSuplier'));

    }

    public function add_proses(Request $req){

        $req->validate([
            'kode_barang' => 'required',
            'nama_barang' => 'required',
            'harga' => 'required',
            'stok' => 'required',
            'suplier' => 'required',
            'cabang' => 'required',
        ], [
            'kode_barang.required' => 'Data Wajib Diisi',
            'nama_barang.required' => 'Data Wajib Diisi',
            'harga.required' => 'Data Wajib Diisi',
            'stok.required' => 'Data Wajib Diisi',
            'suplier.required' => 'Data Wajib Diisi',
            'cabang.required' => 'Data Wajib Diisi',
        ]);

        $saveStok = new stok();
        $saveStok->kode_barang = $req->kode_barang;
        $saveStok->nama_barang = $req->nama_barang;
        $saveStok->harga = $req->harga;
        $saveStok->stok = $req->stok;
        $saveStok->suplier_id = $req->suplier;
        $saveStok->cabang = $req->cabang;
        $saveStok->save();

        return redirect('/stok')->with('message', 'Data Barang ' .$req->nama_barang. ' Berhasil diTambahkan');

    }

    public function edit($id){

        $getDataStokId = stok::with('getSuplier')->find($id);
        $suplier = suplier::all();

        return view('Stok.editStok', compact('getDataStokId', 'suplier'));

    }

    public function edit_proses(Request $req, $id){

        $req->validate([
            'kode_barang' => 'required',
            'nama_barang' => 'required',
            'harga' => 'required',
            'stok' => 'required',
            'suplier' => 'required',
            'cabang' => 'required',
        ], [
            'kode_barang.required' => 'Data Wajib Diisi',
            'nama_barang.required' => 'Data Wajib Diisi',
            'harga.required' => 'Data Wajib Diisi',
            'stok.required' => 'Data Wajib Diisi',
            'suplier.required' => 'Data Wajib Diisi',
            'cabang.required' => 'Data Wajib Diisi',
        ]);

        $saveStok = stok::find($id);
        $saveStok->kode_barang = $req->kode_barang;
        $saveStok->nama_barang = $req->nama_barang;
        $saveStok->harga = $req->harga;
        $saveStok->stok = $req->stok;
        $saveStok->suplier_id = $req->suplier;
        $saveStok->cabang = $req->cabang;
        $saveStok->save();

        return redirect('/stok')->with('message', 'Data Barang ' .$req->nama_barang. ' Berhasil diPerbaharui');

    }

    public function del($id){
        $getData = stok::find($id);
        $getData->delete();

        return redirect('/stok')->with('message', 'Data Barang ' .$getData->nama_barang. ' Berhasil DiHapus!!!');
    }

}
