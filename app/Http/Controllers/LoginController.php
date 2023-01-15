<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index(){
        return view('login', [
            "title" => 'login'
        ]);
    }

    public function authenticate(Request $request){

        $credential = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        
        if(Auth::attempt($credential)){
            $request->session()->regenerate();
            // if (auth()->user()->role_id == 1) {
            //     # code...
            //     return redirect()->intended('/dashboard');
            // } else {
                # code...
                // return redirect()->intended('/user');
            // }
        }
        return back()->with('error', "email atau password salah");
    }

    public function logout(Request $request){
        Auth::logout();
 
        $request->session()->invalidate();
 
        $request->session()->regenerateToken();
     
        return redirect('/login');
    }
}
