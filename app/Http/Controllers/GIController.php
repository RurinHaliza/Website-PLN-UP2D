<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\GITable;

class GIController extends Controller
{
    public function index(){
        if (Auth::user()->hasRole('Administrator')) {

            $GI = GITable::all();
            // dd($GI);
            return view('admin.beban.GI', compact('GI'));
        } elseif (Auth::user()->hasRole('operator')) {

            $GI = GITable::all();
            // dd($GI);
            return view('Operator.beban.GI', compact('GI'));
        } elseif (Auth::user()->hasRole('Visitor')) {

            $GI = GITable::all();
            // dd($GI);
            return view('Visitor.beban.GI', compact('GI'));
        } elseif (Auth::user()->hasRole('ValidatorFasop')) {
            $GI = GITable::all();
            // dd($GI);
            return view('Fasop.beban.GI', compact('GI'));

        }
    }

    public function detail($id){

        if(Auth::user()->hasRole('Administrator')){
            $data = GITable::findOrFail($id);
            
            return view('admin.beban.gi.detail',compact('data'));

        }elseif(Auth::user()->hasRole('Visitor')){


        }elseif(Auth::user()->hasRole('EditorOpsis')){
            $data = GITable::findOrFail($id);
            
            return view('EditorOpsis.beban.gi.detail',compact('data'));

        }elseif(Auth::user()->hasRole('ValidatorFasop')){
            $data = GITable::findOrFail($id);
            
            return view('Fasop.beban.gi.detail',compact('data'));
            
        }elseif(Auth::user()->hasRole('operator')){
            
            $data = GITable::findOrFail($id);
            
            return view('Operator.beban.gi.detail',compact('data'));

        }


    }

}
