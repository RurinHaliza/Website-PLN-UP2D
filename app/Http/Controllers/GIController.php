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

            return view('Opsis.beban.GI', compact('GI'));
        } elseif (Auth::user()->hasRole('Manager')) {
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

    public function store(Request $request){
        
        if(Auth::user()->hasRole(['Administrator', 'operator', 'Visitor', 'EditorOpsis', 'ValidatorFasop', 'operator', 'ValidatorOpsis', 'Manager'])){

            $store = new GITable();
            $store->ID_FGI = $request->id_gi;
            $store->Nama_GI = $request->nama_gi;
            $store->NAMA_SINGKATAN = $request->nama_singkatan;
            $store->KD_Pemilik = $request->kd_pemilik;
            $store->KD_Pengelola = $request->kd_pengelola;
            $store->tingkat_resiko = $request->tingkat_resiko;
            $store->x = $request->latt;
            $store->y = $request->long;

            if($store){

                return redirect()->back()->with(['success' => 'Data berhasil di tambahkan'],200);

            }else{
                return redirect()->back()->with(['success' => 'Data gagal di tambahkan'],401);
            }

        }
    }

    public function edit($id){

        if(Auth::user()->hasRole(['Administrator', 'operator', 'Visitor', 'EditorOpsis', 'ValidatorFasop', 'operator', 'ValidatorOpsis', 'Manager'])){

            $edit = GITable::findOrFail($id);
            
        }

    }

    public function update(Request $request,$id){

        if(Auth::user()->hasRole(['Administrator', 'operator', 'Visitor', 'EditorOpsis', 'ValidatorFasop', 'operator', 'ValidatorOpsis', 'Manager'])){

            $update = GITable::where('id',$id)->update([
                'ID_FGI '=> $request->id_gi,
                'Nama_GI' => $request->nama_gi,
                'NAMA_SINGKATAN' => $request->nama_singkatan,
                'KD_Pemilik' => $request->kd_pemilik,
                'KD_Pengelola' => $request->kd_pengelola,
                'tingkat_resiko' => $request->tingkat_resiko,
                'x' => $request->latt,
                'y' => $request->long,
            ]);            
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
