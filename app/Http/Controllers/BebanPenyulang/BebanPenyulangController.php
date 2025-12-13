<?php

namespace App\Http\Controllers\BebanPenyulang;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DataBebanRSTModel;
use Yajra\DataTables\Contracts\DataTable;
use Yajra\DataTables\DataTables;
use App\Models\GITable;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class BebanPenyulangController extends Controller
{

    public function time()
    {

        $timeColumns = [
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

        return $timeColumns;
    }

    public function index()
    {

        return view('BebanRST.BebanPenyulang.index');
    }

    public function datagi()
    {

        $data = GITable::orderBy('id', 'ASC')->get();

        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                $btn = '<button type="button" class="btn btn-view-beban" 
                    onclick="viewBeban(\'' . $row->Nama_GI . '\')" 
                    data-nama="' . $row->Nama_GI . '">
                    <i class="fas fa-eye"></i>
                    </button>';
                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function BebanTertinggiPenyulang(Request $request)
    {
        $nama = $request->input('nama', 'none');
        \Log::info('Received nama parameter: ' . $nama);

        if ($nama === 'none') {
            return response()->json([
                'draw' => $request->input('draw'),
                'recordsTotal' => 0,
                'recordsFiltered' => 0,
                'data' => []
            ]);
        }

        $timeColumns = [
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

        $greatestArgs = implode(',', array_map(function ($col) {
            return "COALESCE(`$col`, 0)";
        }, $timeColumns));

        $caseStatement = "CASE ";
        foreach ($timeColumns as $col) {
            $time = str_replace('_', ':', $col);
            $caseStatement .= "WHEN GREATEST($greatestArgs) = COALESCE(`$col`, 0) THEN '$time' ";
        }
        $caseStatement .= "END";

        try {
            $data_rst = DataBebanRSTModel::where('gardu_induk', $nama)
                ->where('name', 'IR')
                ->whereNotIn('feeder', ['inc.01', 'inc.02', 'inc.03', 'inc.04', 'inc.05', 'inc.06', 'inc.07'])
                ->select([
                    'tanggal',
                    't_primary',
                    't_secondary',
                    't_daya',
                    'feeder',
                    DB::raw("GREATEST($greatestArgs) as nilai_maksimal"),
                    DB::raw("$caseStatement as jam_nilai_maksimal")
                ])
                ->orderBy('feeder', 'ASC')
                ->get();

            \Log::info('Query results:', ['count' => $data_rst->count()]);

            return Datatables::of($data_rst)
                ->addIndexColumn()
                ->make(true);
        } catch (\Exception $e) {
            \Log::error('Error in BebanTertinggiPenyulang:', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'error' => 'An error occurred while processing the request',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function dataHarian(Request $request)
    {
        $timeColumns = $this->time();

        $greatestArgs = implode(',', array_map(function ($col) {
            return "COALESCE(`$col`, 0)";
        }, $timeColumns));

        $caseStatement = "CASE ";
        foreach ($timeColumns as $col) {
            $time = str_replace('_', ':', $col);
            $caseStatement .= "WHEN GREATEST($greatestArgs) = COALESCE(`$col`, 0) THEN '$time' ";
        }
        $caseStatement .= "END";

        // dd($caseStatement);

        try {
            $tanggalDinamis = $request->input('tanggal', Carbon::now()->format('Y-m-d'));

            $data_rst = DataBebanRSTModel::where('name', 'IR')
                // ->where('tanggal', '2024-05-17')
                ->where('tanggal', $tanggalDinamis)
                ->whereNotIn('feeder', ['inc.01', 'inc.02', 'inc.03', 'inc.04', 'inc.05', 'inc.06', 'inc.07'])
                ->whereIn('id', function ($query) use ($tanggalDinamis) {
                    $query->select(DB::raw('MAX(id)'))
                        ->from('data_bebanrst')
                        ->where('tanggal', $tanggalDinamis)
                        ->where('name', 'IR')
                        ->whereNotIn('feeder', ['inc.01', 'inc.02', 'inc.03', 'inc.04', 'inc.05', 'inc.06', 'inc.07'])
                        ->groupBy('gardu_induk');
                })
                ->select([
                    'gardu_induk',
                    't_primary',
                    't_secondary',
                    't_daya',
                    'feeder',
                    'up3',
                    ...$timeColumns
                ])
                ->get();
            // dd($data_rst);

            return Datatables::of($data_rst)
                ->addIndexColumn()
                ->make(true);
        } catch (\Exception $e) {
            \Log::error('Error in BebanTertinggiPenyulang:', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'error' => 'An error occurred while processing the request',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function dataMingguan(Request $request)
    {
        $timeColumns = $this->time();

        $greatestArgs = implode(',', array_map(function ($col) {
            return "COALESCE(`$col`, 0)";
        }, $timeColumns));

        $caseStatement = "CASE ";
        foreach ($timeColumns as $col) {
            $time = str_replace('_', ':', $col);
            $caseStatement .= "WHEN GREATEST($greatestArgs) = COALESCE(`$col`, 0) THEN '$time' ";
        }
        $caseStatement .= "END";

        try {
            if ($request->has('tanggal_awal') && $request->has('tanggal_akhir')) {
                $startDate = Carbon::parse($request->input('tanggal_awal'))->startOfDay();
                $endDate = Carbon::parse($request->input('tanggal_akhir'))->endOfDay();
            } else {
                $endDate = Carbon::now();
                $startDate = $endDate->copy()->subWeek();
            }

            $data_rst = DataBebanRSTModel::where('name', 'IR')
                ->whereBetween('tanggal', [$startDate, $endDate])
                ->whereNotIn('feeder', ['inc.01', 'inc.02', 'inc.03', 'inc.04', 'inc.05', 'inc.06', 'inc.07'])
                ->select([
                    'gardu_induk',
                    't_primary',
                    't_secondary',
                    't_daya',
                    'feeder',
                    'up3',
                    ...$timeColumns,
                    'tanggal'
                ])
                ->get();

            // dd($data_rst);

            return Datatables::of($data_rst)
                ->addIndexColumn()
                ->make(true);
        } catch (\Exception $e) {
            \Log::error('Error in BebanTertinggiPenyulangMingguan:', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'error' => 'An error occurred while processing the request',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function dataBulanan(Request $request)
    {
        $timeColumns = $this->time();

        $greatestArgs = implode(',', array_map(function ($col) {
            return "COALESCE(`$col`, 0)";
        }, $timeColumns));

        $caseStatement = "CASE ";
        foreach ($timeColumns as $col) {
            $time = str_replace('_', ':', $col);
            $caseStatement .= "WHEN GREATEST($greatestArgs) = COALESCE(`$col`, 0) THEN '$time' ";
        }
        $caseStatement .= "END";

        try {
            // Get the selected month or use the current month
            $selectedMonth = $request->has('filterBulanan')
                ? Carbon::parse($request->input('filterBulanan'))->format('Y-m')
                : Carbon::now()->format('Y-m');

            // dd($selectedMonth);

            $data_rst = DataBebanRSTModel::where('name', 'IR')
                ->whereMonth('tanggal', '=', Carbon::parse($selectedMonth)->month)
                ->whereYear('tanggal', '=', Carbon::parse($selectedMonth)->year)
                ->whereNotIn('feeder', ['inc.01', 'inc.02', 'inc.03', 'inc.04', 'inc.05', 'inc.06', 'inc.07'])
                ->select([
                    'gardu_induk',
                    't_primary',
                    't_secondary',
                    't_daya',
                    'feeder',
                    'up3',
                    ...$timeColumns,
                    'tanggal'
                ])
                ->get();

            return Datatables::of($data_rst)
                ->addColumn('tanggal', function ($row) {
                    return Carbon::parse($row->tanggal)->format('d M Y');
                })
                ->addColumn('bulan', function ($row) {
                    return Carbon::parse($row->tanggal)->translatedFormat('F Y');
                })
                ->addIndexColumn()
                ->make(true);
        } catch (\Exception $e) {
            \Log::error('Error in BebanTertinggiPenyulangBulanan:', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'error' => 'An error occurred while processing the request',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function getDataChart(Request $request)
    {
        $type = $request->input('type');
        $timeColumns = $this->time();

        try {
            switch ($type) {
                case 'daily':
                    $tanggal = $request->input('tanggal', Carbon::now()->format('Y-m-d'));

                    $data_rst = DataBebanRSTModel::where('name', 'IR')
                        ->where('tanggal', $tanggal)
                        ->whereNotIn('feeder', ['inc.01', 'inc.02', 'inc.03', 'inc.04', 'inc.05', 'inc.06', 'inc.07'])
                        ->get();

                    $labels = $timeColumns;
                    $datasets = $data_rst->groupBy('gardu_induk')->map(function ($group) use ($timeColumns) {
                        return [
                            'label' => $group->first()->gardu_induk,
                            'data' => collect($timeColumns)->map(function ($time) use ($group) {
                                return $group->pluck($time)->first() ?? 0;
                            })->toArray()
                        ];
                    })->values()->toArray();
                    break;

                case 'weekly':
                    $startDate = $request->input('tanggal_awal', Carbon::now()->subWeek());
                    $endDate = $request->input('tanggal_akhir', Carbon::now());

                    $startDate = Carbon::parse($startDate);
                    $endDate = Carbon::parse($endDate);

                    $bulanan = $request->input('bulanan', Carbon::now()->startOfMonth());
                    $bulan2 = Carbon::parse($bulanan);

                    // dd($bulan2);

                    $query = DataBebanRSTModel::where('name', 'IR')
                        ->whereNotIn('feeder', ['inc.01', 'inc.02', 'inc.03', 'inc.04', 'inc.05', 'inc.06', 'inc.07']);

                    if ($type === 'weekly') {
                        $query->whereBetween('tanggal', [$startDate, $endDate]);
                    } else {
                        $query->whereMonth('tanggal', $bulan2->month)
                            ->whereYear('tanggal', $bulan2->year);
                    }

                    $data_rst = $query->get();

                    $labels = collect();
                    if ($type === 'weekly') {
                        $labels = collect($this->generateDateRange($startDate, $endDate))
                            ->map(function ($date) {
                                return $date->format('Y-m-d');
                            });
                    } else {
                        $labels = $data_rst->pluck('tanggal')->unique();
                    }

                    $datasets = $data_rst->groupBy('gardu_induk')->map(function ($group) use ($labels, $timeColumns) {
                        $data = $labels->map(function ($label) use ($group, $timeColumns) {
                            $dayRecord = $group->where('tanggal', $label)->first();

                            if (!$dayRecord) {
                                return 0; // No data for this date
                            }

                            $timeValues = collect($timeColumns)
                                ->map(function ($col) use ($dayRecord) {
                                    return $dayRecord->$col ?? 0;
                                })
                                ->filter(function ($value) {
                                    return $value !== null && $value !== '';
                                });

                            return $timeValues->isNotEmpty() ? $timeValues->avg() : 0;
                        })->toArray();

                        return [
                            'label' => $group->first()->gardu_induk,
                            'data' => $data
                        ];
                    })->values()->toArray();

                    $labels = $labels->sort()->values()->toArray();
                    break;
                case 'monthly':
                    $bulanan = $request->input('tanggal_awal', Carbon::now()->startOfMonth());
                    $bulan2 = Carbon::parse($bulanan);

                    $query = DataBebanRSTModel::where('name', 'IR')
                        ->whereNotIn('feeder', ['inc.01', 'inc.02', 'inc.03', 'inc.04', 'inc.05', 'inc.06', 'inc.07'])
                        ->whereMonth('tanggal', $bulan2->month)
                        ->whereYear('tanggal', $bulan2->year);

                    $data_rst = $query->get();

                    // Generate labels for the entire month
                    $labels = collect();
                    $startOfMonth = $bulan2->copy()->startOfMonth();
                    $endOfMonth = $bulan2->copy()->endOfMonth();

                    $labels = collect($this->generateDateRange($startOfMonth, $endOfMonth))
                        ->map(function ($date) {
                            return $date->format('Y-m-d');
                        });

                    $datasets = $data_rst->groupBy('gardu_induk')->map(function ($group) use ($labels, $timeColumns) {
                        $data = $labels->map(function ($label) use ($group, $timeColumns) {
                            $dayRecord = $group->where('tanggal', $label)->first();

                            if (!$dayRecord) {
                                return 0; // No data for this date
                            }

                            $timeValues = collect($timeColumns)
                                ->map(function ($col) use ($dayRecord) {
                                    return $dayRecord->$col ?? 0;
                                })
                                ->filter(function ($value) {
                                    return $value !== null && $value !== '';
                                });

                            return $timeValues->isNotEmpty() ? $timeValues->avg() : 0;
                        })->toArray();

                        return [
                            'label' => $group->first()->gardu_induk,
                            'data' => $data
                        ];
                    })->values()->toArray();

                    $labels = $labels->sort()->values()->toArray();
                    break;
                default:
                    return response()->json(['error' => 'Invalid type'], 400);
            }

            return response()->json([
                'labels' => $labels,
                'datasets' => $datasets
            ]);
        } catch (\Exception $e) {
            \Log::error('Chart Data Error', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'error' => true,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    protected function generateDateRange(Carbon $start, Carbon $end)
    {
        $dates = [];
        $current = $start->copy();

        while ($current->lte($end)) {
            $dates[] = $current->copy();
            $current->addDay();
        }

        return $dates;
    }


    public function bebanTertinggiPerhari(Request $request)
    {

        $tanggal = $request->input('tanggal', Carbon::today()->format('Y-m-d'));
        $up3 = $request->input('up3', null);

        // dd($up3);

        $query = DataBebanRSTModel::where('name', 'IR')
            ->where('tanggal', $tanggal)
            ->whereNotIn('feeder', ['inc.01', 'inc.02', 'inc.03', 'inc.04', 'inc.05', 'inc.06', 'inc.07']);

        if ($up3) {
            $query->where('up3', $up3);
        }

        $timeColumns = $this->time();

        $data_rst = $query->get();

        $highestLoadData = null;
        $highestLoadValue = 0;

        foreach ($data_rst as $data) {
            foreach ($timeColumns as $col) {
                $currentLoad = $data[$col] ?? 0;
                if ($currentLoad > $highestLoadValue) {
                    $highestLoadValue = $currentLoad;
                    $highestLoadData = $data;
                }
            }
        }

        $data2 = [];
        if ($highestLoadData) {
            $data2[] = [
                'up3' => $highestLoadData->up3,
                'tanggal' => $highestLoadData->tanggal,
                'gardu_induk' => $highestLoadData->gardu_induk,
                'feeder' => $highestLoadData->feeder,
                'waktu_beban_tertinggi' => $this->findHighestLoadTime($highestLoadData, $timeColumns),
                'beban_tertinggi' => $highestLoadValue
            ];
        }

        return response()->json($data2);
    }

    public function bebanTertinggiMingguan(Request $request)
    {

        if ($request->has('tanggal_awal') && $request->has('tanggal_akhir')) {
            $startDate = Carbon::parse($request->input('tanggal_awal'))->startOfDay();
            $endDate = Carbon::parse($request->input('tanggal_akhir'))->endOfDay();
        } else {
            $endDate = Carbon::now();
            $startDate = $endDate->copy()->subWeek();
        }

        $query = DataBebanRSTModel::where('name', 'IR')
            ->whereBetween('tanggal', [$startDate, $endDate])
            ->whereNotIn('feeder', ['inc.01', 'inc.02', 'inc.03', 'inc.04', 'inc.05', 'inc.06', 'inc.07']);

        $data_rst = $query->get();

        $timeColumns = $this->time();
        $highestLoadData = null;
        $highestLoadValue = 0;

        foreach ($data_rst as $data) {
            foreach ($timeColumns as $col) {
                $currentLoad = $data[$col] ?? 0;
                if ($currentLoad > $highestLoadValue) {
                    $highestLoadValue = $currentLoad;
                    $highestLoadData = $data;
                }
            }
        }

        $data2 = [];
        if ($highestLoadData) {
            $data2[] = [
                'up3' => $highestLoadData->up3,
                'tanggal' => $highestLoadData->tanggal,
                'gardu_induk' => $highestLoadData->gardu_induk,
                'feeder' => $highestLoadData->feeder,
                'waktu_beban_tertinggi' => $this->findHighestLoadTime($highestLoadData, $timeColumns),
                'beban_tertinggi' => $highestLoadValue
            ];
        }

        return response()->json($data2);
    }

    public function bebanTertinggiPerbulan(Request $request)
    {

        $selectedMonth = $request->has('filterBulanan')
            ? Carbon::parse($request->input('filterBulanan'))->format('Y-m')
            : Carbon::now()->format('Y-m');

        $query = DataBebanRSTModel::where('name', 'IR')
            ->whereMonth('tanggal', '=', Carbon::parse($selectedMonth)->month)
            ->whereYear('tanggal', '=', Carbon::parse($selectedMonth)->year)
            ->whereNotIn('feeder', ['inc.01', 'inc.02', 'inc.03', 'inc.04', 'inc.05', 'inc.06', 'inc.07']);

        // if ($up3) {
        //     $query->where('up3', $up3);
        // }

        $timeColumns = $this->time();

        $data_rst = $query->get();

        $highestLoadData = null;
        $highestLoadValue = 0;

        foreach ($data_rst as $data) {
            foreach ($timeColumns as $col) {
                $currentLoad = $data[$col] ?? 0;
                if ($currentLoad > $highestLoadValue) {
                    $highestLoadValue = $currentLoad;
                    $highestLoadData = $data;
                }
            }
        }

        $data2 = [];
        if ($highestLoadData) {
            $data2[] = [
                'up3' => $highestLoadData->up3,
                'tanggal' => $highestLoadData->tanggal,
                'gardu_induk' => $highestLoadData->gardu_induk,
                'feeder' => $highestLoadData->feeder,
                'waktu_beban_tertinggi' => $this->findHighestLoadTime($highestLoadData, $timeColumns),
                'beban_tertinggi' => $highestLoadValue
            ];
        }

        return response()->json($data2);
    }

    protected function findHighestLoadTime($data, $timeColumns)
    {
        $highestLoadTime = null;
        $highestLoadValue = 0;

        foreach ($timeColumns as $col) {
            $currentLoad = $data[$col] ?? 0;
            if ($currentLoad > $highestLoadValue) {
                $highestLoadValue = $currentLoad;
                $highestLoadTime = str_replace('_', ':', $col);
            }
        }

        return $highestLoadTime;
    }
}
