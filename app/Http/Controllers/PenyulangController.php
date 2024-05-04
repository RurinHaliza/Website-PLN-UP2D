<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Penyulang;

class PenyulangController extends Controller
{
    public function index()
    {

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

            return view('Visitor.beban.penyulang',compact('penyulang'));


        } elseif (Auth::user()->hasRole('Visitor')) {

            $penyulang = Penyulang::all();

            // dd($penyulang);

            return view('Visitor.beban.penyulang', compact('penyulang'));
        } elseif (Auth::user()->hasRole('ValidatorFasop')) {

            $penyulang = Penyulang::all();

            // dd($penyulang);

            return view('Fasop.beban.penyulang', compact('penyulang'));
        } elseif (Auth::user()->hasRole('ValidatorOpsis')) {

            $penyulang = Penyulang::all();

            // dd($penyulang);

            return view('Opsis.beban.penyulang', compact('penyulang'));
        }
    }

    public function detail($id)
    {
        if (Auth::user()->hasRole(['Administrator', 'Visitor', 'EditorOpsis', 'ValidatorFasop', 'operator', 'ValidatorOpsis'])) {
            $data = Penyulang::findOrFail($id);

            return view('TabelBeban.Penyulang.detail', compact('data'));
        } 
    }

    public function editPenyulang($id)
    {

        if (Auth::user()->hasRole('Administrator')) {

            $data = Penyulang::findOrFail($id);

            // dd($data);

            return view('admin.beban.Penyulang.edit', compact('data'));
        }
    }

    public function update(Request $request,$id)
    {

        if (Auth::user()->hasRole('Administrator')) {

            $req = $request->all();

            $update = Penyulang::where('id', $id)->update([

                'ID_JTM' => $request->ID_JTM,
                'ID_GI' => $request->ID_GI,
                'ID_TRAFOGI' => $request->ID_TRAFOGI,
                'NM_JTM' => $request->NM_JTM,
                'NM_GI' => $request->NM_GI,
                'NM_SINGKATAN' => $request->NM_SINGKATAN,
                'UP3' => $request->UP3,
                'ULP' => $request->ULP,
                
            ]);

            if ($update) {
                return redirect()->route('bebanpenyulang')->with('success', 'Data Berhasil di update');
            }
        }
    }
}
