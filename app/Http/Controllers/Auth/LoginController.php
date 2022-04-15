<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request)
    {
        $this->validateLogin($request);

        $type =  filter_var($request->input('email'), FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        $credentials = [
            $type => $request->input('email'),
            'password' => $request->input('password'),
        ];

        if (Auth::attempt($credentials, $request->has('remember'))) {
            return redirect()->route('home');
        } else {
            return redirect()->back()->withErrors(['email' => __('auth.failed')]);
        }
    }

    public function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return back();
    }
}
