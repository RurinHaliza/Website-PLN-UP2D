<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\View\View;
use App\Models\data_beban_puncak30;
use App\Models\data_beban_puncak;
use Carbon\Carbon;
use Session;
use App\Models\GITable;
use Illuminate\Support\Facades\Auth;
use App\Models\Penyulang;
use App\Models\trafo;

class MenuController extends Controller
{

    public function semua()
    {

        if (Auth::user()->hasRole('Administrator')) {

            // Inisialisasi array untuk menyimpan nilai tertinggi untuk setiap bulan
            $nilaiTertinggiPerBulan = [];
            $nilaiRataRataPerBulan = [];

            // Ambil semua data
            $data = data_beban_puncak::all();

            // Loop melalui setiap entri data
            foreach ($data as $item) {
                $bulan = $item->bulan;
                $nilai = max(
                    $item->{'01_S'},
                    $item->{'01_M'},
                    $item->{'02_S'},
                    $item->{'02_M'},
                    // Lanjutkan sampai 31
                );

                // Menghitung rata-rata
                $rataRata = ($item->{'01_S'} + $item->{'01_M'} + $item->{'02_S'} + $item->{'02_M'} /* + ... */) / 31; // Anda perlu menambahkan semua nilai per hari dan dibagi dengan jumlah hari dalam bulan

                // Jika bulan belum ada dalam array, tambahkan
                if (!isset($nilaiTertinggiPerBulan[$bulan])) {
                    $nilaiTertinggiPerBulan[$bulan] = $nilai;
                    $nilaiRataRataPerBulan[$bulan] = $rataRata;
                } else {
                    // Jika nilai tertinggi yang baru ditemukan lebih besar dari yang sebelumnya, update nilai tertinggi
                    $nilaiTertinggiPerBulan[$bulan] = max($nilaiTertinggiPerBulan[$bulan], $nilai);
                    // Tambahkan nilai rata-rata ke array
                    $nilaiRataRataPerBulan[$bulan] += $rataRata;
                }
            }

            // Hitung rata-rata sebenarnya (dibagi dengan jumlah entri)
            foreach ($nilaiRataRataPerBulan as $bulan => $total) {
                $nilaiRataRataPerBulan[$bulan] = $total / count($data);
            }

            // Kirim data nilai tertinggi dan rata-rata ke tampilan untuk ditampilkan
            return view('admin.monitoring.beban', [
                'nilaiTertinggiPerBulan' => $nilaiTertinggiPerBulan,
                'nilaiRataRataPerBulan' => $nilaiRataRataPerBulan,
            ]);
        }
    }

    public function harian(Request $request)
    {
        $selectedDate = $request->input('selected_date', Carbon::today()->toDateString());
        $data = data_beban_puncak30::whereDate('tanggal', $selectedDate)->paginate(10);
        

        // Analytics
        // Mendapatkan tanggal hari ini
        $tanggalHariIni = Carbon::today()->toDateString();
        
        // Mengambil data dari model untuk tanggal hari ini
        $dataHariIni = data_beban_puncak30::whereDate('tanggal', $tanggalHariIni)->get();

        // Mengambil data dari model untuk bulan ini
        $dataBulanIni = data_beban_puncak30::whereMonth('tanggal', now()->month)->get();

        // Mengambil data dari model untuk tahun ini
        $dataTahunIni = data_beban_puncak30::whereMonth('tanggal', now()->year)->get();

        return view('admin.monitoring.hari', compact('data', 'selectedDate', 'dataHariIni', 'dataBulanIni', 'dataTahunIni'));
    }

    public function mingguan(Request $request)
    {
                // Mengambil tanggal yang dipilih dari request
        $selectedDate = $request->input('selected_date', Carbon::today()->toDateString());
        // Mengonversi tanggal yang dipilih menjadi objek Carbon
        $selectedDateCarbon = Carbon::parse($selectedDate);

        // Menghitung tanggal 7 hari yang lalu dari tanggal yang dipilih
        $startDate = $selectedDateCarbon->copy()->subDays(6)->toDateString();
        // Mengambil data dalam rentang tanggal
        $data = data_beban_puncak30::whereBetween('tanggal', [$startDate, $selectedDate])->paginate(10);
        // Analytics
        // Mendapatkan tanggal hari ini
        $tanggalHariIni = Carbon::today()->toDateString();
        
        // Mengambil data dari model untuk tanggal hari ini
        $dataHariIni = data_beban_puncak30::whereDate('tanggal', $tanggalHariIni)->get();

        // Mengambil data dari model untuk bulan ini
        $dataBulanIni = data_beban_puncak30::whereMonth('tanggal', now()->month)->get();

        // Mengambil data dari model untuk tahun ini
        $dataTahunIni = data_beban_puncak30::whereMonth('tanggal', now()->year)->get();

        return view('admin.monitoring.minggu', compact('data', 'selectedDate', 'dataHariIni', 'dataBulanIni', 'dataTahunIni'));
    }


    public function bulanan(Request $request)
    {
        // Mengambil tanggal yang dipilih dari request, atau menggunakan tanggal hari ini jika tidak ada yang dipilih
        $selectedDate = $request->input('selected_date', Carbon::today()->toDateString());
        // Mengonversi tanggal yang dipilih menjadi objek Carbon
        $selectedDateCarbon = Carbon::parse($selectedDate);

        // Menentukan bulan dan tahun dari tanggal yang dipilih
        $selectedMonth = $selectedDateCarbon->month;
        $selectedYear = $selectedDateCarbon->year;

        // Mengambil data untuk bulan dan tahun yang sesuai
        $data = data_beban_puncak30::whereYear('tanggal', $selectedYear)
            ->whereMonth('tanggal', $selectedMonth)
            ->paginate(10);

        // Analytics
        // Mendapatkan tanggal hari ini
        $tanggalHariIni = Carbon::today()->toDateString();
        
        // Mengambil data dari model untuk tanggal hari ini
        $dataHariIni = data_beban_puncak30::whereDate('tanggal', $tanggalHariIni)->get();

        // Mengambil data dari model untuk bulan ini
        $dataBulanIni = data_beban_puncak30::whereMonth('tanggal', now()->month)->get();

        // Mengambil data dari model untuk tahun ini
        $dataTahunIni = data_beban_puncak30::whereMonth('tanggal', now()->year)->get();

        return view('admin.monitoring.bulan', compact('data', 'selectedDate', 'dataHariIni', 'dataBulanIni', 'dataTahunIni'));
    }

    //beban
    public function bebantrafo()
    {

        $trafo = trafo::all();

        return view('admin.beban.trafo',compact('trafo'));
    }
    public function bebanpenyulang()
    {

        $penyulang = Penyulang::all();        

        // dd($penyulang);

        return view('admin.beban.penyulang',compact('penyulang'));
    }
    public function bebanup3()
    {
        return view('admin.beban.up');
    }
    public function bebanktt()
    {
        return view('admin.beban.ktt');
    }

    public function GI()
    {

        $GI = GITable::all();
        // dd($GI);
        return view('admin.beban.GI', compact('GI'));
    }

    // pubic function penyulang

    public function create()
    {
        return view('admin.createuser');
    }
}
