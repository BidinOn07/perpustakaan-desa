<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller

{
    public function index()
    {
        return view('auten/login',[
            'title' => 'Login',
            'active' => 'login',

        ]);
    }
        public function authenticate (Request $request){
            $request->validate([
                'email' => 'required|email:dns',
                'password' => 'required|min:5'
            ]);

            $credentials = $request->only('email', 'password');

            if(Auth::attempt($credentials)){
                $request->session()->regenerate();

               return redirect()->intended('/home');
            }
            return back()->with('loginEror',"LOGIN GAGAL");
}
public function logout()
{
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();

    return redirect('/');
}

}
