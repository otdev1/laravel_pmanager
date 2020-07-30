<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
// use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;


class PmLoginController extends Controller
{
    public function show()
    {
        if( Auth::check() ){
            
            return redirect()->route('home');
        }
        else{
            
            return view('auth.login');
        }
    }

    public function authenticate(Request $request)
    {
        $validator = $request->validate([
            'email'     => 'required',
            'password'  => 'required|min:6'
        ]);

        if( Auth::attempt($validator) ){

            session()->flash('success', 'Log in successful');

            return redirect()->route('home');

        }   
    }
}
