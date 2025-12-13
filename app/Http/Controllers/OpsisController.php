<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\status_beban;
use App\Models\data_beban_puncak30;
use Yajra\DataTables\DataTables;

class OpsisController extends Controller
{
    public function index()
    {

        if (Auth::user()->hasRole(['ValidatorOpsis', 'ValidatorFasop', 'Administrator'])) {

            return view('Opsis.Approaval.index');
        }
    }

    public function data()
    {

        $dataFail = status_beban::where('status', 'APPROVAL')->orderBy('id', 'ASC')
            ->get();

        return Datatables::of($dataFail)
            ->addIndexColumn()
            ->addColumn('action', function ($query) {
                $btnView = '<button type="button" class="btn btn-view-beban" 
                    data-pkey="' . $query->feeder_pkey . '"
                    data-gardu-induk="' . $query->gardu_induk . '"
                    data-feeder="' . $query->feeder . '"
                    data-tanggal="' . $query->tanggal . '"
                    data-toggle="modal" 
                    data-target="#viewBebanModal">
                    <i class="fas fa-eye"></i>
                </button>';

                $btnEdit = '<button type="button" class="btn btn-edit btn-update-status" 
                    data-id="' . $query->id . '" 
                    data-feeder-pkey="' . $query->feeder_pkey . '">
                    <i class="fas fa-edit"></i>
                </button>';

                return $btnView . ' ' . $btnEdit;
            })
            ->editColumn('status', function ($query) {
                return '<div class="badge badge-info">' . $query->status . '</div>';
            })
            ->rawColumns(['action', 'status'])
            ->make(true);
    }


    public function ActionApproval(Request $request)
    {
        $id = $request->input('id');
    
        $data = status_beban::where('id', $id)->update([
            'status' => 'SUCCESS',
        ]);
    
        return response()->json([
            'status' => 'success',
            'message' => 'Status updated successfully'
        ]);
    }
}
