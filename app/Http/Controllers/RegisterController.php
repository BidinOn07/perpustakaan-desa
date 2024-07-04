<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;


class RegisterController extends Controller
{
    public function index()
    {
        return view('auten.register',[
            'title' => 'register',
            'active' => 'register',

        ]);
    }
      public function store(Request $request)
{
    try {
        $validateData = $request->validate([
            'nama' => 'required|min:3',
            'email' => 'required|email|unique:users,email', // Memperbaiki aturan unique
            'password' => 'required|min:5'
        ]);

        $validateData['password'] = bcrypt($validateData['password']);
        User::create($validateData);

        $request->session()->flash('success', 'REGIS BERHASIL');

        return redirect('/auten/login');
    } catch (\Exception $e) {
        // Menangani kesalahan dan menampilkan pesan error
        $request->session()->flash('error', 'REGIS GAGAL: Terjadi kesalahan, silakan coba lagi.');

        return redirect()->back()->withInput();
    }
}



}
