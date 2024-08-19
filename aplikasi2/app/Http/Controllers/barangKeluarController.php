<?php

namespace App\Http\Controllers;

use App\Models\barangKeluar;
use App\Models\pelanggan;
use App\Models\stok;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class barangKeluarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        
         // Start a query on the BarangMasuk model with related models
         $query = barangKeluar::with('getUser','getPelanggan', 'getStok');
        
         // Apply date range filter if both dates are provided
         if ($request->filled('tanggal_awal') && $request->filled('tanggal_akhir')) {
             $query->whereBetween('tgl_buat', [$request->tanggal_awal, $request->tanggal_akhir]);
         }
 
         // Order the results by tanggal_faktur in ascending order
         $query->orderBy('created_at', 'desc');
 
         // Paginate the results, e.g., 10 items per page
         $getBarangKeluar = $query->paginate(15);
         
        $getTotalPendapatan = barangKeluar::sum('sub_total');

        // dd($getTotalPendapatan);
        return view('Barang.BarangKeluar.barangKeluar', compact('getBarangKeluar', 'getTotalPendapatan'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = barangKeluar::all();

        // Get the last id in the table
        $lastId = barangKeluar::max('id');
        $lastId = $lastId ? $lastId : 0; // If no data exists, start from 0

        // Handle case where there is no data yet
        if ($data->isEmpty()) {
            $nextId = $lastId + 1;
            $date = now()->format('d/m/y');
            $kode_transaksi = 'TRK' . $nextId . '/' . $date;
            $pelanggan = pelanggan::all();

            return view('Barang.BarangKeluar.addBarangKeluar', compact('data', 'kode_transaksi', 'pelanggan'));
        }

        // Get the latest item and generate kode_transaksi
        $latestItem = barangKeluar::latest()->first();
        $id = $latestItem->id;
        $date = $latestItem->created_at->format('d/m/y');
        $kode_transaksi = 'TRK' . ($id + 1) . '/' . $date;

        $pelanggan = pelanggan::all();

        return view('Barang.BarangKeluar.addBarangKeluar', compact('data', 'kode_transaksi', 'pelanggan'));
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
            'tgl_faktur' => 'required',
            'tgl_jatuh_tempo' => 'required',
            'pelanggan_id' => 'required',
            'jenis_pembayaran' => 'required',
        ], [
            'tgl_faktur.required' => 'Data Wajib diisi',
            'tgl_jatuh_tempo.required' => 'Data Wajib diisi',
            'pelanggan_id.required' => 'Data Wajib diisi',
            'jenis_pembayaran.required' => 'Data Wajib diisi',
        ]);

        $kode_transaksi = $request->kode_transaksi;
        $tgl_faktur = $request->tgl_faktur;
        $tgl_jatuh_tempo = $request->tgl_jatuh_tempo;
        $pelanggan_id = $request->pelanggan_id;

        $getnamaPelanggan = pelanggan::find($pelanggan_id);
        $namaPelanggan = $getnamaPelanggan->nama_pelanggan;
        $jenis_pembayaran = $request->jenis_pembayaran;

        $getBarang = stok::all();

        // dd($kode_transaksi);
        return view('Transaksi.transaksi', 
        compact(
            'kode_transaksi',
            'tgl_faktur',
            'tgl_jatuh_tempo',
            'pelanggan_id',
            'namaPelanggan',
            'jenis_pembayaran',
            'getBarang',
        ));
    }

    public function saveProcess(Request $request){
        $request->validate([
            'kode_transaksi' => 'required',
            'tgl_faktur' => 'required',
            'tgl_jatuh_tempo' => 'required',
            'pelanggan_id' => 'required',
            'jenis_pembayaran' => 'required',
            'barang_id' => 'required',
            'jumlah_beli' => 'required',
            'harga_jual' => 'required',
        ]);

        $save = new barangKeluar();
        $save-> kode_transaksi = $request->kode_transaksi;
        $save-> tgl_faktur = $request->tgl_faktur;
        $save-> tgl_jatuh_tempo = $request->tgl_jatuh_tempo;
        $save-> pelanggan_id = $request->pelanggan_id;
        $save-> jenis_pembayaran = $request->jenis_pembayaran;
        $save-> barang_id = $request->barang_id;
        $save-> jumlah_beli = $request->jumlah_beli;

            // Update jumlah stok didalam data stok barang
            $getStokData = stok::find($request->barang_id);
                $getSumStokNow = $getStokData->stok;
            $getStokData->stok = $getSumStokNow - $request->jumlah_beli;
            $getStokData->save();

        $save-> harga_jual = $request->harga_jual;

        $diskon = $request->diskon;
        $nilaiDiskon = $diskon  / 100;
        if ($diskon) {

            $save-> diskon = $request->diskon;
            $hitung = $request->jumlah_beli * $request->harga_jual;
            $totalDiskon = $hitung * $nilaiDiskon;
            $subTotal = $hitung - $totalDiskon;

            $save-> sub_total = $subTotal; //save for sub total to database
        } else {
            $hitung = $request->jumlah_beli * $request->harga_jual;
            $save-> sub_total = $hitung; //save for sub total to database
        }
        
        $save-> user_id = Auth::user()->id;
        $save-> tgl_buat = $request->tgl_faktur;
        $save-> cabang = $request->cabang;

        // dd($kode_transaksi);
        $save->save();

        return redirect('/barang-keluar')->with('message', 'Berhasil input barang keluar');
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
        $delete = barangKeluar::find($id);
        $getIdBK = $delete->barang_id;
        $getJumlahBK = $delete->jumlah_beli;
            
            $update = stok::find($getIdBK);
            $getStok = $update->stok;

            $jumlahBaru = $getStok + $getJumlahBK;

            $update->stok = $jumlahBaru;

            // dd($update);
            $update->save();

        $delete->delete();

        return redirect('/barang-keluar')->with('message', 'Data Berhasil diHapus!!!');
    }

    public function print($id){

        $dataPrint = barangKeluar::with('getStok', 'getPelanggan')->find($id);
        // dd($dataPrint);

        return view('Nota.nota', compact('dataPrint'));
    }


}
