<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Penyulang;

class PenyulangController extends Controller
{
    public function index(){

        if (Auth::user()->hasRole('Administrator')) {

            $penyulang = Penyulang::all();

            // dd($penyulang);

            return view('admin.beban.penyulang', compact('penyulang'));
        } elseif (Auth::user()->hasRole('operator')) {
            
            $penyulang = Penyulang::all();

            // dd($penyulang);

            return view('Operator.beban.penyulang', compact('penyulang'));
        } elseif (Auth::user()->hasRole('Visitor')) {

            $penyulang = Penyulang::all();
        }        elseif (Auth::user()->hasRole('Visitor')) {

            $penyulang = Penyulang::all();

            // dd($penyulang);

            return view('Visitor.beban.penyulang', compact('penyulang'));
        } elseif (Auth::user()->hasRole('ValidatorFasop')) {
            
            $penyulang = Penyulang::all();

            // dd($penyulang);

            return view('Fasop.beban.penyulang', compact('penyulang'));
        }elseif (Auth::user()->hasRole('ValidatorOpsis')) {
            
            $penyulang = Penyulang::all();

            // dd($penyulang);

            return view('Opsis.beban.penyulang', compact('penyulang'));
    }
            }

    public function detail($id){
        if(Auth::user()->hasRole('Administrator')){
            $data = Penyulang::findOrFail($id);
            
            return view('admin.beban.Penyulang.detail',compact('data'));
        }elseif(Auth::user()->hasRole('Visitor')){


        }elseif(Auth::user()->hasRole('EditorOpsis')){

        }elseif(Auth::user()->hasRole('ValidatorFasop')){
            $data = Penyulang::findOrFail($id);
            
            return view('Fasop.beban.Penyulang.detail',compact('data'));   
                    
        }elseif(Auth::user()->hasRole('operator')){
            
            $data = Penyulang::findOrFail($id);
            
            return view('Operator.beban.Penyulang.detail',compact('data'));

        }
    }

}
