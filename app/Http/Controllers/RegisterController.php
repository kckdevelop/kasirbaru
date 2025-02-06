<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function index()
    {
        return view('register.index');
    }

    public function store(Request $request)
    {
        $request->validate
        ([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
        ],[
            'name.required' => 'Nama Tidak Boleh Kosong!',
            'email.required' => 'Email Tidak Boleh Kosong!',
            'email.email' => 'Format Email Tidak Benar!',
            'password.required' => 'Password Tidak Boleh Kosong!',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        session()->flash('sukses', 'Akun Berhasil DIbuat!');
        return redirect()->route('register');
    }
}
