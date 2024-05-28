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
            'gardu_induk' => 'nullable|string',
            'wilayah' => 'nullable|string',
            'up3' => 'nullable|string',
            'no_trafo' => 'nullable|integer',
            'primer' => 'nullable|integer',
            'sekunder' => 'nullable|integer',
            'daya' => 'nullable|integer',
            'Inom' => 'nullable|string',
            'ISiang' => 'nullable|integer',
            'Imalam' => 'nullable|integer',
            'persensiang' => 'nullable|numeric',
            'persenmalam' => 'nullable|numeric',
            'bebantertinggi' => 'nullable|integer',
            'persentertinggi' => 'nullable|numeric',
            // Tambahkan aturan validasi sesuai dengan kebutuhan Anda
        ]);

        


        DataFormModel::create([
            'gardu_induk' => $validatedData['gardu_induk'],
            'no_trafo' => $validatedData['no_trafo'],
            'wilayah' => $validatedData['wilayah'],
            'up3' => $validatedData['up3'],
            'primer' => $validatedData['primer'],
            'sekunder' => $validatedData['sekunder'],
            'daya' => $validatedData['daya'],
            'Inom' => $validatedData['Inom'],
            'ISiang' => $validatedData['ISiang'],
            'Imalam' => $validatedData['Imalam'],
            'persensiang' => $validatedData['persensiang'],
            'persenmalam' => $validatedData['persenmalam'],
            'bebantertinggi' => $validatedData['bebantertinggi'],
            'persentertinggi' => $validatedData['persentertinggi'],
            'created_at' => Carbon::now(),
        ]);

        // Jika data berhasil disimpan, arahkan kembali ke halaman yang sesuai
        return redirect()->route('dataform.index')
            ->with('success', 'Data berhasil disimpan.');
    }

}
