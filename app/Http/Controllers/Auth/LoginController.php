<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use App\Http\Requests\LoginRequest;

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

    // use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    // protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */


    public function showLoginForm()
    {

        return view('Auth.auth-login2');
    }

    public function LoginPost(LoginRequest $request)
    {

        $credentials = $request->validated();

        // dd($credentials);

        // dd(Auth::attempt($credentials));

        if (Auth::attempt($credentials)) {

            $request->session()->regenerate();

            $user = Auth::getProvider()->retrieveByCredentials($credentials);

            // dd($user);

            Auth::login($user);

            if (Auth::user()->hasRole('Administrator')) {
                return redirect()->route('dashboard.admin');
            }

            if (Auth::user()->hasRole('operator')) {

                return redirect()->route('dashboard.operator');
            }

            if (Auth::user()->hasRole('ValidatorOpsis')) {

                return redirect()->route('dashboard.validopsis');
            }

            if (Auth::user()->hasRole('ValidatorFasop')) {

                return redirect()->route('dashboard.validfasop');
            }

            if (Auth::user()->hasRole('EditorOpsis')) {

                return redirect()->route('dashboard.editorop');
            }

            if (Auth::user()->hasRole('Visitor')) {

                return redirect()->route('dashboard.visitor');
            }
        }
    }

    public function logout()
    {
        Auth::logout();

        return redirect()->route('loginform');
    }
}
