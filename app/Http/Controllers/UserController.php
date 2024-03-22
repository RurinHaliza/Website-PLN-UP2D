<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index(){

        if(Auth::user()->hasRole('Administrator')){

            return view('admin.User.UserIndex');

        }
    }

    public function create(){

        if(Auth::user()->hasRole('Administrator')){
            return view('admin.User.Create');
        }
    }

    public function store(Request $request){

        if(Auth::user()->hasRole('Administrator')){

            $data = $request->all();

            // dd($data);

        }

    }

}
