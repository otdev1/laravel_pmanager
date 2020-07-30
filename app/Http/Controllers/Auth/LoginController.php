<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    //protected $redirectTo = '/home';

    //protected $redirectTo = 'companies';

    protected function redirectTo()
    {
        // return redirect('/companies')->with(['Logged in successfully']);
        //return '/companies';
        
      //else {
    //     return redirect('/donor');
    //   }

        session()->flash('success', 'Log in successful'); 
        // return '/companies';

        return url()->previous();
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function authenticate(Request $request)
    {
        // $credentials = $request->only('email', 'password');

        // // $credentials = $request->only('email');

        // if (Auth::attempt($credentials)) {
        //     // Authentication passed...
        //     return redirect()->intended();
        // }

        if (Auth::attempt(['email' => $request->input('name'), 'password' => $request->input('password')])) {
            // Authentication passed...
            // return redirect()->intended('/companies/1/edit');
            //return back();
            return redirect()->intended(URL::current());
        }
    }
}
