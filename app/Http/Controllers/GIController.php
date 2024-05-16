<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\GITable;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\GIExport;

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

        }elseif (Auth::user()->hasRole('ValidatorOpsis')) {
            # code...

            $GI = GITable::all();

            // dd($GI);

            return view('Opsis.beban.GI',compact('GI'));
        }
    }

    public function detail($id){

        if(Auth::user()->hasRole(['Administrator', 'Visitor', 'EditorOpsis', 'ValidatorFasop', 'operator', 'ValidatorOpsis'])){
            $data = GITable::findOrFail($id);

            return view('TabelBeban.gi.detail',compact('data'));
        }
    }

    public function Export()
    {

        return Excel::download(new GIExport, 'data_GI.xlsx');
    
    }

}
