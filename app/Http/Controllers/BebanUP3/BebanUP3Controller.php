<?php

namespace App\Http\Controllers\BebanUP3;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DataBebanRSTModel;
use Carbon\Carbon;
use App\Models\GITable;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;


class BebanUP3Controller extends Controller
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
        return view('BebanRST.BebanUP3.index');
    }

    public function dataHarian(Request $request)
    {
        $today = Carbon::today()->format('Y-m-d');

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

        $tanggal = $request->input('tanggal', Carbon::today()->format('Y-m-d'));
        $up3 = $request->input('up3', null);

        $query = DataBebanRSTModel::where('name', 'IR')
            ->where('tanggal', $tanggal)
            ->whereNotIn('feeder', ['inc.01', 'inc.02', 'inc.03', 'inc.04', 'inc.05', 'inc.06', 'inc.07']);

        if ($up3) {
            $query->where('up3', $up3);
        }

        $data_rst = $query->select([
            'gardu_induk',
            'feeder',
            'tanggal',
            'up3',
            ...$timeColumns
        ])->get();

        $data2 = [];

        foreach ($data_rst as $data) {

            $data2[] = [
                'up3' => $data->up3,
                'gardu_induk' => $data->gardu_induk,
                'feeder' => $data->feeder,
                '00_30' => $data['00_30'],
                '01_00' => $data['01_00'],
                '01_30' => $data['01_30'],
                '02_00' => $data['02_00'],
                '02_30' => $data['02_30'],
                '03_00' => $data['03_00'],
                '03_30' => $data['03_30'],
                '04_00' => $data['04_00'],
                '04_30' => $data['04_30'],
                '05_00' => $data['05_00'],
                '05_30' => $data['05_30'],
                '06_00' => $data['06_00'],
                '06_30' => $data['06_30'],
                '07_00' => $data['07_00'],
                '07_30' => $data['07_30'],
                '08_00' => $data['08_00'],
                '08_30' => $data['08_30'],
                '09_00' => $data['09_00'],
                '09_30' => $data['09_30'],
                '10_00' => $data['10_00'],
                '10_30' => $data['10_30'],
                '11_00' => $data['11_00'],
                '11_30' => $data['11_30'],
                '12_00' => $data['12_00'],
                '12_30' => $data['12_30'],
                '13_00' => $data['13_00'],
                '13_30' => $data['13_30'],
                '14_00' => $data['14_00'],
                '14_30' => $data['14_30'],
                '15_00' => $data['15_00'],
                '15_30' => $data['15_30'],
                '16_00' => $data['16_00'],
                '16_30' => $data['16_30'],
                '17_00' => $data['17_00'],
                '17_30' => $data['17_30'],
                '18_00' => $data['18_00'],
                '18_30' => $data['18_30'],
                '19_00' => $data['19_00'],
                '19_30' => $data['19_30'],
                '20_00' => $data['20_00'],
                '20_30' => $data['20_30'],
                '21_00' => $data['21_00'],
                '21_30' => $data['21_30'],
                '22_00' => $data['22_00'],
                '22_30' => $data['22_30'],
                '23_00' => $data['23_00'],
                '23_30' => $data['23_30']
            ];
        }

        return Datatables::of($data2)
            ->addIndexColumn()
            ->editColumn('up3_gi', function ($query) {
                return 'UP3.' . $query['up3'] . '<br>Gardu Induk.' . $query['gardu_induk'];
            })
            ->rawColumns(['up3_gi'])
            ->make(true);
    }


    public function dataMingguan(Request $request, $up3 = null)
    {

        $today = Carbon::today()->format('Y-m-d');

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

            $up3 = $request->input('up3', null);

            $query = DataBebanRSTModel::where('name', 'IR')
                ->whereBetween('tanggal', [$startDate, $endDate])
                ->whereNotIn('feeder', ['inc.01', 'inc.02', 'inc.03', 'inc.04', 'inc.05', 'inc.06', 'inc.07']);

            // Tambahkan filter UP3 jika dipilih
            if ($up3) {
                $query->where('up3', $up3);
            }

            $data_rst = $query->select([
                'gardu_induk',
                'feeder',
                'tanggal',
                'up3',
                ...$timeColumns
            ])->get();

            $data2 = [];

            foreach ($data_rst as $data) {

                $data2[] = [
                    'up3' => $data->up3,
                    'gardu_induk' => $data->gardu_induk,
                    'feeder' => $data->feeder,
                    '00_30' => $data['00_30'],
                    '01_00' => $data['01_00'],
                    '01_30' => $data['01_30'],
                    '02_00' => $data['02_00'],
                    '02_30' => $data['02_30'],
                    '03_00' => $data['03_00'],
                    '03_30' => $data['03_30'],
                    '04_00' => $data['04_00'],
                    '04_30' => $data['04_30'],
                    '05_00' => $data['05_00'],
                    '05_30' => $data['05_30'],
                    '06_00' => $data['06_00'],
                    '06_30' => $data['06_30'],
                    '07_00' => $data['07_00'],
                    '07_30' => $data['07_30'],
                    '08_00' => $data['08_00'],
                    '08_30' => $data['08_30'],
                    '09_00' => $data['09_00'],
                    '09_30' => $data['09_30'],
                    '10_00' => $data['10_00'],
                    '10_30' => $data['10_30'],
                    '11_00' => $data['11_00'],
                    '11_30' => $data['11_30'],
                    '12_00' => $data['12_00'],
                    '12_30' => $data['12_30'],
                    '13_00' => $data['13_00'],
                    '13_30' => $data['13_30'],
                    '14_00' => $data['14_00'],
                    '14_30' => $data['14_30'],
                    '15_00' => $data['15_00'],
                    '15_30' => $data['15_30'],
                    '16_00' => $data['16_00'],
                    '16_30' => $data['16_30'],
                    '17_00' => $data['17_00'],
                    '17_30' => $data['17_30'],
                    '18_00' => $data['18_00'],
                    '18_30' => $data['18_30'],
                    '19_00' => $data['19_00'],
                    '19_30' => $data['19_30'],
                    '20_00' => $data['20_00'],
                    '20_30' => $data['20_30'],
                    '21_00' => $data['21_00'],
                    '21_30' => $data['21_30'],
                    '22_00' => $data['22_00'],
                    '22_30' => $data['22_30'],
                    '23_00' => $data['23_00'],
                    '23_30' => $data['23_30']
                ];
            }

            // dd($data_rst);

            return Datatables::of($data2)
                ->addIndexColumn()
                ->editColumn('up3_gi', function ($query) {
                    return 'UP3.' . $query['up3'] . '<br>Gardu Induk.' . $query['gardu_induk'];
                })
                ->rawColumns(['up3_gi'])
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

    public function dataBulanan(Request $request, $up3 = null)
    {

        $today = Carbon::today()->format('Y-m-d');

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

            $selectedMonth = $request->has('filterBulanan')
                ? Carbon::parse($request->input('filterBulanan'))->format('Y-m')
                : Carbon::now()->format('Y-m');

            // dd($selectedMonth);

            $query = DataBebanRSTModel::where('name', 'IR')
                ->whereMonth('tanggal', '=', Carbon::parse($selectedMonth)->month)
                ->whereYear('tanggal', '=', Carbon::parse($selectedMonth)->year)
                ->whereNotIn('feeder', ['inc.01', 'inc.02', 'inc.03', 'inc.04', 'inc.05', 'inc.06', 'inc.07']);

            $up3 = $request->input('filterKategori', null);
            if ($up3) {
                $query->where('up3', $up3);
            }

            $timeColumns = $this->time();
            $data_rst = $query->select([
                'gardu_induk',
                'feeder',
                'tanggal',
                'up3',
                ...$timeColumns
            ])->get();

            // dd($data_rst);

            $data2 = [];

            foreach ($data_rst as $data) {

                $data2[] = [
                    'up3' => $data->up3,
                    'gardu_induk' => $data->gardu_induk,
                    'feeder' => $data->feeder,
                    '00_30' => $data['00_30'],
                    '01_00' => $data['01_00'],
                    '01_30' => $data['01_30'],
                    '02_00' => $data['02_00'],
                    '02_30' => $data['02_30'],
                    '03_00' => $data['03_00'],
                    '03_30' => $data['03_30'],
                    '04_00' => $data['04_00'],
                    '04_30' => $data['04_30'],
                    '05_00' => $data['05_00'],
                    '05_30' => $data['05_30'],
                    '06_00' => $data['06_00'],
                    '06_30' => $data['06_30'],
                    '07_00' => $data['07_00'],
                    '07_30' => $data['07_30'],
                    '08_00' => $data['08_00'],
                    '08_30' => $data['08_30'],
                    '09_00' => $data['09_00'],
                    '09_30' => $data['09_30'],
                    '10_00' => $data['10_00'],
                    '10_30' => $data['10_30'],
                    '11_00' => $data['11_00'],
                    '11_30' => $data['11_30'],
                    '12_00' => $data['12_00'],
                    '12_30' => $data['12_30'],
                    '13_00' => $data['13_00'],
                    '13_30' => $data['13_30'],
                    '14_00' => $data['14_00'],
                    '14_30' => $data['14_30'],
                    '15_00' => $data['15_00'],
                    '15_30' => $data['15_30'],
                    '16_00' => $data['16_00'],
                    '16_30' => $data['16_30'],
                    '17_00' => $data['17_00'],
                    '17_30' => $data['17_30'],
                    '18_00' => $data['18_00'],
                    '18_30' => $data['18_30'],
                    '19_00' => $data['19_00'],
                    '19_30' => $data['19_30'],
                    '20_00' => $data['20_00'],
                    '20_30' => $data['20_30'],
                    '21_00' => $data['21_00'],
                    '21_30' => $data['21_30'],
                    '22_00' => $data['22_00'],
                    '22_30' => $data['22_30'],
                    '23_00' => $data['23_00'],
                    '23_30' => $data['23_30']
                ];
            }

            // dd($data_rst);

            return Datatables::of($data2)
                ->addIndexColumn()
                ->editColumn('up3_gi', function ($query) {
                    return 'UP3.' . $query['up3'] . '<br>Gardu Induk.' . $query['gardu_induk'];
                })
                ->rawColumns(['up3_gi'])
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

    public function bebanTertinggiPerhari(Request $request)
    {

        $tanggal = $request->input('tanggal', Carbon::today()->format('Y-m-d'));
        // $tanggal = $request->input('tanggal', '2024-12-12');
        // $tanggal = $request->input('tanggal', Carbon::create(2024, 12, 12)->format('Y-m-d'));
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
        $up3 = $request->input('up3', null);

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

    public function getDataChartUP3(Request $request)
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
}
