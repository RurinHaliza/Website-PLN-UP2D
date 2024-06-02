<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\status_beban;
use Illuminate\Support\Facades\Auth;
use App\Models\data_beban_puncak30;

class OperatorController extends Controller
{
    public function ScadaFailIndex(){

        if(Auth::user()->hasRole('operator')){

            $get = status_beban::orderBy('id','ASC')->get();

            return view('Operator.ScadaFail.input',compact('get'));
        }

    }

    public function editDataFail($id){

        if(Auth::user()->hasRole('operator')){

            $data = data_beban_puncak30::where('feeder_pkey',$id)->first();

            // dd($data);            

            return view('Operator.ScadaFail.edit',compact('data'));

        }

    }

}
