<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

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


    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function getLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'email'     => 'required|email',
            'password'  => 'required'
        ]);

        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])) {

            session()->flash('success', 'Berhasil Login.');
            return redirect()->intended('/');

        } else {

            session()->flash('error', 'Email atau Password Salah');
            return redirect()->route('login');

        }
    }

    public function logout()
    {
        Auth::logout();

        session()->flash('success', 'Logout successfully.');
        return redirect()->route('login');
    }

}
