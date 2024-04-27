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
use App\Models\ktt;
use App\Models\mvcell;

use Illuminate\Support\Facades\DB;
// use Carbon;

class MenuController extends Controller
{

    public function semua(Request $request)
    {

        if (Auth::user()->hasRole('Administrator')) {

            $selectedDate = $request->input('selected_date', Carbon::today()->toDateString());
            // Analytics untuk hari ini
        $maxValueT = 0;
        $maxColumnT = '';
        $tanggalHariIni = Carbon::today()->toDateString();
        $dataHariIni = data_beban_puncak30::whereDate('tanggal', $tanggalHariIni)->get();
        foreach ($dataHariIni as $item) {
            foreach (
                [
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
                                        '23_30',
                    '23_59',
                ]
                as $columnNameT
            ) {
                if ($item->{$columnNameT} > $maxValueT) {
                    $maxValueT = $item->{$columnNameT};
                    $maxColumnT = $columnNameT;
                }
            }
        }

        // Analytics untuk bulan ini
        $maxValueMonth = 0;
        $maxColumnMonth = '';
        $maxDateMonth = ''; // Tambahkan variabel untuk menyimpan tanggal
        $dataBulanIni = data_beban_puncak30::whereMonth('tanggal', now()->month)->get();
        foreach ($dataBulanIni as $item) {
            foreach (
                [
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
                                        '23_30',
                    '23_59',
                ]
                as $columnNameMonth
            ) {
                if ($item->{$columnNameMonth} > $maxValueMonth) {
                    $maxValueMonth = $item->{$columnNameMonth};
                    $maxColumnMonth = $columnNameMonth;
                    $maxDateMonth = $item->tanggal; // Simpan tanggalnya
                }
            }
        }

        // Analytics untuk tahun ini
        $maxValueYear = 0;
        $maxColumnYear = '';
        $maxDateYear = ''; // Tambahkan variabel untuk menyimpan tanggal
        $dataTahunIni = data_beban_puncak30::whereYear('tanggal', now()->year)->get();
        foreach ($dataTahunIni as $item) {
            foreach (
                [
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
                                        '23_30',
                    '23_59',
                ]
                as $columnNameYear
            ) {
                if ($item->{$columnNameYear} > $maxValueYear) {
                    $maxValueYear = $item->{$columnNameYear};
                    $maxColumnYear = $columnNameYear;
                    $maxDateYear = $item->tanggal; // Simpan tanggalnya
                }
            }
        }
                
            return view('admin.monitoring.beban',compact('selectedDate','maxValueT', 'maxColumnT', 'maxValueMonth', 'maxColumnMonth', 'maxDateMonth', 'maxValueYear', 'maxColumnYear', 'maxDateYear'));
        
        }
    }

    // public function harian(Request $request)
    // {
    //     $selectedDate = $request->input('selected_date', Carbon::today()->toDateString());
    //     $data = data_beban_puncak30::whereDate('tanggal', $selectedDate)->get();
        

    //     // Analytics
    //     // Mendapatkan tanggal hari ini
    //     $tanggalHariIni = Carbon::today()->toDateString();
        
    //     // Mengambil data dari model untuk tanggal hari ini
    //     $dataHariIni = data_beban_puncak30::whereDate('tanggal', $tanggalHariIni)->get();

    //     // Mengambil data dari model untuk bulan ini
    //     $dataBulanIni = data_beban_puncak30::whereMonth('tanggal', now()->month)->get();

    //     // Mengambil data dari model untuk tahun ini
    //     $dataTahunIni = data_beban_puncak30::whereMonth('tanggal', now()->year)->get();

    //     return view('admin.monitoring.hari', compact('data', 'selectedDate', 'dataHariIni', 'dataBulanIni', 'dataTahunIni'));
    // }

    // public function mingguan(Request $request)
    // {
    //             // Mengambil tanggal yang dipilih dari request
    //     $selectedDate = $request->input('selected_date', Carbon::today()->toDateString());

    //     // dd($selectedDate);

    //     // Mengonversi tanggal yang dipilih menjadi objek Carbon
    //     $selectedDateCarbon = Carbon::parse($selectedDate);
    //     // Menghitung tanggal 7 hari yang lalu dari tanggal yang dipilih
    //     $startDate = $selectedDateCarbon->copy()->subDays(6)->toDateString();
    //     // Mengambil data dalam rentang tanggal
    //     $data = data_beban_puncak30::whereBetween('tanggal', [$startDate, $selectedDate])->paginate(10);
    //     // Analytics
    //     // Mendapatkan tanggal hari ini
    //     $tanggalHariIni = Carbon::today()->toDateString();
        
    //     // Mengambil data dari model untuk tanggal hari ini
    //     $dataHariIni = data_beban_puncak30::whereDate('tanggal', $tanggalHariIni)->get();

    //     // Mengambil data dari model untuk bulan ini
    //     $dataBulanIni = data_beban_puncak30::whereMonth('tanggal', now()->month)->get();

    //     // Mengambil data dari model untuk tahun ini
    //     $dataTahunIni = data_beban_puncak30::whereMonth('tanggal', now()->year)->get();

    //     return view('admin.monitoring.minggu', compact('data', 'selectedDate', 'dataHariIni', 'dataBulanIni', 'dataTahunIni'));
    // }


    // public function bulanan(Request $request)
    // { 
    //     // Mengambil tanggal yang dipilih dari request, atau menggunakan tanggal hari ini jika tidak ada yang dipilih
    //     $selectedDate = $request->input('selected_date', Carbon::today()->toDateString());
    //     // Mengonversi tanggal yang dipilih menjadi objek Carbon
    //     $selectedDateCarbon = Carbon::parse($selectedDate);

    //     // Menentukan bulan dan tahun dari tanggal yang dipilih
    //     $selectedMonth = $selectedDateCarbon->month;
    //     $selectedYear = $selectedDateCarbon->year;

    //     // Mengambil data untuk bulan dan tahun yang sesuai
    //     $data = data_beban_puncak30::whereYear('tanggal', $selectedYear)
    //         ->whereMonth('tanggal', $selectedMonth)
    //         ->paginate(10);

    //     // Analytics
    //     // Mendapatkan tanggal hari ini
    //     $tanggalHariIni = Carbon::today()->toDateString();
        
    //     // Mengambil data dari model untuk tanggal hari ini
    //     $dataHariIni = data_beban_puncak30::whereDate('tanggal', $tanggalHariIni)->get();

    //     // Mengambil data dari model untuk bulan ini
    //     $dataBulanIni = data_beban_puncak30::whereMonth('tanggal', now()->month)->get();

    //     // Mengambil data dari model untuk tahun ini
    //     $dataTahunIni = data_beban_puncak30::whereMonth('tanggal', now()->year)->get();
        

    //     return view('admin.monitoring.bulan', compact('data', 'selectedDate', 'dataHariIni', 'dataBulanIni', 'dataTahunIni'));

    // }

    public function detail(Request $request)
    {
        if (Auth::user()->hasRole('Administrator')) {

        //Mingguan
        // Mengambil tanggal yang dipilih dari request
        $selectedDate3 = $request->input('selected_date3', Carbon::today()->toDateString());

        // dd($selectedDate);

        // Mengonversi tanggal yang dipilih menjadi objek Carbon
        $selectedDateCarbon3 = Carbon::parse($selectedDate3);
        // Menghitung tanggal 7 hari yang lalu dari tanggal yang dipilih
        $startDate = $selectedDateCarbon3->copy()->subDays(6)->toDateString();
        // Mengambil data dalam rentang tanggal
        $data3 = data_beban_puncak30::whereBetween('tanggal', [$startDate, $selectedDate3])->paginate(10);

        // Hitung rata-rata dan nilai maksimum
        $averageValueMingguan = $data3->avg(function ($item) {
            return ($item->{"04_00"} +
                $item->{"04_30"} +
                $item->{"05_00"} +
                                    $item->{"05_30"} +
                                    $item->{"06_00"} +
                                    $item->{"06_30"} +
                                    $item->{"07_00"} +
                                    $item->{"07_30"} +
                                    $item->{"08_00"} +
                                    $item->{"08_30"} +
                                    $item->{"09_00"} +
                                    $item->{"09_30"} +
                                    $item->{"10_00"} +
                                    $item->{"10_30"} +
                                    $item->{"11_00"} +
                                    $item->{"11_30"} +
                                    $item->{"12_00"} +
                                    $item->{"12_30"} +
                                    $item->{"13_00"} +
                                    $item->{"13_30"} +
                                    $item->{"14_00"} +
                                    $item->{"14_30"} +
                                    $item->{"15_00"} +
                                    $item->{"15_30"} +
                $item->{"16_00"}) / 25;
        });

        $maxValueMingguan = 0;
        $maxColumnMingguan = '';
        foreach ($data3 as $item) {
            foreach (
                [
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
                ]
                as $columnNameMingguan
            ) {
                if ($item->{$columnNameMingguan} > $maxValueMingguan) {
                    $maxValueMingguan = $item->{$columnNameMingguan};
                    $maxColumnMingguan = $columnNameMingguan;
                }
            }
        }
        
        // Lakukan hal yang sama untuk data malam
        // Hitung rata-rata dan nilai maksimum
        $averageValueMMingguan = $data3->avg(function ($item) {
            return ($item->{"04_00"} +
                $item->{"04_30"} +
                $item->{"05_00"} +
                                    $item->{"05_30"} +
                                    $item->{"06_00"} +
                                    $item->{"06_30"} +
                                    $item->{"07_00"} +
                                    $item->{"07_30"} +
                                    $item->{"08_00"} +
                                    $item->{"08_30"} +
                                    $item->{"09_00"} +
                                    $item->{"09_30"} +
                                    $item->{"10_00"} +
                                    $item->{"10_30"} +
                                    $item->{"11_00"} +
                                    $item->{"11_30"} +
                                    $item->{"12_00"} +
                                    $item->{"12_30"} +
                                    $item->{"13_00"} +
                                    $item->{"13_30"} +
                                    $item->{"14_00"} +
                                    $item->{"14_30"} +
                                    $item->{"15_00"} +
                                    $item->{"15_30"} +
                $item->{"16_00"}) / 25;
        });

        $maxValueMMingguan = 0;
        $maxColumnMMingguan = '';
        foreach ($data3 as $item) {
            foreach (
                [
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
                ]
                as $columnNameMMingguan
            ) {
                if ($item->{$columnNameMMingguan} > $maxValueMMingguan) {
                    $maxValueMMingguan = $item->{$columnNameMMingguan};
                    $maxColumnMMingguan = $columnNameMMingguan;
                }
            }
        }

        //Bulanan
        // Mengambil tanggal yang dipilih dari request, atau menggunakan tanggal hari ini jika tidak ada yang dipilih
        $selectedDate2 = $request->input('selected_date2', Carbon::today()->toDateString());
        // Mengonversi tanggal yang dipilih menjadi objek Carbon
        $selectedDateCarbon = Carbon::parse($selectedDate2);

        // Menentukan bulan dan tahun dari tanggal yang dipilih
        $selectedMonth = $selectedDateCarbon->month;
        $selectedYear = $selectedDateCarbon->year;

        // Mengambil data untuk bulan dan tahun yang sesuai
        $data2 = data_beban_puncak30::whereYear('tanggal', $selectedYear)
            ->whereMonth('tanggal', $selectedMonth)
            ->paginate(10);

        // Hitung rata-rata dan nilai maksimum
        $averageValueBulanan = $data2->avg(function ($item) {
            return ($item->{"04_00"} +
                $item->{"04_30"} +
                $item->{"05_00"} +
                                    $item->{"05_30"} +
                                    $item->{"06_00"} +
                                    $item->{"06_30"} +
                                    $item->{"07_00"} +
                                    $item->{"07_30"} +
                                    $item->{"08_00"} +
                                    $item->{"08_30"} +
                                    $item->{"09_00"} +
                                    $item->{"09_30"} +
                                    $item->{"10_00"} +
                                    $item->{"10_30"} +
                                    $item->{"11_00"} +
                                    $item->{"11_30"} +
                                    $item->{"12_00"} +
                                    $item->{"12_30"} +
                                    $item->{"13_00"} +
                                    $item->{"13_30"} +
                                    $item->{"14_00"} +
                                    $item->{"14_30"} +
                                    $item->{"15_00"} +
                                    $item->{"15_30"} +
                $item->{"16_00"}) / 25;
        });

        $maxValueBulanan = 0;
        $maxColumnBulanan = '';
        foreach ($data2 as $item) {
            foreach (
                [
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
                ]
                as $columnNameBulanan
            ) {
                if ($item->{$columnNameBulanan} > $maxValueBulanan) {
                    $maxValueBulanan = $item->{$columnNameBulanan};
                    $maxColumnBulanan = $columnNameBulanan;
                }
            }
        }
        
        // Lakukan hal yang sama untuk data malam
        // Hitung rata-rata dan nilai maksimum
        $averageValueMBulanan = $data2->avg(function ($item) {
            return ($item->{"04_00"} +
                $item->{"04_30"} +
                $item->{"05_00"} +
                                    $item->{"05_30"} +
                                    $item->{"06_00"} +
                                    $item->{"06_30"} +
                                    $item->{"07_00"} +
                                    $item->{"07_30"} +
                                    $item->{"08_00"} +
                                    $item->{"08_30"} +
                                    $item->{"09_00"} +
                                    $item->{"09_30"} +
                                    $item->{"10_00"} +
                                    $item->{"10_30"} +
                                    $item->{"11_00"} +
                                    $item->{"11_30"} +
                                    $item->{"12_00"} +
                                    $item->{"12_30"} +
                                    $item->{"13_00"} +
                                    $item->{"13_30"} +
                                    $item->{"14_00"} +
                                    $item->{"14_30"} +
                                    $item->{"15_00"} +
                                    $item->{"15_30"} +
                $item->{"16_00"}) / 25;
        });

        $maxValueMBulanan = 0;
        $maxColumnMBulanan = '';
        foreach ($data2 as $item) {
            foreach (
                [
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
                ]
                as $columnNameMBulanan
            ) {
                if ($item->{$columnNameMBulanan} > $maxValueMBulanan) {
                    $maxValueMBulanan = $item->{$columnNameMBulanan};
                    $maxColumnMBulanan = $columnNameMBulanan;
                }
            }
        }


        //Harian
        $selectedDate = $request->input('selected_date', Carbon::today()->toDateString());
        $data = data_beban_puncak30::whereDate('tanggal', $selectedDate)->get();
        
        // Hitung rata-rata dan nilai maksimum
        $averageValue = $data->avg(function ($item) {
            return ($item->{"04_00"} +
                $item->{"04_30"} +
                $item->{"05_00"} +
                                    $item->{"05_30"} +
                                    $item->{"06_00"} +
                                    $item->{"06_30"} +
                                    $item->{"07_00"} +
                                    $item->{"07_30"} +
                                    $item->{"08_00"} +
                                    $item->{"08_30"} +
                                    $item->{"09_00"} +
                                    $item->{"09_30"} +
                                    $item->{"10_00"} +
                                    $item->{"10_30"} +
                                    $item->{"11_00"} +
                                    $item->{"11_30"} +
                                    $item->{"12_00"} +
                                    $item->{"12_30"} +
                                    $item->{"13_00"} +
                                    $item->{"13_30"} +
                                    $item->{"14_00"} +
                                    $item->{"14_30"} +
                                    $item->{"15_00"} +
                                    $item->{"15_30"} +
                $item->{"16_00"}) / 25;
        });

        $maxValue = 0;
        $maxColumn = '';
        foreach ($data as $item) {
            foreach (
                [
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
                ]
                as $columnName
            ) {
                if ($item->{$columnName} > $maxValue) {
                    $maxValue = $item->{$columnName};
                    $maxColumn = $columnName;
                }
            }
        }
        
        // Lakukan hal yang sama untuk data malam
        // Hitung rata-rata dan nilai maksimum
        $averageValueM = $data->avg(function ($item) {
            return ($item->{"04_00"} +
                $item->{"04_30"} +
                $item->{"05_00"} +
                                    $item->{"05_30"} +
                                    $item->{"06_00"} +
                                    $item->{"06_30"} +
                                    $item->{"07_00"} +
                                    $item->{"07_30"} +
                                    $item->{"08_00"} +
                                    $item->{"08_30"} +
                                    $item->{"09_00"} +
                                    $item->{"09_30"} +
                                    $item->{"10_00"} +
                                    $item->{"10_30"} +
                                    $item->{"11_00"} +
                                    $item->{"11_30"} +
                                    $item->{"12_00"} +
                                    $item->{"12_30"} +
                                    $item->{"13_00"} +
                                    $item->{"13_30"} +
                                    $item->{"14_00"} +
                                    $item->{"14_30"} +
                                    $item->{"15_00"} +
                                    $item->{"15_30"} +
                $item->{"16_00"}) / 25;
        });

        $maxValueM = 0;
        $maxColumnM = '';
        foreach ($data as $item) {
            foreach (
                [
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
                ]
                as $columnNameM
            ) {
                if ($item->{$columnNameM} > $maxValueM) {
                    $maxValueM = $item->{$columnNameM};
                    $maxColumnM = $columnNameM;
                }
            }
        }

        // Analytics untuk hari ini
        $maxValueT = 0;
        $maxColumnT = '';
        $tanggalHariIni = Carbon::today()->toDateString();
        $dataHariIni = data_beban_puncak30::whereDate('tanggal', $tanggalHariIni)->get();
        foreach ($dataHariIni as $item) {
            foreach (
                [
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
                                        '23_30',
                    '23_59',
                ]
                as $columnNameT
            ) {
                if ($item->{$columnNameT} > $maxValueT) {
                    $maxValueT = $item->{$columnNameT};
                    $maxColumnT = $columnNameT;
                }
            }
        }

        // Analytics untuk bulan ini
        $maxValueMonth = 0;
        $maxColumnMonth = '';
        $maxDateMonth = ''; // Tambahkan variabel untuk menyimpan tanggal
        $dataBulanIni = data_beban_puncak30::whereMonth('tanggal', now()->month)->get();
        foreach ($dataBulanIni as $item) {
            foreach (
                [
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
                                        '23_30',
                    '23_59',
                ]
                as $columnNameMonth
            ) {
                if ($item->{$columnNameMonth} > $maxValueMonth) {
                    $maxValueMonth = $item->{$columnNameMonth};
                    $maxColumnMonth = $columnNameMonth;
                    $maxDateMonth = $item->tanggal; // Simpan tanggalnya
                }
            }
        }

        // Analytics untuk tahun ini
        $maxValueYear = 0;
        $maxColumnYear = '';
        $maxDateYear = ''; // Tambahkan variabel untuk menyimpan tanggal
        $dataTahunIni = data_beban_puncak30::whereYear('tanggal', now()->year)->get();
        foreach ($dataTahunIni as $item) {
            foreach (
                [
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
                                        '23_30',
                    '23_59',
                ]
                as $columnNameYear
            ) {
                if ($item->{$columnNameYear} > $maxValueYear) {
                    $maxValueYear = $item->{$columnNameYear};
                    $maxColumnYear = $columnNameYear;
                    $maxDateYear = $item->tanggal; // Simpan tanggalnya
                }
            }
        }
        }
        return view('admin.monitoring.detail', compact('data', 'selectedDate', 'dataHariIni', 'dataBulanIni', 'dataTahunIni', 'averageValue', 'maxValue', 'maxColumn','data2', 'selectedDate2', 'averageValueBulanan', 'maxValueBulanan', 'maxColumnBulanan','averageValueMBulanan', 'maxValueMBulanan', 'maxColumnMBulanan','data3', 'selectedDate3', 'averageValueMingguan', 'maxValueMingguan', 'maxColumnMingguan','averageValueMMingguan', 'maxValueMMingguan', 'maxColumnMMingguan','averageValueM', 'maxValueM', 'maxColumnM', 'maxValueT', 'maxColumnT', 'maxValueMonth', 'maxColumnMonth', 'maxDateMonth', 'maxValueYear', 'maxColumnYear', 'maxDateYear'));
    }


    //beban
    public function bebantrafo()
    {
        if(Auth::user()->hasRole('Administrator')){

            $trafo = trafo::all();

            return view('admin.beban.trafo',compact('trafo'));
        }
    }

    public function mvcell(){

        if(Auth::user()->hasRole('Administrator')){

            $data = mvcell::all();

            return view('admin.beban.MVCELL.mvcell',compact('data'));
        }

    }

    public function DetailMVCELL($id){

        if(Auth::user()->hasRole('Administrator')){

            $data = mvcell::findOrFail($id);

            // dd($data);

            return view('admin.beban.MVCELL.detail',compact('data'));

        }

    }

    public function EditMVCELL($id){

        if(Auth::user()->hasRole('Administrator')){

            $data = mvcell::findOrFail($id);

            // dd($data);

            return view('admin.beban.MVCELL.edit',compact('data'));

        }

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
        $bebanktt = ktt::all();
        //dd($bebanktt);
        return view('admin.beban.ktt', compact ('bebanktt'));
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
