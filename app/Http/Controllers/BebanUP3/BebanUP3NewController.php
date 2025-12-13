<?php

namespace App\Http\Controllers\BebanUP3;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Exports\BebanUp3Export;
use App\Exports\BebanUp3MingguanExport;
use App\Exports\BebanUp3BulananExport;
use App\Exports\BebanUp3ExportAll;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\DataBebanRSTModel;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class BebanUP3NewController extends Controller
{
    public function index(Request $request)
    {
        return view('BebanRST.BebanUP3New.index');
    }

    public function getData(Request $request)
    {
        $data = collect();
        $feeder = $request->input('feeder');
        $name = $request->input('name');
        $tanggal = $request->input('tanggal');

        if ($feeder && $name && $tanggal) {
            $query = DataBebanRSTModel::where('name', $name)
                ->whereDate('tanggal', $tanggal)
                ->whereNotIn('feeder', ['total_penyulang', 'total_incoming']);

            if ($feeder === 'Incoming') {
                $query->where('feeder', 'like', '%Incoming%');
            } else {
                $query->where('feeder', 'not like', '%Incoming%');
            }

            $data = $query->get();
        }

        return response()->json($data);
    }


    public function getDataMingguan(Request $request)
    {
        $feeder = $request->input('feeder');
        $name = $request->input('name');
        $tanggalMulai = Carbon::parse($request->input('tanggal-mulai'))->format('Y-m-d');
        $tanggalAkhir = Carbon::parse($request->input('tanggal-akhir'))->format('Y-m-d');

        // daftar kolom waktu (15 menit interval)
        $timeColumns = [];
        for ($i = 0; $i < 24; $i++) {
            for ($j = 0; $j < 60; $j += 15) {
                if (!($i == 0 && $j == 0)) {
                    $timeColumns[] = sprintf("%02d_%02d", $i, $j);
                }
                if ($i == 23 && $j == 45) {
                    $timeColumns[] = "23_59";
                }
            }
        }

        // select kolom tetap
        $selects = [
            'up3',
            'gardu_induk',
            'feeder',
            'name',
            DB::raw("'$tanggalMulai s/d $tanggalAkhir' as tanggal"),
        ];

        // select agregat SUM untuk tiap kolom waktu
        foreach ($timeColumns as $col) {
            $selects[] = DB::raw("SUM($col) as $col");
        }

        $query = DataBebanRSTModel::where('name', $name)
            ->whereBetween('tanggal', [$tanggalMulai, $tanggalAkhir])
            ->whereNotIn('feeder', ['total_penyulang', 'total_incoming']);
        ;

        // konsisten filter feeder
        if ($feeder === 'Incoming') {
            $query->where('feeder', 'like', '%Incoming%');
        } else {
            $query->where('feeder', 'not like', '%Incoming%');
        }

        $data = $query->select($selects)
            ->groupBy('up3', 'gardu_induk', 'feeder', 'name')
            ->get();

        return response()->json(['data' => $data]);
    }

    public function getDataBulanan(Request $request)
    {
        $feeder = $request->input('feeder');
        $name = $request->input('name');
        $filterBulan = $request->input('filterBulan'); // format: YYYY-MM

        if (!$filterBulan) {
            return response()->json(['data' => []]);
        }

        // dapatkan tanggal mulai & akhir dari bulan tsb
        $tanggalMulai = Carbon::createFromFormat('Y-m', $filterBulan)->startOfMonth()->format('Y-m-d');
        $tanggalAkhir = Carbon::createFromFormat('Y-m', $filterBulan)->endOfMonth()->format('Y-m-d');

        // daftar kolom waktu (15 menit interval)
        $timeColumns = [];
        for ($i = 0; $i < 24; $i++) {
            for ($j = 0; $j < 60; $j += 15) {
                if (!($i == 0 && $j == 0)) {
                    $timeColumns[] = sprintf("%02d_%02d", $i, $j);
                }
                if ($i == 23 && $j == 45) {
                    $timeColumns[] = "23_59";
                }
            }
        }

        // kolom tetap
        $selects = [
            'up3',
            'gardu_induk',
            'feeder',
            'name',
            DB::raw("'$tanggalMulai s/d $tanggalAkhir' as tanggal"),
        ];

        // agregat SUM tiap kolom interval
        foreach ($timeColumns as $col) {
            $selects[] = DB::raw("SUM($col) as $col");
        }

        $query = DataBebanRSTModel::where('name', $name)
            ->whereBetween('tanggal', [$tanggalMulai, $tanggalAkhir])
            ->whereNotIn('feeder', ['total_penyulang', 'total_incoming']);
        ;

        // filter feeder konsisten
        if ($feeder === 'Incoming') {
            $query->where('feeder', 'like', '%Incoming%');
        } else {
            $query->where('feeder', 'not like', '%Incoming%');
        }

        $data = $query->select($selects)
            ->groupBy('up3', 'gardu_induk', 'feeder', 'name')
            ->get();

        // return response()->json(['data' => $data]);

        return response()->json([
            'debug' => [
                'feeder' => $feeder,
                'name' => $name,
                'filterBulan' => $filterBulan,
                'tanggalMulai' => $tanggalMulai,
                'tanggalAkhir' => $tanggalAkhir,
                'timeColumns' => $timeColumns,
                'selects' => $selects,
                'sql' => $query->toSql(),          // query mentah dengan binding
                'bindings' => $query->getBindings() // parameter binding
            ],
            'data' => $data
        ]);

    }

    public function exportHarian(Request $request)
    {
        $feeder = $request->input('feeder');
        $name = $request->input('name');
        $tanggal = $request->input('tanggal');

        $filename = 'beban_harian_' . $tanggal . '_' . $name . '.xlsx';

        return Excel::download(new BebanUp3Export($feeder, $name, $tanggal), $filename);
    }

    public function exportMingguan(Request $request)
    {
        $feeder = $request->input('feeder');
        $name = $request->input('name');
        $tanggalMulai = Carbon::parse($request->input('tanggal-mulai'))->format('Y-m-d');
        $tanggalAkhir = Carbon::parse($request->input('tanggal-akhir'))->format('Y-m-d');

        $filename = 'beban_mingguan_' . $tanggalMulai . '_sd_' . $tanggalAkhir . '_' . $name . '.xlsx';

        return Excel::download(new BebanUp3MingguanExport($feeder, $name, $tanggalMulai, $tanggalAkhir), $filename);
    }

    public function exportBulanan(Request $request)
    {
        $feeder = $request->input('feeder');
        $name = $request->input('name');
        $filterBulan = $request->input('filterBulan');

        if (!$filterBulan) {
            return redirect()->back()->with('error', 'Bulan belum dipilih.');
        }

        $fileName = "Data_Beban_Bulanan_{$filterBulan}_{$feeder}_{$name}.xlsx";
        return Excel::download(new BebanUp3BulananExport($feeder, $name, $filterBulan), $fileName);
    }

    public function exportAll(Request $request)
    {
        $query = DB::table('data_bebanrst');

        if ($request->jenisFeeder === 'penyulang') {
            $query->where('feeder', 'NOT LIKE', '%Incoming%');
        } elseif ($request->jenisFeeder === 'incoming') {
            $query->where('feeder', 'like', '%Incoming%');
        }

        if ($request->feeder && $request->feeder !== "ALL") {
            $query->whereIn('feeder', $request->feeder);
        }

        if ($request->name) {
            $query->where('name', $request->name);
        }

        if ($request->tanggal_awal && $request->tanggal_akhir) {
            $query->whereBetween('tanggal', [$request->tanggal_awal, $request->tanggal_akhir]);
        }

        $data = $query->orderBy('tanggal', 'desc')->get();

        $jenis = $request->jenisFeeder ? ucfirst($request->jenisFeeder) : 'Semua Jenis';

        if ($request->tanggal_awal && $request->tanggal_akhir) {
            $tAwal = Carbon::parse($request->tanggal_awal)->format('d M Y');
            $tAkhir = Carbon::parse($request->tanggal_akhir)->format('d M Y');
            $dateRange = " ({$tAwal} - {$tAkhir})";
        } else {
            $dateRange = "";
        }

        $filename = "Beban UP3 - {$jenis}{$dateRange}.xlsx";

        return Excel::download(new BebanUp3ExportAll($data), $filename);
    }


    public function getFeederByJenis(Request $request)
    {
        $jenis = $request->jenis;

        if ($jenis === 'penyulang') {
            $data = DB::table('data_bebanrst')
                ->select('feeder')
                ->where('feeder', 'NOT LIKE', '%Incoming%')
                ->distinct()
                ->get();
        } elseif ($jenis === 'incoming') {
            $data = DB::table('data_bebanrst')
                ->select('feeder')
                ->where('feeder', 'like', '%Incoming%')
                ->distinct()
                ->get();
        } else {
            $data = collect([]);
        }

        return response()->json($data);
    }

    public function filter(Request $request)
    {
        $query = DB::table('data_bebanrst');

        if ($request->jenisFeeder === 'penyulang') {
            $query->where('feeder', 'NOT LIKE', '%Incoming%');
        } elseif ($request->jenisFeeder === 'incoming') {
            $query->where('feeder', 'like', '%Incoming%');
        }

        if ($request->feeder && $request->feeder !== "ALL") {
            $query->whereIn('feeder', $request->feeder);
        }

        if ($request->name) {
            $query->where('name', $request->name);
        }

        if ($request->tanggal_awal && $request->tanggal_akhir) {
            $query->whereBetween('tanggal', [$request->tanggal_awal, $request->tanggal_akhir]);
        }

        $data = $query->orderBy('tanggal', 'desc')->get();

        // Jika request AJAX (atau ada param ajax=1), kembalikan JSON
        if ($request->ajax() || $request->has('ajax')) {
            return response()->json(['data' => $data]);
        }

        // Fallback: jika diakses normal, kembalikan view (backward compatibility)
        return view('BebanRST.BebanUP3New.index', compact('data'));
    }


}