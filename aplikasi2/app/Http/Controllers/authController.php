<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class authController extends Controller
{
    
    public function index(){
        return view('Auth.login');
    }

    public function login_proses(Request $request)
    {
        $request->validate([
            "email" => 'required|max:50|email|exists:users,email',
            "password" => 'required|min:7',
        ], [
            'email.required' => 'Email wajib diisi.',
            'email.max' => 'Email tidak boleh lebih dari 50 karakter.',
            'email.email' => 'Format email tidak valid.',
            'email.exists' => 'Email Tidak Sesuai',
            'password.required' => 'Password wajib diisi.',
            'password.min' => 'Password harus minimal 7 karakter.',
        ]);

        $user = User::where('email',$request->email)->first();

        $infoLogin = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        if (Auth::attempt($infoLogin)) {
            return redirect('/dashboard');

        }else{
            
            return redirect()->back()->withErrors(['password' => 'Password is Invalid']);

        }
    }

    public function logout(){

        Auth::logout();
        return redirect('/');
    }

}
