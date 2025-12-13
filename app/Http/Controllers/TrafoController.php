<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\trafo;
use App\Exports\TrafoExport;
use Maatwebsite\Excel\Facades\Excel;

class TrafoController extends Controller
{
    public function index()
    {

        if (Auth::user()->hasRole('Administrator')) {

            $trafo = trafo::all();

            return view('admin.beban.trafo', compact('trafo'));
        } elseif (Auth::user()->hasRole('operator')) {

            $trafo = trafo::all();

            return view('Operator.beban.trafo', compact('trafo'));
        } elseif (Auth::user()->hasRole('Visitor')) {

            $trafo = trafo::all();

            return view('Visitor.beban.trafo', compact('trafo'));
        } elseif (Auth::user()->hasRole('ValidatorFasop')) {

            $trafo = trafo::all();

            return view('Fasop.beban.trafo', compact('trafo'));
        } elseif (Auth::user()->hasRole('ValidatorOpsis')) {

            $trafo = trafo::all();

            return view('Opsis.beban.trafo', compact('trafo'));
        } elseif (Auth::user()->hasRole('EditorOpsis')) {

            $trafo = trafo::all();

            return view('EditorOpsis.beban.trafo', compact('trafo'));
        } elseif (Auth::user()->hasRole('Manager')) {

            $trafo = trafo::all();

            return view('Manager.beban.trafo', compact('trafo'));
        } elseif (Auth::user()->hasRole('EditorOpsis')) {

            $trafo = trafo::all();

            return view('EditorOpsis.beban.trafo', compact('trafo'));
        }
    }

    public function detail($id)
    {

        if (Auth::user()->hasRole(['Administrator', 'Visitor', 'EditorOpsis', 'ValidatorFasop', 'operator', 'ValidatorOpsis', 'Manager'])) {

            $data = trafo::findOrFail($id);

            return view('TabelBeban.Trafo.Detail', compact('data'));
        }
    }

    public function create()
    {

        return view('admin.beban.Trafo.create');
    }

    public function store(Request $request)
    {
        if (Auth::user()->hasRole('Administrator')) {

            $req = $request->all();

            $store = trafo::create([

                'Nama_GI' => $request->nama_gi,
                'TRAFO' => $request->trafo,
                'ID_TRAFO' => $request->id_trafo,
                'ID_KELAS' => $request->id_kelas,
                'KD_PEMILIK' => $request->kd_pemilik,
                'KD_PENGELOLA' => $request->pengelola,
                'TINGKAT_RESIKO' => $request->tingkat_resiko,
                'KODE_PERALATAN' => $request->kode,
                'MERK' => $request->merk,
                'NO_SERI' => $request->no_seri,
                'PERUNTUKAN' => $request->peruntukan,
                'JENIS' => $request->jenis,
                'STATUS' => $request->status,
                'TGL_PASANG' => $request->tgl_pasang,
                'TGL_OPERASI' => $request->tgl_operasi,
                'NILAI_PEROLEHAN' => $request->nilai_perolehan,
                'NILAI_BUKU' => $request->nilai_buku,
                'UMUR_EKONOMIS' => $request->umur_ekonomis,
                'UMUR_MANFAAT' => $request->umur_manfaat,
            ]);

            if ($store) {
                return redirect()->route('bebantrafo')->with('success', 'Data Berhasil di update');
            }
        }
    }


    public function edit($id)
    {
        if (Auth::user()->hasRole('Administrator')) {

            $data = trafo::findOrFail($id);

            // dd($data);

            return view('admin.beban.Trafo.edit', compact('data'));
        } elseif (Auth::user()->hasRole('Visitor')) {
        } elseif (Auth::user()->hasRole('EditorOpsis')) {
        } elseif (Auth::user()->hasRole('ValidatorFasop')) {
        } elseif (Auth::user()->hasRole('operator')) {
        } elseif (Auth::user()->hasRole('ValidatorOpsis')) {
        }
    }

    public function update(Request $request, $id)
    {

        if (Auth::user()->hasRole('Administrator')) {

            $req = $request->all();

            $update = trafo::where('id', $id)->update([

                'Nama_GI' => $request->nama_gi,
                'TRAFO' => $request->trafo,
                'ID_TRAFO' => $request->id_trafo,
                'ID_KELAS' => $request->id_kelas,
                'KD_PEMILIK' => $request->kd_pemilik,
                'KD_PENGELOLA' => $request->pengelola,
                'TINGKAT_RESIKO' => $request->tingkat_resiko,
                'KODE_PERALATAN' => $request->kode,
                'MERK' => $request->merk,
                'NO_SERI' => $request->no_seri,
                'PERUNTUKAN' => $request->peruntukan,
                'JENIS' => $request->jenis,
                'STATUS' => $request->status,
                'TGL_PASANG' => $request->tgl_pasang,
                'TGL_OPERASI' => $request->tgl_operasi,
                'NILAI_PEROLEHAN' => $request->nilai_perolehan,
                'NILAI_BUKU' => $request->nilai_buku,
                'UMUR_EKONOMIS' => $request->umur_ekonomis,
                'UMUR_MANFAAT' => $request->umur_manfaat,
            ]);

            if ($update) {
                return redirect()->route('bebantrafo')->with('success', 'Data Berhasil di update');
            }
            // dd($update);
        }
    }

    public function Export()
    {

        return Excel::download(new TrafoExport, 'data_trafo.xlsx');
    }
}
