<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class pegawaiController extends Controller
{
    public function index(){

        $data = User::paginate();
        return view('Pegawai.pegawai', compact('data'));
    }

    public function add_pegawai(Request $req){

        $req->validate([
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:7',
            'level' => 'required',
        ], [
            'name.required' => 'Nama Wajib diIsi!!!',
            'name.min' => 'Nama Harus Lebih Dari 3 Karakter Huruf!!!',
            'email.required' => 'Email Wajib Diisi!!!',
            'email.email' => 'Format Email Tidak Sesuai',
            'email.unique' => 'Email Sudah Terdaftar',
            'password.required' => 'Password Wajib Diisi',
            'password.min' => 'Passowrd minimal memiliki panjang 7 karakter',

        ]);

        $new = new User();
        $new-> name = $req->name;
        $new-> email = $req->email;
        $new-> password = Hash::make($req->password);
        $new-> level = $req->level;
        $new->save();

        return redirect()->back()->with('message', 'Data Pegawai ' .$req->name . ' Berhasil Ditambahkan');
        // dd($new);

    }

    public function edit($id){

        $data = User::find($id);

        return view('Pegawai.editPegawai', compact('data'));
    }

    public function edit_pegawai(Request $req, $id) {
        $req->validate([
            'name' => 'required|min:3',
            'email' => 'nullable|email',
            'password' => 'nullable|min:7',
            'level' => 'nullable',
        ], [
            'name.required' => 'Nama Wajib diIsi!!!',
            'name.min' => 'Nama Harus Lebih Dari 3 Karakter Huruf!!!',
            'email.email' => 'Format Email Tidak Sesuai',
            'password.min' => 'Password minimal memiliki panjang 7 karakter',
        ]);
    
        $user = User::find($id);
        $user->name = $req->name;
    
        // Cek apakah email yang baru diinputkan berbeda dengan yang ada di database
        if ($req->filled('email') && $req->email != $user->email) {
            // Lakukan validasi unique untuk email yang baru, jika berbeda dengan yang lama
            $req->validate([
                'email' => 'unique:users,email'
            ], [
                'email.unique' => 'Email Sudah Terdaftar',
            ]);
    
            $user->email = $req->email;
        }
    
        if ($req->filled('password')) {
            $user->password = Hash::make($req->password);
        }
    
        if ($req->filled('level')) {
            $user->level = $req->level;
        }
    
        $user->save();
    
        return redirect('/pegawai')->with('message', 'Data Pegawai ' . $req->name . ' Berhasil DiPerbaharui');
    }
    
    
}
