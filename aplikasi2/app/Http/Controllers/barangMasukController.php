<?php

namespace App\Http\Controllers;

use App\Models\barangMasuk;
use App\Models\stok;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class barangMasukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // Start a query on the BarangMasuk model with related models
        $query = BarangMasuk::with('getStok', 'getSuplier', 'getAdmin');
        
        // Apply date range filter if both dates are provided
        if ($request->filled('tanggal_awal') && $request->filled('tanggal_akhir')) {
            $query->whereBetween('tanggal_faktur', [$request->tanggal_awal, $request->tanggal_akhir]);
        }

        // Order the results by tanggal_faktur in ascending order
        $query->orderBy('created_at', 'desc');

        // Paginate the results, e.g., 10 items per page
        $getData = $query->paginate(5);

        // Return the view with the paginated data
        return view('Barang.BarangMasuk.barangMasuk', compact('getData'));
    }




    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $getnama_barang_id = stok::with('getSuplier')->get(); 

        // dd($getnama_barang_id);
        return view('Barang.BarangMasuk.addBarangMasuk', compact('getnama_barang_id'));

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
            'tanggal_faktur' => 'required',
            'nama_barang_id' => 'required',
            // 'harga' => 'required',
            'jumlah' => 'required',
            'cabang' => 'required',
        ]);
        
        $UpdateStok = stok::find($request->nama_barang_id);
            // Determine the purchase price (harga_beli)
            if ($request->filled('harga')) {
                $harga_beli = $request->harga;
            } else {
                $harga_beli = $UpdateStok->harga; // Fetch the latest price from the stok model
            }

            $saveBarangMasuk = new barangMasuk();
            $saveBarangMasuk-> tanggal_faktur = $request -> tanggal_faktur;
            $saveBarangMasuk-> nama_barang_id = $request -> nama_barang_id;
            $saveBarangMasuk-> harga_beli = $harga_beli;
            $saveBarangMasuk-> jumlah_barang_masuk = $request -> jumlah;
            $saveBarangMasuk-> admin_id = Auth()->user()->id;
            $saveBarangMasuk-> cabang = $request -> cabang;
            $saveBarangMasuk->suplier_id = $UpdateStok->suplier_id;
            $saveBarangMasuk->save();

            $hitung = $UpdateStok->stok + $request->jumlah;
        $UpdateStok -> stok = $hitung;

        $UpdateStok->save();

        return redirect('/barang-masuk')->with('message', 'Data Barang Berhasil Ditambahkan');

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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $barangMasuk = barangMasuk::find($id);
            $get_Id_Stok = $barangMasuk->nama_barang_id;
            $get_Jumlah_Barang_Masuk = $barangMasuk->jumlah_barang_masuk;
            // dd($get_Jumlah_Barang_Masuk);
            // dd($nama_barang_id);

            $getItemBarang = stok::find($get_Id_Stok);
                $getStok = $getItemBarang -> stok;
                // dd($getStok);
                $update_Stok_Terbaru = $getStok - $get_Jumlah_Barang_Masuk;
                $getItemBarang -> stok = $update_Stok_Terbaru;
            $getItemBarang -> save();
        
            $barangMasuk->delete();

            

        return redirect()->back()->with('message', 'Data Barang Berhasil Dihapus');
    }
}
