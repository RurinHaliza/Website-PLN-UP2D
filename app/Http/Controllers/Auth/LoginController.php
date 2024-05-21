<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

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
            } elseif (Auth::user()->hasRole('operator')) {

                return redirect()->route('dashboard.operator');
            } elseif (Auth::user()->hasRole('ValidatorOpsis')) {

                return redirect()->route('dashboard.validopsis');
            } elseif (Auth::user()->hasRole('ValidatorFasop')) {

                return redirect()->route('dashboard.validfasop');
            } elseif (Auth::user()->hasRole('EditorOpsis')) {

                return redirect()->route('dashboard.editorop');
            } elseif (Auth::user()->hasRole('Visitor')) {

                return redirect()->route('dashboard.visitor');
            }elseif (Auth::user()->hasRole('Manager')) {

                return redirect()->route('dashboard.manager');
                
            } else {
                return view('Error.error-404');
            }
        }

        // $user = $this->getUserByEmail($data['email']);

        // if (!$user) {
        //     return response()->json([
        //         'status'    => false,
        //         'errors' => [
        //             'email' => [0 => 'Sorry, user does not exist.']
        //         ]
        //     ], 400);
        // }

        // if (!$this->isValidPassword($user, $data['password'])) {
        //     return response()->json([
        //         'status' => false,
        //         'errors' => [
        //             'password' => [0 => 'Sorry, password does not match.']
        //         ]
        //     ], 400);
        // }
    }




    public function getUserByEmail(string $email)
    {
        return $user = User::where('email', $email)->first();
    }

    public function isValidPassword(User $user, string $password)
    {
        return Hash::check($password, $user->password);
    }

    public function logout()
    {
        Auth::logout();

        return redirect()->route('loginform');
    }
}
