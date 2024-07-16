<?php

namespace App\Http\Controllers;

use App\Models\pelanggan;
use Illuminate\Http\Request;

class pelangganController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $r)
    {
        $search = $r->input('search');
        
        $getData = pelanggan::where('nama_pelanggan', 'like', "%{$search}%")
        ->orWhere('telp', 'like', "%{$search}%")
        ->paginate();
        return view('Pelanggan.pelanggan', compact('getData'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Pelanggan.addPelanggan');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_pelanggan' => 'required|min:3',
            'telp' => 'required|numeric',
            'jenis_kelamin' => 'required',
            'alamat' => 'required',
            'kota' => 'required',
            'provinsi' => 'required',
        ], [
            'nama_pelanggan.required' => 'Data Wajib Diisi',
            'telp.required' => 'Data Wajib Diisi',
            'jenis_kelamin.required' => 'Data Wajib Diisi',
            'alamat.required' => 'Data Wajib Diisi',
            'kota.required' => 'Data Wajib Diisi',
            'provinsi.required' => 'Data Wajib Diisi',
        ]);

        $saveData = new pelanggan();
        $saveData-> nama_pelanggan = $request->nama_pelanggan;
        $saveData-> telp = $request->telp;
        $saveData-> jenis_kelamin = $request->jenis_kelamin;
        $saveData-> alamat = $request->alamat;
        $saveData-> kota = $request->kota;
        $saveData-> provinsi = $request->provinsi;
        $saveData -> save();

        return redirect('/pelanggan')->with('message', 'Data Pelanggan Berhasil Disimpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $getPelanggan = pelanggan::find($id);

        return view('Pelanggan.editPelanggan', compact('getPelanggan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_pelanggan' => 'required|min:3',
            'telp' => 'required|numeric',
            'jenis_kelamin' => 'required',
            'alamat' => 'required',
            'kota' => 'required',
            'provinsi' => 'required',
        ], [
            'nama_pelanggan.required' => 'Data Wajib Diisi',
            'telp.required' => 'Data Wajib Diisi',
            'jenis_kelamin.required' => 'Data Wajib Diisi',
            'alamat.required' => 'Data Wajib Diisi',
            'kota.required' => 'Data Wajib Diisi',
            'provinsi.required' => 'Data Wajib Diisi',
        ]);

        $updateData = pelanggan::find($id);
        $updateData-> nama_pelanggan = $request->nama_pelanggan;
        $updateData-> telp = $request->telp;
        $updateData-> jenis_kelamin = $request->jenis_kelamin;
        $updateData-> alamat = $request->alamat;
        $updateData-> kota = $request->kota;
        $updateData-> provinsi = $request->provinsi;
        $updateData -> save();

        return redirect('/pelanggan')->with('message', 'Data Pelanggan Berhasil Diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        $deleteData = pelanggan::find($id);
        $deleteData->delete();
        
        return redirect()->back()->with('message', 'Data Pelanggan Berhasil Dihapus');
    }
}
