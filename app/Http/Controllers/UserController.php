<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
// use Session;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        if (Auth::user()->hasRole('Administrator')) {
            //get posts
            $users = User::all();
            $roles = Role::all();
            //render view with posts
            return view('admin.createuser', compact('users', 'roles'));
        }
    }

    public function actionregister(Request $request)
    {
        if (Auth::user()->hasRole('Administrator')) {
            //validate form
            $this->validate($request, [
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users',
                'password'   => 'required|min:8',
            ]);
            //create post
            $users = User::create([
                'email' => $request->email,
                'name' => $request->name,
                'password' => $request->password,
                'role' => $request->role
            ]);

            if ($request->role == 'operator') {

                $users->attachRole('operator');
            }elseif ($request->role == 'ValidatorOpsis') {

                $users->attachRole('ValidatorOpsis');
            }elseif ($request->role == 'ValidatorFasop') {

                $users->attachRole('ValidatorFasop');
            }
            elseif ($request->role == 'EditorOpsis') {

                $users->attachRole('EditorOpsis');
            }
            elseif ($request->role == 'Visitor') {

                $users->attachRole('Visitor');
            }
            elseif ($request->role == 'Administrator') {

                $users->attachRole('Administrator');
            }


            //redirect to index
            Session::flash('message', 'Register Berhasil. Akun Anda sudah Aktif silahkan Login menggunakan username dan password.');
            return redirect()->route('createuser.index');
        }
    }
}
