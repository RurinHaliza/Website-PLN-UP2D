<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\status_beban;
use Illuminate\Support\Facades\Auth;
use App\Models\data_beban_puncak30;
use Yajra\DataTables\DataTables;

class OperatorController extends Controller
{
    public function ScadaFailIndex()
    {

        if (Auth::user()->hasRole(['operator', 'Administrator'])) {

            $get = status_beban::orderBy('id', 'ASC')
                ->limit(100)
                ->get();

            return view('Operator.ScadaFail.input', compact('get'));
        }
    }

    public function data()
    {
        $dataFail = status_beban::where('status', 'FAIL')->orderBy('id', 'ASC')
            ->limit(100)
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

                $btnEdit = '<a href="' .
                    (Auth::user()->hasRole('Administrator')
                        ? route('editscadafail.admin', $query->id)
                        : (Auth::user()->hasRole('operator')
                            ? route('editscadafail.operator', $query->id)
                            : '#')) . '" class="btn btn-edit">
                <i class="fas fa-edit"></i>
            </a>';
                return $btnView . ' ' . $btnEdit;
            })
            ->editColumn('status', function ($query) {
                return '<div class="badge badge-danger">' . $query->status . '</div>';
            })
            ->rawColumns(['action', 'status'])
            ->make(true);
    }

    public function editDataFail($id)
    {

        if (Auth::user()->hasRole(['operator', 'Administrator'])) {

            $getFeederPkey = status_beban::where('id', $id)->value('feeder_pkey');

            $getID = status_beban::where('id', $id)->first();

            // dd($getID);

            $data = data_beban_puncak30::where('feeder_pkey', $getFeederPkey)->first();

            return view('Operator.ScadaFail.edit', compact('data'), [
                'id_status' => $getID->id,
            ]);
        }
    }

    public function update(Request $request, $id)
    {
        if (Auth::user()->hasRole(['Administrator', 'operator'])) {

            try {

                $record = data_beban_puncak30::where('feeder_pkey', $request->feeder_pkey)->first();

                if (!$record) {
                    return response()->json([
                        'status' => 'error',
                        'message' => 'Record not found'
                    ], 404);
                }

                // Update time slots dynamically
                $timeSlots = [
                    '00_30',
                    '01_00',
                    '01_30',
                    '02_00',
                    '02_30',
                    '03_00',
                    '03_30',
                    '04_00',
                    '04_30',
                    '05_00',
                    '05_30',
                    '06_00',
                    '06_30',
                    '07_00',
                    '07_30',
                    '08_00',
                    '08_30',
                    '09_00',
                    '09_30',
                    '10_00',
                    '10_30',
                    '11_00',
                    '11_30',
                    '12_00',
                    '12_30',
                    '13_00',
                    '13_30',
                    '14_00',
                    '14_30',
                    '15_00',
                    '15_30',
                    '16_00',
                    '16_30',
                    '17_00',
                    '17_30',
                    '18_00',
                    '18_30',
                    '19_00',
                    '19_30',
                    '20_00',
                    '20_30',
                    '21_00',
                    '21_30',
                    '22_00',
                    '22_30',
                    '23_00',
                    '23_30'
                ];

                foreach ($timeSlots as $slot) {
                    $record->{$slot} = $request->input('J' . $slot);
                }

                $record->save();

                $updateStatus = status_beban::findOrFail($id);

                $updateStatus->status = 'APPROVAL';
                $updateStatus->save();

                return response()->json([
                    'status' => 'success',
                    'message' => 'Data updated successfully'
                ]);
            } catch (\Exception $e) {
                \Log::error('Update Scada Fail Error: ' . $e->getMessage());

                return response()->json([
                    'status' => 'error',
                    'message' => 'Failed to update data: ' . $e->getMessage()
                ], 500);
            }
        }

        // Unauthorized access
        return response()->json([
            'status' => 'error',
            'message' => 'Unauthorized access'
        ], 403);
    }
}
