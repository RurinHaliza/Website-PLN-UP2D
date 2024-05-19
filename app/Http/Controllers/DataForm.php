<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\DataFormModel;
use App\Models\GITable;

class DataForm extends Controller
{
    public function index(){

        if(Auth::user()->hasRole('Administrator')){

            return view('DatForm.index');

        }

    }

    public function TambahData(){

        if(Auth::user()->hasRole('Administrator')){

            $gi = GITable::orderBy('Nama_GI','ASC')->select('Nama_GI')->get();

            // dd($gi);

            return view('DatForm.create',compact('gi'));

        }


    }

}
