<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\trafo;

class TrafoController extends Controller
{
    public function index(){

        if (Auth::user()->hasRole('Administrator')) {

            $trafo = trafo::all();

            return view('admin.beban.trafo', compact('trafo'));
        } elseif (Auth::user()->hasRole('operator')) {

            $trafo = trafo::all();

            return view('Operator.beban.trafo', compact('trafo'));
        } elseif (Auth::user()->hasRole('Visitor')) {

            $trafo = trafo::all();

            return view('Visitor.beban.trafo', compact('trafo'));
        }

    }

    public function detail($id){

        if(Auth::user()->hasRole('Administrator')){

            $data = trafo::findOrFail($id);
            
            return view('admin.beban.Trafo.Detail',compact('data'));


        }elseif(Auth::user()->hasRole('Visitor')){


        }elseif(Auth::user()->hasRole('EditorOpsis')){

        }elseif(Auth::user()->hasRole('ValidatorFasop')){
            
        }elseif(Auth::user()->hasRole('ValidatorFasop')){
            
        }elseif(Auth::user()->hasRole('operator')){
            
            $data = trafo::findOrFail($id);
            
            return view('Operator.beban.Trafo.Detail',compact('data'));

        }

    }

}
