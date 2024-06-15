<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\status_beban;
use App\Models\data_beban_puncak30;

class OpsisController extends Controller
{
    public function index(){

        if(Auth::user()->hasRole(['ValidatorOpsis','ValidatorFasop'])){

            return view('Opsis.Approaval.index');

        }

    }
}
