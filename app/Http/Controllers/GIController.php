<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\GITable;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\GIExport;

class GIController extends Controller
{
    public function index()
    {
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
        } elseif (Auth::user()->hasRole('ValidatorOpsis')) {
            # code...

            $GI = GITable::all();

            // dd($GI);

<<<<<<< HEAD
            return view('Opsis.beban.GI', compact('GI'));
        } elseif (Auth::user()->hasRole('Manager')) {
=======
            return view('Opsis.beban.GI',compact('GI'));
        }elseif (Auth::user()->hasRole('EditorOpsis')) {
            # code...

            $GI = GITable::all();

            // dd($GI);

            return view('EditorOpsis.beban.GI',compact('GI'));
        }elseif (Auth::user()->hasRole('Manager')) {
>>>>>>> 39104fafd13ca4da1227a7198cc1de7421e785d2
            # code...

            $GI = GITable::all();

            // dd($GI);

            return view('Manager.beban.GI', compact('GI'));
        } elseif (Auth::user()->hasRole('EditorOpsis')) {
            # code...

            $GI = GITable::all();

            // dd($GI);

            return view('EditorOpsis.beban.GI', compact('GI'));
        }
    }

    public function detail($id)
    {

        if (Auth::user()->hasRole(['Administrator', 'operator', 'Visitor', 'EditorOpsis', 'ValidatorFasop', 'operator', 'ValidatorOpsis', 'Manager'])) {
            $data = GITable::findOrFail($id);

            return view('TabelBeban.gi.detail', compact('data'));
        }
    }

    public function Export()
    {

        return Excel::download(new GIExport, 'data_GI.xlsx');
    }
}
