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
        } 
        elseif (Auth::user()->hasRole('Visitor')) {

            $trafo = trafo::all();

            return view('Visitor.beban.trafo', compact('trafo'));
        } 
        elseif (Auth::user()->hasRole('ValidatorFasop')) {

            $trafo = trafo::all();

            return view('Fasop.beban.trafo', compact('trafo'));
        }
        elseif (Auth::user()->hasRole('ValidatorOpsis')) {

            $trafo = trafo::all();

            return view('Opsis.beban.trafo', compact('trafo'));
        }

    }

    public function detail($id){

        if(Auth::user()->hasRole('Administrator')){

            $data = trafo::findOrFail($id);
            
            return view('admin.beban.Trafo.Detail',compact('data'));


        }elseif(Auth::user()->hasRole('Visitor')){


        }elseif(Auth::user()->hasRole('EditorOpsis')){

        }elseif(Auth::user()->hasRole('ValidatorFasop')){
            $data = trafo::findOrFail($id);
            
            return view('Fasop.beban.Trafo.Detail',compact('data'));

        }
        elseif(Auth::user()->hasRole('operator')){
            
            $data = trafo::findOrFail($id);
            
            return view('Operator.beban.Trafo.Detail',compact('data'));

        }
        elseif(Auth::user()->hasRole('ValidatorOpsis')){
        $data = trafo::findOrFail($id);
        
        return view('Opsis.beban.Trafo.Detail',compact('data'));

            }

    }

}
