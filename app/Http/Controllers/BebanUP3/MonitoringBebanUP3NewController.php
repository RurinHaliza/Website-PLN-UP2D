<?php

namespace App\Http\Controllers\BebanUP3;

use App\Http\Controllers\Controller;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class MonitoringBebanUP3NewController extends Controller
{
    public function index()
    {
        return view('BebanRST.MonitoringBebanUP3New.index');
    }

    // ===============================
    //  BEBAN MAX HARIAN (Card Kecil)
    // ===============================
    public function getMaxValues()
    {
        $today = Carbon::today()->toDateString();
        // $today = \Carbon\Carbon::parse('2025-10-10')->toDateString();


        $maxSiang = DB::table('data_bebanrst')
            ->whereDate('tanggal', $today)
            ->max('max_siang');

        $avgSiang = DB::table('data_bebanrst')
            ->whereDate('tanggal', $today)
            ->average('avg_siang');

        $maxMalam = DB::table('data_bebanrst')
            ->whereDate('tanggal', $today)
            ->max('max_malam');

        $avgMalam = DB::table('data_bebanrst')
            ->whereDate('tanggal', $today)
            ->average('avg_malam');

        return response()->json([
            'maxSiang' => $maxSiang !== null ? number_format($maxSiang, 2, '.', '') : '-',
            'avgSiang' => $avgSiang !== null ? number_format($avgSiang, 2, '.', '') : '-',
            'maxMalam' => $maxMalam !== null ? number_format($maxMalam, 2, '.', '') : '-',
            'avgMalam' => $avgMalam !== null ? number_format($avgMalam, 2, '.', '') : '-',
        ]);
    }

    // ===============================
    // BEBAN TERTINGGI (Total Penyulang)
    // ===============================
    public function totalPenyulangTertinggi(Request $request)
    {
        $periode = $request->query('periode', 'harian'); // default: harian

        $query = DB::table('data_bebanrst_max')
            ->select('tanggal', 'nilai_max', 'waktu_max')
            ->where(function ($q) {
                // $q->whereNull('jenis_feeder')
                //     ->orWhere('jenis_feeder', '');
                $q->where('jenis_feeder','total_penyulang');
            });

        if ($periode === 'harian') {
            $query->whereDate('tanggal', now('Asia/Jakarta')->toDateString());
        } elseif ($periode === 'mingguan') {
            $query->whereBetween('tanggal', [
                \Carbon\Carbon::now('Asia/Jakarta')->startOfWeek()->toDateString(),
                \Carbon\Carbon::now('Asia/Jakarta')->endOfWeek()->toDateString()
            ]);
        } elseif ($periode === 'bulanan') {
            $query->whereBetween('tanggal', [
                \Carbon\Carbon::now('Asia/Jakarta')->startOfMonth()->toDateString(),
                \Carbon\Carbon::now('Asia/Jakarta')->endOfMonth()->toDateString()
            ]);
        }

        $data = $query->orderByDesc('nilai_max')->first();

        return response()->json([
            'periode' => ucfirst($periode),
            'nilai_max' => $data->nilai_max ?? 0,
            'tanggal' => $data->tanggal ?? '-',
            'waktu_max' => $data->waktu_max ?? '-',
        ]);
    }

    // ===============================
    //   BEBAN TERTINGGI (PENYULANG)
    // ===============================
    public function getBebanPenyulangTertinggi()
    {
        // Hanya feeder non_incoming
        $query = DB::table('data_bebanrst_max')
            ->select('tanggal', 'nilai_max', 'waktu_max', 'up3', 'gardu_induk', 'feeder_asal', 'name')
            ->where('jenis_feeder', 'non_incoming');

        // HARI INI
        $harian = (clone $query)
            ->whereDate('tanggal', Carbon::today('Asia/Jakarta'))
            ->orderByDesc('nilai_max')
            ->first();

        // MINGGU INI
        $mingguan = (clone $query)
            ->whereBetween('tanggal', [Carbon::now('Asia/Jakarta')->startOfWeek(), Carbon::now('Asia/Jakarta')->endOfWeek()])
            ->orderByDesc('nilai_max')
            ->first();

        // BULAN INI
        $bulanan = (clone $query)
            ->whereMonth('tanggal', Carbon::now('Asia/Jakarta')->month)
            ->whereYear('tanggal', Carbon::now('Asia/Jakarta')->year)
            ->orderByDesc('nilai_max')
            ->first();

        return response()->json([
            'harian' => $harian,
            'mingguan' => $mingguan,
            'bulanan' => $bulanan
        ]);
    }
}