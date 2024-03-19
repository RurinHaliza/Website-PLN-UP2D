<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {

        if (Auth::user()->hasRole('Administrator')) {

            return view('admin.Dashboard');

        }elseif(Auth::user()->hasRole('operator')){

            return view('Operator.Dashboard');

        }elseif(Auth::user()->hasRole('ValidatorOpsis')){

            return view('Opsis.Dashboard');

        }elseif(Auth::user()->hasRole('ValidatorFasop')){

            return view('Fasop.Dashboard');

        }elseif(Auth::user()->hasRole('EditorOpsis')){

            return view('EditorOpsis.Dashboard');

        }elseif(Auth::user()->hasRole('Visitor')){

            return view('Visitor.Dashboard');

        }

    }
}
