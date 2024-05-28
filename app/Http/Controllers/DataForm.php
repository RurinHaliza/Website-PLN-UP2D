<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\DataFormModel;
use App\Models\GITable;
use Carbon\Carbon;

class DataForm extends Controller
{
    public function index(){

        if(Auth::user()->hasRole('Administrator')){

            return view('DatForm.index');

        }

    }

    public function TambahData(){

        if(Auth::user()->hasRole('Administrator')){

            $gi = GITable::orderBy('Nama_GI','ASC')->select('Nama_GI')->get();

            // dd($gi);

            return view('DatForm.create',compact('gi'));

        }


    }
    public function store(Request $request)
    {
        // Validasi data yang diterima dari formulir
        $validatedData = $request->validate([
            'nama_gi' => 'required|string',
            'wilayah' => 'required|string',
            'up3' => 'required|string',
            'no_trafo' => 'required|string',
            'primer' => 'required|string',
            'sekunder' => 'required|string',
            'daya' => 'required|string',
            'inom' => 'required|string',
            'i_siang' => 'required|string',
            'i_malam' => 'required|string',
            'persen_siang' => 'required|string',
            'persen_malam' => 'required|string',
        ]);

        // Menyimpan data ke dalam database
        DataFormModel::create(array_merge($validatedData, ['created_at' => Carbon::now()]));

        // Jika data berhasil disimpan, arahkan kembali ke halaman yang sesuai
        return redirect()->route('DataForm')
            ->with('success', 'Data berhasil disimpan.');
    }

}
