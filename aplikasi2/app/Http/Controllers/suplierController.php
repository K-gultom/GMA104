<?php

namespace App\Http\Controllers;

use App\Models\suplier;
use Illuminate\Http\Request;

class suplierController extends Controller
{
    public function index(){

        $data = suplier::paginate();
        return view('Suplier.suplier', compact('data'));
    }

    public function add(){
        return view('Suplier.addSuplier');
    }

    public function add_Proses(Request $req){

        $req->validate([
            'nama_suplier' => 'required|min:3',
            'alamat' => 'required',
            'telp' => 'required|min:10',
            'email' => 'required|email',
            'tgl_terdaftar' => 'required|date',
            'status' => 'required',
        ],[
            'nama_suplier.required' => 'Form Wajib diIsi!',
            'alamat.required' => 'Form Wajib diIsi!',
            'telp.required' => 'Form Wajib diIsi!',
            'email.required' => 'Form Wajib diIsi!',
            'tgl_terdaftar.required' => 'Form Wajib diIsi!',
            'status.required' => 'Form Wajib diIsi!',
        ]);

        $save = new suplier();
        $save -> nama_suplier = $req->nama_suplier;
        $save -> alamat = $req->alamat;
        $save -> telp = $req->telp;
        $save -> email = $req->email;
        $save -> tgl_terdaftar = $req->tgl_terdaftar;
        $save -> status = $req->status;
        $save->save();

        return redirect('/suplier')->with('message', 'Data suplier '. $req->nama_suplier . ' berhasil ditambahkan!');
    }


    public function edit($id){

        $getData = suplier::find($id);
        return view('Suplier.editSuplier', compact('getData'));
    }

    public function edit_Proses(Request $req, $id){

        $req->validate([
            'nama_suplier' => 'required|min:3',
            'alamat' => 'required',
            'telp' => 'required|min:10',
            'email' => 'required|email',
            'tgl_terdaftar' => 'required|date',
            'status' => 'required',
        ],[
            'nama_suplier.required' => 'Form Wajib diIsi!',
            'alamat.required' => 'Form Wajib diIsi!',
            'telp.required' => 'Form Wajib diIsi!',
            'email.required' => 'Form Wajib diIsi!',
            'tgl_terdaftar.required' => 'Form Wajib diIsi!',
            'status.required' => 'Form Wajib diIsi!',
        ]);

        $save = suplier::find($id);
        $save -> nama_suplier = $req->nama_suplier;
        $save -> alamat = $req->alamat;
        $save -> telp = $req->telp;
        $save -> email = $req->email;
        $save -> tgl_terdaftar = $req->tgl_terdaftar;
        $save -> status = $req->status;
        $save->save();

        return redirect('/suplier')->with('message', 'Data suplier '. $req->nama_suplier . ' berhasil diubah!');
    }

    
    public function del($id){

        $data = suplier::find($id);
        $data->delete();

        return redirect('/suplier')->with('message', 'Data suplier '. $data->nama_suplier . ' berhasil dihapus!');
    }

}
