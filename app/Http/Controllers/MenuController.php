<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\View\View;
use App\Models\data_beban_puncak30;
use App\Models\data_beban_puncak;
use Session;
use App\Models\GITable;
use Illuminate\Support\Facades\Auth;

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

    public function harian()
    {
        $databebanpuncak30 = data_beban_puncak30::paginate(10);
        return view('admin.monitoring.hari', compact('databebanpuncak30'));
    }

    public function mingguan()
    {
        return view('admin.monitoring.minggu');
    }


    public function bulanan()
    {
        return view('admin.monitoring.bulan');
    }

    //beban
    public function bebantrafo()
    {
        return view('admin.beban.trafo');
    }
    public function bebanpenyulang()
    {
        return view('admin.beban.penyulang');
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

    public function create()
    {
        return view('admin.createuser');
    }
}
