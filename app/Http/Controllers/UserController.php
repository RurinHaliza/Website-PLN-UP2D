<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;
use Session;

class UserController extends Controller
{
        /**
     * index
     *
     * @return void
     */
    public function index()
    {
        //get posts
        $users = User::all();
        $roles = Role::all();
        //render view with posts
        return view('admin.createuser', compact('users','roles'));
    }

    public function actionregister(Request $request)
    {
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
            'password' => Hash::make($request->password),
            'role' => $request->role
        ]);

        //redirect to index
        Session::flash('message', 'Register Berhasil. Akun Anda sudah Aktif silahkan Login menggunakan username dan password.');
        return redirect()->route('createuser.index');
    }

}
