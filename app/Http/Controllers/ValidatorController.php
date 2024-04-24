<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ValidatorController extends Controller
{
    public function index(){

        if(Auth::user()->hasRole('ValidatorOpsis')){

            return view('Opsis.Approaval.index');

        }

    }
}
