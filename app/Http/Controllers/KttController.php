<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\ktt;
use App\Exports\KTTExport;
use Maatwebsite\Excel\Facades\Excel;

class KTTController extends Controller
{
    public function index()
    {

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
        } elseif (Auth::user()->hasRole('ValidatorFasop')) {

            $bebanktt = ktt::all();
            //dd($bebanktt); 
            return view('Fasop.beban.ktt', compact('bebanktt'));
        } elseif (Auth::user()->hasRole('ValidatorOpsis')) {

            $bebanktt = ktt::all();
            //dd($bebanktt); 
            return view('Opsis.beban.ktt', compact('bebanktt'));
        } elseif (Auth::user()->hasRole('EditorOpsis')) {

            $bebanktt = ktt::all();
            //dd($bebanktt); 
            return view('EditorOpsis.beban.ktt', compact('bebanktt'));
        }elseif (Auth::user()->hasRole('Manager')) {

            $bebanktt = ktt::all();
            //dd($bebanktt); 
            return view('Manager.beban.ktt', compact('bebanktt'));
        }
    }

    public function Detail($id)
    {

        if (Auth::user()->hasRole(['Administrator', 'Visitor', 'EditorOpsis', 'ValidatorFasop', 'operator', 'ValidatorOpsis'])) {
            $data = ktt::findOrFail($id);

            return view('TabelBeban.KTT.detail', compact('data'));
        }
    }

    public function Edit($id)
    {

        if (Auth::user()->hasRole('Administrator', 'EditorOpsis', 'ValidatorOpsis')) {

            $data = ktt::findOrFail($id);

            return view('TabelBeban.KTT.edit', compact('data'));
        }
    }

    public function updateData(Request $request, $id)
    {

        if (Auth::user()->hasRole('Administrator', 'EditorOpsis', 'ValidatorOpsis')) {

            $update = ktt::where('id', $id)->update([

                'pkey' => $request->pkey,
                'station' => $request->station,
                'nama' => $request->nama,
                'daya' => $request->daya,
                'alamat' => $request->alamat,
                'tanggal' => $request->tanggal,
                'cb' => $request->cb,
                'meter' => $request->meter,
                'status_meter' => $request->status_meter,
            ]);

            if ($update) {
                return redirect()->route('bebanktt')->with('success', 'Data Berhasil di update');
            }
        }
    }

    public function Export()
    {

        return Excel::download(new KTTExport, 'data_ktt.xlsx');
    }
}
