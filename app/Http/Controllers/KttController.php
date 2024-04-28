<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\ktt;

class KTTController extends Controller
{
    public function index(){

        if (Auth::user()->hasRole('Administrator')) {

            $bebanktt = ktt::all();
            //dd($bebanktt);
            return view('admin.beban.ktt', compact('bebanktt'));
        } elseif (Auth::user()->hasRole('operator')) {

            $bebanktt = ktt::all();
            //dd($bebanktt);
            return view('Operator.beban.ktt', compact('bebanktt'));
        } elseif (Auth::user()->hasRole('Visitor')) {

            $bebanktt = ktt::all();
            //dd($bebanktt); 
            return view('Visitor.beban.ktt', compact('bebanktt'));
        }

    }

    public function Detail($id){

        if(Auth::user()->hasRole('Administrator')){
            $data = ktt::findOrFail($id);
            
            return view('admin.beban.KTT.detail',compact('data'));

        }elseif(Auth::user()->hasRole('Visitor')){


        }elseif(Auth::user()->hasRole('EditorOpsis')){

        }elseif(Auth::user()->hasRole('ValidatorFasop')){
            
        }elseif(Auth::user()->hasRole('ValidatorFasop')){
            
        }elseif(Auth::user()->hasRole('operator')){
            
            $data = ktt::findOrFail($id);
            
            return view('Operator.beban.KTT.detail',compact('data'));

        }


    }

}
