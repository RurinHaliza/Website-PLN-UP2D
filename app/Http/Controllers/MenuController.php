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
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\mvcellExport;

class MenuController extends Controller
{

    public function semua(Request $request)
    {

        if (Auth::user()->hasRole(['Administrator','operator','ValidatorOpsis','ValidatorFasop','EditorOpsis','Visitor'])) {

            $selectedDate = $request->input('selected_date', Carbon::today()->toDateString());
            // Analytics untuk hari ini
            $maxValueToday = 0;
            $maxColumnToday = '';
            $tanggalHariIni = Carbon::today()->toDateString();
            $dataHariIni = data_beban_puncak30::whereDate('tanggal', $tanggalHariIni)->get();
            foreach ($dataHariIni as $item) {
                foreach ([
                    '00_30', '01_00', '01_30', '02_00', '02_30', '03_00', '03_30', '04_00', '04_30', '05_00', '05_30', '06_00', '06_30', '07_00', '07_30', '08_00', '08_30', '09_00', '09_30', '10_00', '10_30', '11_00', '11_30', '12_00', '12_30', '13_00', '13_30', '14_00', '14_30', '15_00', '15_30', '16_00', '16_30', '17_00', '17_30', '18_00', '18_30', '19_00', '19_30', '20_00', '20_30', '21_00', '21_30', '22_00', '22_30', '23_00', '23_30', '23_59',
                ]
                    as $columnNameT) {
                    if ($item->{$columnNameT} > $maxValueToday) {
                        $maxValueToday = $item->{$columnNameT};
                        $maxColumnToday = $columnNameT;
                    }
                }
            }

            // Analytics untuk bulan ini
            $maxValueMonth = 0;
            $maxColumnMonth = '';
            $maxDateMonth = ''; // Tambahkan variabel untuk menyimpan tanggal
            $dataBulanIni = data_beban_puncak30::whereMonth('tanggal', now()->month)->get();
            foreach ($dataBulanIni as $item) {
                foreach ([
                    '00_30', '01_00', '01_30', '02_00', '02_30', '03_00', '03_30', '04_00', '04_30', '05_00', '05_30', '06_00', '06_30', '07_00', '07_30', '08_00', '08_30', '09_00', '09_30', '10_00', '10_30', '11_00', '11_30', '12_00', '12_30', '13_00', '13_30', '14_00', '14_30', '15_00', '15_30', '16_00', '16_30', '17_00', '17_30', '18_00', '18_30', '19_00', '19_30', '20_00', '20_30', '21_00', '21_30', '22_00', '22_30', '23_00', '23_30', '23_59',
                ]
                    as $columnNameMonth) {
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
                foreach ([
                    '00_30', '01_00', '01_30', '02_00', '02_30', '03_00', '03_30', '04_00', '04_30', '05_00', '05_30', '06_00', '06_30', '07_00', '07_30', '08_00', '08_30', '09_00', '09_30', '10_00', '10_30', '11_00', '11_30', '12_00', '12_30', '13_00', '13_30', '14_00', '14_30', '15_00', '15_30', '16_00', '16_30', '17_00', '17_30', '18_00', '18_30', '19_00', '19_30', '20_00', '20_30', '21_00', '21_30', '22_00', '22_30', '23_00', '23_30', '23_59',
                ]
                    as $columnNameYear) {
                    if ($item->{$columnNameYear} > $maxValueYear) {
                        $maxValueYear = $item->{$columnNameYear};
                        $maxColumnYear = $columnNameYear;
                        $maxDateYear = $item->tanggal; // Simpan tanggalnya
                    }
                }
            }


            //Hitugnan dilakukan pertahun rata - rata

            $sumjanuary =  DB::table('data_beban_puncak30')
                ->whereBetween('tanggal', ['2024-01-01', '2024-01-31'])
                // ->max('00_30');
                ->get();

            // ->max(\DB::raw(['00_30','01_00']));

            // dd($sumjanuary);

            // ->sum(\DB::raw('00_30 + 01_00 + 01_30 + 02_00 + 02_30 + 03_00 + 03_30 + 04_00 + 04_30 + '));
            // dd($sumjanuary);

            //kenaikan pada 3 hari


            //data grafik 5 hari kebelakang
            $hari1 = Carbon::yesterday()->subDays(3)->toDateString();
            $hari2 = Carbon::yesterday()->subDays(2)->toDateString();
            $tanggalKemarin = Carbon::yesterday()->toDateString();
            $tanggalKemarinLusa = Carbon::yesterday()->subDays(1)->toDateString();

            $dataharike1 = data_beban_puncak30::where('tanggal', $tanggalHariIni)->sum('00_30') + data_beban_puncak30::where('tanggal', $tanggalHariIni)->sum('01_00') + data_beban_puncak30::where('tanggal', $tanggalHariIni)->sum('01_30') + data_beban_puncak30::where('tanggal', $tanggalHariIni)->sum('02_00') + data_beban_puncak30::where('tanggal', $tanggalHariIni)->sum('02_30') + data_beban_puncak30::where('tanggal', $tanggalHariIni)->sum('03_00') + data_beban_puncak30::where('tanggal', $tanggalHariIni)->sum('03_30') + data_beban_puncak30::where('tanggal', $tanggalHariIni)->sum('04_00') + data_beban_puncak30::where('tanggal', $tanggalHariIni)->sum('04_30') + data_beban_puncak30::where('tanggal', $tanggalHariIni)->sum('05_00') + data_beban_puncak30::where('tanggal', $tanggalHariIni)->sum('05_30') + data_beban_puncak30::where('tanggal', $tanggalHariIni)->sum('06_00') + data_beban_puncak30::where('tanggal', $tanggalHariIni)->sum('06_30') + data_beban_puncak30::where('tanggal', $tanggalHariIni)->sum('07_00') + data_beban_puncak30::where('tanggal', $tanggalHariIni)->sum('07_30') + data_beban_puncak30::where('tanggal', $tanggalHariIni)->sum('08_00') + data_beban_puncak30::where('tanggal', $tanggalHariIni)->sum('08_30') + data_beban_puncak30::where('tanggal', $tanggalHariIni)->sum('09_00') + data_beban_puncak30::where('tanggal', $tanggalHariIni)->sum('09_30') + data_beban_puncak30::where('tanggal', $tanggalHariIni)->sum('10_00') + data_beban_puncak30::where('tanggal', $tanggalHariIni)->sum('10_30') + data_beban_puncak30::where('tanggal', $tanggalHariIni)->sum('11_00') + data_beban_puncak30::where('tanggal', $tanggalHariIni)->sum('11_30') + data_beban_puncak30::where('tanggal', $tanggalHariIni)->sum('12_00') + data_beban_puncak30::where('tanggal', $tanggalHariIni)->sum('12_30') + data_beban_puncak30::where('tanggal', $tanggalHariIni)->sum('13_00') + data_beban_puncak30::where('tanggal', $tanggalHariIni)->sum('13_30') + data_beban_puncak30::where('tanggal', $tanggalHariIni)->sum('14_00') + data_beban_puncak30::where('tanggal', $tanggalHariIni)->sum('14_30') + data_beban_puncak30::where('tanggal', $tanggalHariIni)->sum('15_00') + data_beban_puncak30::where('tanggal', $tanggalHariIni)->sum('15_30') + data_beban_puncak30::where('tanggal', $tanggalHariIni)->sum('16_00') + data_beban_puncak30::where('tanggal', $tanggalHariIni)->sum('16_30') + data_beban_puncak30::where('tanggal', $tanggalHariIni)->sum('17_00') + data_beban_puncak30::where('tanggal', $tanggalHariIni)->sum('17_30') + data_beban_puncak30::where('tanggal', $tanggalHariIni)->sum('18_00') + data_beban_puncak30::where('tanggal', $tanggalHariIni)->sum('18_30') + data_beban_puncak30::where('tanggal', $tanggalHariIni)->sum('19_00') + data_beban_puncak30::where('tanggal', $tanggalHariIni)->sum('19_30') + data_beban_puncak30::where('tanggal', $tanggalHariIni)->sum('20_00') + data_beban_puncak30::where('tanggal', $tanggalHariIni)->sum('20_30') + data_beban_puncak30::where('tanggal', $tanggalHariIni)->sum('21_00') + data_beban_puncak30::where('tanggal', $tanggalHariIni)->sum('21_30') + data_beban_puncak30::where('tanggal', $tanggalHariIni)->sum('22_00') + data_beban_puncak30::where('tanggal', $tanggalHariIni)->sum('22_30') + data_beban_puncak30::where('tanggal', $tanggalHariIni)->sum('23_00') + data_beban_puncak30::where('tanggal', $tanggalHariIni)->sum('23_30') + data_beban_puncak30::where('tanggal', $tanggalHariIni)->sum('23_59');
            $dataharike2 = data_beban_puncak30::where('tanggal', $tanggalKemarin)->sum('00_30') + data_beban_puncak30::where('tanggal', $tanggalKemarin)->sum('01_00') + data_beban_puncak30::where('tanggal', $tanggalKemarin)->sum('01_30') + data_beban_puncak30::where('tanggal', $tanggalKemarin)->sum('02_00') + data_beban_puncak30::where('tanggal', $tanggalKemarin)->sum('02_30') + data_beban_puncak30::where('tanggal', $tanggalKemarin)->sum('03_00') + data_beban_puncak30::where('tanggal', $tanggalKemarin)->sum('03_30') + data_beban_puncak30::where('tanggal', $tanggalKemarin)->sum('04_00') + data_beban_puncak30::where('tanggal', $tanggalKemarin)->sum('04_30') + data_beban_puncak30::where('tanggal', $tanggalKemarin)->sum('05_00') + data_beban_puncak30::where('tanggal', $tanggalKemarin)->sum('05_30') + data_beban_puncak30::where('tanggal', $tanggalKemarin)->sum('06_00') + data_beban_puncak30::where('tanggal', $tanggalKemarin)->sum('06_30') + data_beban_puncak30::where('tanggal', $tanggalKemarin)->sum('07_00') + data_beban_puncak30::where('tanggal', $tanggalKemarin)->sum('07_30') + data_beban_puncak30::where('tanggal', $tanggalKemarin)->sum('08_00') + data_beban_puncak30::where('tanggal', $tanggalKemarin)->sum('08_30') + data_beban_puncak30::where('tanggal', $tanggalKemarin)->sum('09_00') + data_beban_puncak30::where('tanggal', $tanggalKemarin)->sum('09_30') + data_beban_puncak30::where('tanggal', $tanggalKemarin)->sum('10_00') + data_beban_puncak30::where('tanggal', $tanggalKemarin)->sum('10_30') + data_beban_puncak30::where('tanggal', $tanggalKemarin)->sum('11_00') + data_beban_puncak30::where('tanggal', $tanggalKemarin)->sum('11_30') + data_beban_puncak30::where('tanggal', $tanggalKemarin)->sum('12_00') + data_beban_puncak30::where('tanggal', $tanggalKemarin)->sum('12_30') + data_beban_puncak30::where('tanggal', $tanggalKemarin)->sum('13_00') + data_beban_puncak30::where('tanggal', $tanggalKemarin)->sum('13_30') + data_beban_puncak30::where('tanggal', $tanggalKemarin)->sum('14_00') + data_beban_puncak30::where('tanggal', $tanggalKemarin)->sum('14_30') + data_beban_puncak30::where('tanggal', $tanggalKemarin)->sum('15_00') + data_beban_puncak30::where('tanggal', $tanggalKemarin)->sum('15_30') + data_beban_puncak30::where('tanggal', $tanggalKemarin)->sum('16_00') + data_beban_puncak30::where('tanggal', $tanggalKemarin)->sum('16_30') + data_beban_puncak30::where('tanggal', $tanggalKemarin)->sum('17_00') + data_beban_puncak30::where('tanggal', $tanggalKemarin)->sum('17_30') + data_beban_puncak30::where('tanggal', $tanggalKemarin)->sum('18_00') + data_beban_puncak30::where('tanggal', $tanggalKemarin)->sum('18_30') + data_beban_puncak30::where('tanggal', $tanggalKemarin)->sum('19_00') + data_beban_puncak30::where('tanggal', $tanggalKemarin)->sum('19_30') + data_beban_puncak30::where('tanggal', $tanggalKemarin)->sum('20_00') + data_beban_puncak30::where('tanggal', $tanggalKemarin)->sum('20_30') + data_beban_puncak30::where('tanggal', $tanggalKemarin)->sum('21_00') + data_beban_puncak30::where('tanggal', $tanggalKemarin)->sum('21_30') + data_beban_puncak30::where('tanggal', $tanggalKemarin)->sum('22_00') + data_beban_puncak30::where('tanggal', $tanggalKemarin)->sum('22_30') + data_beban_puncak30::where('tanggal', $tanggalKemarin)->sum('23_00') + data_beban_puncak30::where('tanggal', $tanggalKemarin)->sum('23_30') + data_beban_puncak30::where('tanggal', $tanggalKemarin)->sum('23_59');
            $dataharike3 = data_beban_puncak30::where('tanggal', $tanggalKemarinLusa)->sum('00_30') + data_beban_puncak30::where('tanggal', $tanggalKemarinLusa)->sum('01_00') + data_beban_puncak30::where('tanggal', $tanggalKemarinLusa)->sum('01_30') + data_beban_puncak30::where('tanggal', $tanggalKemarinLusa)->sum('02_00') + data_beban_puncak30::where('tanggal', $tanggalKemarinLusa)->sum('02_30') + data_beban_puncak30::where('tanggal', $tanggalKemarinLusa)->sum('03_00') + data_beban_puncak30::where('tanggal', $tanggalKemarinLusa)->sum('03_30') + data_beban_puncak30::where('tanggal', $tanggalKemarinLusa)->sum('04_00') + data_beban_puncak30::where('tanggal', $tanggalKemarinLusa)->sum('04_30') + data_beban_puncak30::where('tanggal', $tanggalKemarinLusa)->sum('05_00') + data_beban_puncak30::where('tanggal', $tanggalKemarinLusa)->sum('05_30') + data_beban_puncak30::where('tanggal', $tanggalKemarinLusa)->sum('06_00') + data_beban_puncak30::where('tanggal', $tanggalKemarinLusa)->sum('06_30') + data_beban_puncak30::where('tanggal', $tanggalKemarinLusa)->sum('07_00') + data_beban_puncak30::where('tanggal', $tanggalKemarinLusa)->sum('07_30') + data_beban_puncak30::where('tanggal', $tanggalKemarinLusa)->sum('08_00') + data_beban_puncak30::where('tanggal', $tanggalKemarinLusa)->sum('08_30') + data_beban_puncak30::where('tanggal', $tanggalKemarinLusa)->sum('09_00') + data_beban_puncak30::where('tanggal', $tanggalKemarinLusa)->sum('09_30') + data_beban_puncak30::where('tanggal', $tanggalKemarinLusa)->sum('10_00') + data_beban_puncak30::where('tanggal', $tanggalKemarinLusa)->sum('10_30') + data_beban_puncak30::where('tanggal', $tanggalKemarinLusa)->sum('11_00') + data_beban_puncak30::where('tanggal', $tanggalKemarinLusa)->sum('11_30') + data_beban_puncak30::where('tanggal', $tanggalKemarinLusa)->sum('12_00') + data_beban_puncak30::where('tanggal', $tanggalKemarinLusa)->sum('12_30') + data_beban_puncak30::where('tanggal', $tanggalKemarinLusa)->sum('13_00') + data_beban_puncak30::where('tanggal', $tanggalKemarinLusa)->sum('13_30') + data_beban_puncak30::where('tanggal', $tanggalKemarinLusa)->sum('14_00') + data_beban_puncak30::where('tanggal', $tanggalKemarinLusa)->sum('14_30') + data_beban_puncak30::where('tanggal', $tanggalKemarinLusa)->sum('15_00') + data_beban_puncak30::where('tanggal', $tanggalKemarinLusa)->sum('15_30') + data_beban_puncak30::where('tanggal', $tanggalKemarinLusa)->sum('16_00') + data_beban_puncak30::where('tanggal', $tanggalKemarinLusa)->sum('16_30') + data_beban_puncak30::where('tanggal', $tanggalKemarinLusa)->sum('17_00') + data_beban_puncak30::where('tanggal', $tanggalKemarinLusa)->sum('17_30') + data_beban_puncak30::where('tanggal', $tanggalKemarinLusa)->sum('18_00') + data_beban_puncak30::where('tanggal', $tanggalKemarinLusa)->sum('18_30') + data_beban_puncak30::where('tanggal', $tanggalKemarinLusa)->sum('19_00') + data_beban_puncak30::where('tanggal', $tanggalKemarinLusa)->sum('19_30') + data_beban_puncak30::where('tanggal', $tanggalKemarinLusa)->sum('20_00') + data_beban_puncak30::where('tanggal', $tanggalKemarinLusa)->sum('20_30') + data_beban_puncak30::where('tanggal', $tanggalKemarinLusa)->sum('21_00') + data_beban_puncak30::where('tanggal', $tanggalKemarinLusa)->sum('21_30') + data_beban_puncak30::where('tanggal', $tanggalKemarinLusa)->sum('22_00') + data_beban_puncak30::where('tanggal', $tanggalKemarinLusa)->sum('22_30') + data_beban_puncak30::where('tanggal', $tanggalKemarinLusa)->sum('23_00') + data_beban_puncak30::where('tanggal', $tanggalKemarinLusa)->sum('23_30') + data_beban_puncak30::where('tanggal', $tanggalKemarinLusa)->sum('23_59');
            $dataharike4 = data_beban_puncak30::where('tanggal', $hari2)->sum('00_30') + data_beban_puncak30::where('tanggal', $hari2)->sum('01_00') + data_beban_puncak30::where('tanggal', $hari2)->sum('01_30') + data_beban_puncak30::where('tanggal', $hari2)->sum('02_00') + data_beban_puncak30::where('tanggal', $hari2)->sum('02_30') + data_beban_puncak30::where('tanggal', $hari2)->sum('03_00') + data_beban_puncak30::where('tanggal', $hari2)->sum('03_30') + data_beban_puncak30::where('tanggal', $hari2)->sum('04_00') + data_beban_puncak30::where('tanggal', $hari2)->sum('04_30') + data_beban_puncak30::where('tanggal', $hari2)->sum('05_00') + data_beban_puncak30::where('tanggal', $hari2)->sum('05_30') + data_beban_puncak30::where('tanggal', $hari2)->sum('06_00') + data_beban_puncak30::where('tanggal', $hari2)->sum('06_30') + data_beban_puncak30::where('tanggal', $hari2)->sum('07_00') + data_beban_puncak30::where('tanggal', $hari2)->sum('07_30') + data_beban_puncak30::where('tanggal', $hari2)->sum('08_00') + data_beban_puncak30::where('tanggal', $hari2)->sum('08_30') + data_beban_puncak30::where('tanggal', $hari2)->sum('09_00') + data_beban_puncak30::where('tanggal', $hari2)->sum('09_30') + data_beban_puncak30::where('tanggal', $hari2)->sum('10_00') + data_beban_puncak30::where('tanggal', $hari2)->sum('10_30') + data_beban_puncak30::where('tanggal', $hari2)->sum('11_00') + data_beban_puncak30::where('tanggal', $hari2)->sum('11_30') + data_beban_puncak30::where('tanggal', $hari2)->sum('12_00') + data_beban_puncak30::where('tanggal', $hari2)->sum('12_30') + data_beban_puncak30::where('tanggal', $hari2)->sum('13_00') + data_beban_puncak30::where('tanggal', $hari2)->sum('13_30') + data_beban_puncak30::where('tanggal', $hari2)->sum('14_00') + data_beban_puncak30::where('tanggal', $hari2)->sum('14_30') + data_beban_puncak30::where('tanggal', $hari2)->sum('15_00') + data_beban_puncak30::where('tanggal', $hari2)->sum('15_30') + data_beban_puncak30::where('tanggal', $hari2)->sum('16_00') + data_beban_puncak30::where('tanggal', $hari2)->sum('16_30') + data_beban_puncak30::where('tanggal', $hari2)->sum('17_00') + data_beban_puncak30::where('tanggal', $hari2)->sum('17_30') + data_beban_puncak30::where('tanggal', $hari2)->sum('18_00') + data_beban_puncak30::where('tanggal', $hari2)->sum('18_30') + data_beban_puncak30::where('tanggal', $hari2)->sum('19_00') + data_beban_puncak30::where('tanggal', $hari2)->sum('19_30') + data_beban_puncak30::where('tanggal', $hari2)->sum('20_00') + data_beban_puncak30::where('tanggal', $hari2)->sum('20_30') + data_beban_puncak30::where('tanggal', $hari2)->sum('21_00') + data_beban_puncak30::where('tanggal', $hari2)->sum('21_30') + data_beban_puncak30::where('tanggal', $hari2)->sum('22_00') + data_beban_puncak30::where('tanggal', $hari2)->sum('22_30') + data_beban_puncak30::where('tanggal', $hari2)->sum('23_00') + data_beban_puncak30::where('tanggal', $hari2)->sum('23_30') + data_beban_puncak30::where('tanggal', $hari2)->sum('23_59');
            $dataharike5 = data_beban_puncak30::where('tanggal', $hari1)->sum('00_30') + data_beban_puncak30::where('tanggal', $hari1)->sum('01_00') + data_beban_puncak30::where('tanggal', $hari1)->sum('01_30') + data_beban_puncak30::where('tanggal', $hari1)->sum('02_00') + data_beban_puncak30::where('tanggal', $hari1)->sum('02_30') + data_beban_puncak30::where('tanggal', $hari1)->sum('03_00') + data_beban_puncak30::where('tanggal', $hari1)->sum('03_30') + data_beban_puncak30::where('tanggal', $hari1)->sum('04_00') + data_beban_puncak30::where('tanggal', $hari1)->sum('04_30') + data_beban_puncak30::where('tanggal', $hari1)->sum('05_00') + data_beban_puncak30::where('tanggal', $hari1)->sum('05_30') + data_beban_puncak30::where('tanggal', $hari1)->sum('06_00') + data_beban_puncak30::where('tanggal', $hari1)->sum('06_30') + data_beban_puncak30::where('tanggal', $hari1)->sum('07_00') + data_beban_puncak30::where('tanggal', $hari1)->sum('07_30') + data_beban_puncak30::where('tanggal', $hari1)->sum('08_00') + data_beban_puncak30::where('tanggal', $hari1)->sum('08_30') + data_beban_puncak30::where('tanggal', $hari1)->sum('09_00') + data_beban_puncak30::where('tanggal', $hari1)->sum('09_30') + data_beban_puncak30::where('tanggal', $hari1)->sum('10_00') + data_beban_puncak30::where('tanggal', $hari1)->sum('10_30') + data_beban_puncak30::where('tanggal', $hari1)->sum('11_00') + data_beban_puncak30::where('tanggal', $hari1)->sum('11_30') + data_beban_puncak30::where('tanggal', $hari1)->sum('12_00') + data_beban_puncak30::where('tanggal', $hari1)->sum('12_30') + data_beban_puncak30::where('tanggal', $hari1)->sum('13_00') + data_beban_puncak30::where('tanggal', $hari1)->sum('13_30') + data_beban_puncak30::where('tanggal', $hari1)->sum('14_00') + data_beban_puncak30::where('tanggal', $hari1)->sum('14_30') + data_beban_puncak30::where('tanggal', $hari1)->sum('15_00') + data_beban_puncak30::where('tanggal', $hari1)->sum('15_30') + data_beban_puncak30::where('tanggal', $hari1)->sum('16_00') + data_beban_puncak30::where('tanggal', $hari1)->sum('16_30') + data_beban_puncak30::where('tanggal', $hari1)->sum('17_00') + data_beban_puncak30::where('tanggal', $hari1)->sum('17_30') + data_beban_puncak30::where('tanggal', $hari1)->sum('18_00') + data_beban_puncak30::where('tanggal', $hari1)->sum('18_30') + data_beban_puncak30::where('tanggal', $hari1)->sum('19_00') + data_beban_puncak30::where('tanggal', $hari1)->sum('19_30') + data_beban_puncak30::where('tanggal', $hari1)->sum('20_00') + data_beban_puncak30::where('tanggal', $hari1)->sum('20_30') + data_beban_puncak30::where('tanggal', $hari1)->sum('21_00') + data_beban_puncak30::where('tanggal', $hari1)->sum('21_30') + data_beban_puncak30::where('tanggal', $hari1)->sum('22_00') + data_beban_puncak30::where('tanggal', $hari1)->sum('22_30') + data_beban_puncak30::where('tanggal', $hari1)->sum('23_00') + data_beban_puncak30::where('tanggal', $hari1)->sum('23_30') + data_beban_puncak30::where('tanggal', $hari1)->sum('23_59');



            // Data grafik 5 bulan yang lalu
            $dataBulanIni = data_beban_puncak30::whereMonth('tanggal', now()->month)->get();
            // Tanggal mulai bulan ini
            $tanggalMulaiBulanIni = Carbon::today()->startOfMonth();
            $tanggalAkhirBulanIni = Carbon::today()->endOfMonth();

            // Tanggal mulai bulan kemarin
            $tanggalMulaiBulanKemarin = Carbon::today()->subMonth()->startOfMonth();
            $tanggalAkhirBulanKemarin = Carbon::today()->subMonth()->endOfMonth();

            // Tanggal mulai bulan kemarin lusa
            $tanggalMulaiBulanKemarinLusa = Carbon::today()->subMonths(2)->startOfMonth();
            $tanggalAkhirBulanKemarinLusa = Carbon::today()->subMonths(2)->endOfMonth();

            // Tanggal mulai bulan ke4
            $tanggalMulaiBulanKe4 = Carbon::today()->subMonths(3)->startOfMonth();
            $tanggalAkhirBulanKe4 = Carbon::today()->subMonths(3)->endOfMonth();

            // Tanggal mulai bulan ke4
            $tanggalMulaiBulanKe5 = Carbon::today()->subMonths(4)->startOfMonth();
            $tanggalAkhirBulanKe5 = Carbon::today()->subMonths(4)->endOfMonth();

            // Data untuk bulan ini
            $totalBulanIni = data_beban_puncak30::whereBetween('tanggal', [$tanggalMulaiBulanIni, $tanggalAkhirBulanIni])->sum('00_30') + data_beban_puncak30::whereBetween('tanggal', [$tanggalMulaiBulanIni, $tanggalAkhirBulanIni])->sum('01_00') + data_beban_puncak30::whereBetween('tanggal', [$tanggalMulaiBulanIni, $tanggalAkhirBulanIni])->sum('01_30') + data_beban_puncak30::whereBetween('tanggal', [$tanggalMulaiBulanIni, $tanggalAkhirBulanIni])->sum('02_00') + data_beban_puncak30::whereBetween('tanggal', [$tanggalMulaiBulanIni, $tanggalAkhirBulanIni])->sum('02_30') + data_beban_puncak30::whereBetween('tanggal', [$tanggalMulaiBulanIni, $tanggalAkhirBulanIni])->sum('03_00') + data_beban_puncak30::whereBetween('tanggal', [$tanggalMulaiBulanIni, $tanggalAkhirBulanIni])->sum('03_30') + data_beban_puncak30::whereBetween('tanggal', [$tanggalMulaiBulanIni, $tanggalAkhirBulanIni])->sum('04_00') + data_beban_puncak30::whereBetween('tanggal', [$tanggalMulaiBulanIni, $tanggalAkhirBulanIni])->sum('04_30') + data_beban_puncak30::whereBetween('tanggal', [$tanggalMulaiBulanIni, $tanggalAkhirBulanIni])->sum('05_00') + data_beban_puncak30::whereBetween('tanggal', [$tanggalMulaiBulanIni, $tanggalAkhirBulanIni])->sum('05_30') + data_beban_puncak30::whereBetween('tanggal', [$tanggalMulaiBulanIni, $tanggalAkhirBulanIni])->sum('06_00') + data_beban_puncak30::whereBetween('tanggal', [$tanggalMulaiBulanIni, $tanggalAkhirBulanIni])->sum('06_30') + data_beban_puncak30::whereBetween('tanggal', [$tanggalMulaiBulanIni, $tanggalAkhirBulanIni])->sum('07_00') + data_beban_puncak30::whereBetween('tanggal', [$tanggalMulaiBulanIni, $tanggalAkhirBulanIni])->sum('07_30') + data_beban_puncak30::whereBetween('tanggal', [$tanggalMulaiBulanIni, $tanggalAkhirBulanIni])->sum('08_00') + data_beban_puncak30::whereBetween('tanggal', [$tanggalMulaiBulanIni, $tanggalAkhirBulanIni])->sum('08_30') + data_beban_puncak30::whereBetween('tanggal', [$tanggalMulaiBulanIni, $tanggalAkhirBulanIni])->sum('09_00') + data_beban_puncak30::whereBetween('tanggal', [$tanggalMulaiBulanIni, $tanggalAkhirBulanIni])->sum('09_30') + data_beban_puncak30::whereBetween('tanggal', [$tanggalMulaiBulanIni, $tanggalAkhirBulanIni])->sum('10_00') + data_beban_puncak30::whereBetween('tanggal', [$tanggalMulaiBulanIni, $tanggalAkhirBulanIni])->sum('10_30') + data_beban_puncak30::whereBetween('tanggal', [$tanggalMulaiBulanIni, $tanggalAkhirBulanIni])->sum('11_00') + data_beban_puncak30::whereBetween('tanggal', [$tanggalMulaiBulanIni, $tanggalAkhirBulanIni])->sum('11_30') + data_beban_puncak30::whereBetween('tanggal', [$tanggalMulaiBulanIni, $tanggalAkhirBulanIni])->sum('12_00') + data_beban_puncak30::whereBetween('tanggal', [$tanggalMulaiBulanIni, $tanggalAkhirBulanIni])->sum('12_30') + data_beban_puncak30::whereBetween('tanggal', [$tanggalMulaiBulanIni, $tanggalAkhirBulanIni])->sum('13_00') + data_beban_puncak30::whereBetween('tanggal', [$tanggalMulaiBulanIni, $tanggalAkhirBulanIni])->sum('13_30') + data_beban_puncak30::whereBetween('tanggal', [$tanggalMulaiBulanIni, $tanggalAkhirBulanIni])->sum('14_00') + data_beban_puncak30::whereBetween('tanggal', [$tanggalMulaiBulanIni, $tanggalAkhirBulanIni])->sum('14_30') + data_beban_puncak30::whereBetween('tanggal', [$tanggalMulaiBulanIni, $tanggalAkhirBulanIni])->sum('15_00') + data_beban_puncak30::whereBetween('tanggal', [$tanggalMulaiBulanIni, $tanggalAkhirBulanIni])->sum('15_30') + data_beban_puncak30::whereBetween('tanggal', [$tanggalMulaiBulanIni, $tanggalAkhirBulanIni])->sum('16_00') + data_beban_puncak30::whereBetween('tanggal', [$tanggalMulaiBulanIni, $tanggalAkhirBulanIni])->sum('16_30') + data_beban_puncak30::whereBetween('tanggal', [$tanggalMulaiBulanIni, $tanggalAkhirBulanIni])->sum('17_00') + data_beban_puncak30::whereBetween('tanggal', [$tanggalMulaiBulanIni, $tanggalAkhirBulanIni])->sum('17_30') + data_beban_puncak30::whereBetween('tanggal', [$tanggalMulaiBulanIni, $tanggalAkhirBulanIni])->sum('18_00') + data_beban_puncak30::whereBetween('tanggal', [$tanggalMulaiBulanIni, $tanggalAkhirBulanIni])->sum('18_30') + data_beban_puncak30::whereBetween('tanggal', [$tanggalMulaiBulanIni, $tanggalAkhirBulanIni])->sum('19_00') + data_beban_puncak30::whereBetween('tanggal', [$tanggalMulaiBulanIni, $tanggalAkhirBulanIni])->sum('19_30') + data_beban_puncak30::whereBetween('tanggal', [$tanggalMulaiBulanIni, $tanggalAkhirBulanIni])->sum('20_00') + data_beban_puncak30::whereBetween('tanggal', [$tanggalMulaiBulanIni, $tanggalAkhirBulanIni])->sum('20_30') + data_beban_puncak30::whereBetween('tanggal', [$tanggalMulaiBulanIni, $tanggalAkhirBulanIni])->sum('21_00') + data_beban_puncak30::whereBetween('tanggal', [$tanggalMulaiBulanIni, $tanggalAkhirBulanIni])->sum('21_30') + data_beban_puncak30::whereBetween('tanggal', [$tanggalMulaiBulanIni, $tanggalAkhirBulanIni])->sum('22_00') + data_beban_puncak30::whereBetween('tanggal', [$tanggalMulaiBulanIni, $tanggalAkhirBulanIni])->sum('22_30') + data_beban_puncak30::whereBetween('tanggal', [$tanggalMulaiBulanIni, $tanggalAkhirBulanIni])->sum('23_00') + data_beban_puncak30::whereBetween('tanggal', [$tanggalMulaiBulanIni, $tanggalAkhirBulanIni])->sum('23_30') + data_beban_puncak30::whereBetween('tanggal', [$tanggalMulaiBulanIni, $tanggalAkhirBulanIni])->sum('23_59');
            $totalBulanKemarin  = data_beban_puncak30::whereBetween('tanggal', [$tanggalMulaiBulanKemarin, $tanggalAkhirBulanKemarin])->sum('00_30') + data_beban_puncak30::whereBetween('tanggal', [$tanggalMulaiBulanKemarin, $tanggalAkhirBulanKemarin])->sum('01_00') + data_beban_puncak30::whereBetween('tanggal', [$tanggalMulaiBulanKemarin, $tanggalAkhirBulanKemarin])->sum('01_30') + data_beban_puncak30::whereBetween('tanggal', [$tanggalMulaiBulanKemarin, $tanggalAkhirBulanKemarin])->sum('02_00') + data_beban_puncak30::whereBetween('tanggal', [$tanggalMulaiBulanKemarin, $tanggalAkhirBulanKemarin])->sum('02_30') + data_beban_puncak30::whereBetween('tanggal', [$tanggalMulaiBulanKemarin, $tanggalAkhirBulanKemarin])->sum('03_00') + data_beban_puncak30::whereBetween('tanggal', [$tanggalMulaiBulanKemarin, $tanggalAkhirBulanKemarin])->sum('03_30') + data_beban_puncak30::whereBetween('tanggal', [$tanggalMulaiBulanKemarin, $tanggalAkhirBulanKemarin])->sum('04_00') + data_beban_puncak30::whereBetween('tanggal', [$tanggalMulaiBulanKemarin, $tanggalAkhirBulanKemarin])->sum('04_30') + data_beban_puncak30::whereBetween('tanggal', [$tanggalMulaiBulanKemarin, $tanggalAkhirBulanKemarin])->sum('05_00') + data_beban_puncak30::whereBetween('tanggal', [$tanggalMulaiBulanKemarin, $tanggalAkhirBulanKemarin])->sum('05_30') + data_beban_puncak30::whereBetween('tanggal', [$tanggalMulaiBulanKemarin, $tanggalAkhirBulanKemarin])->sum('06_00') + data_beban_puncak30::whereBetween('tanggal', [$tanggalMulaiBulanKemarin, $tanggalAkhirBulanKemarin])->sum('06_30') + data_beban_puncak30::whereBetween('tanggal', [$tanggalMulaiBulanKemarin, $tanggalAkhirBulanKemarin])->sum('07_00') + data_beban_puncak30::whereBetween('tanggal', [$tanggalMulaiBulanKemarin, $tanggalAkhirBulanKemarin])->sum('07_30') + data_beban_puncak30::whereBetween('tanggal', [$tanggalMulaiBulanKemarin, $tanggalAkhirBulanKemarin])->sum('08_00') + data_beban_puncak30::whereBetween('tanggal', [$tanggalMulaiBulanKemarin, $tanggalAkhirBulanKemarin])->sum('08_30') + data_beban_puncak30::whereBetween('tanggal', [$tanggalMulaiBulanKemarin, $tanggalAkhirBulanKemarin])->sum('09_00') + data_beban_puncak30::whereBetween('tanggal', [$tanggalMulaiBulanKemarin, $tanggalAkhirBulanKemarin])->sum('09_30') + data_beban_puncak30::whereBetween('tanggal', [$tanggalMulaiBulanKemarin, $tanggalAkhirBulanKemarin])->sum('10_00') + data_beban_puncak30::whereBetween('tanggal', [$tanggalMulaiBulanKemarin, $tanggalAkhirBulanKemarin])->sum('10_30') + data_beban_puncak30::whereBetween('tanggal', [$tanggalMulaiBulanKemarin, $tanggalAkhirBulanKemarin])->sum('11_00') + data_beban_puncak30::whereBetween('tanggal', [$tanggalMulaiBulanKemarin, $tanggalAkhirBulanKemarin])->sum('11_30') + data_beban_puncak30::whereBetween('tanggal', [$tanggalMulaiBulanKemarin, $tanggalAkhirBulanKemarin])->sum('12_00') + data_beban_puncak30::whereBetween('tanggal', [$tanggalMulaiBulanKemarin, $tanggalAkhirBulanKemarin])->sum('12_30') + data_beban_puncak30::whereBetween('tanggal', [$tanggalMulaiBulanKemarin, $tanggalAkhirBulanKemarin])->sum('13_00') + data_beban_puncak30::whereBetween('tanggal', [$tanggalMulaiBulanKemarin, $tanggalAkhirBulanKemarin])->sum('13_30') + data_beban_puncak30::whereBetween('tanggal', [$tanggalMulaiBulanKemarin, $tanggalAkhirBulanKemarin])->sum('14_00') + data_beban_puncak30::whereBetween('tanggal', [$tanggalMulaiBulanKemarin, $tanggalAkhirBulanKemarin])->sum('14_30') + data_beban_puncak30::whereBetween('tanggal', [$tanggalMulaiBulanKemarin, $tanggalAkhirBulanKemarin])->sum('15_00') + data_beban_puncak30::whereBetween('tanggal', [$tanggalMulaiBulanKemarin, $tanggalAkhirBulanKemarin])->sum('15_30') + data_beban_puncak30::whereBetween('tanggal', [$tanggalMulaiBulanKemarin, $tanggalAkhirBulanKemarin])->sum('16_00') + data_beban_puncak30::whereBetween('tanggal', [$tanggalMulaiBulanKemarin, $tanggalAkhirBulanKemarin])->sum('16_30') + data_beban_puncak30::whereBetween('tanggal', [$tanggalMulaiBulanKemarin, $tanggalAkhirBulanKemarin])->sum('17_00') + data_beban_puncak30::whereBetween('tanggal', [$tanggalMulaiBulanKemarin, $tanggalAkhirBulanKemarin])->sum('17_30') + data_beban_puncak30::whereBetween('tanggal', [$tanggalMulaiBulanKemarin, $tanggalAkhirBulanKemarin])->sum('18_00') + data_beban_puncak30::whereBetween('tanggal', [$tanggalMulaiBulanKemarin, $tanggalAkhirBulanKemarin])->sum('18_30') + data_beban_puncak30::whereBetween('tanggal', [$tanggalMulaiBulanKemarin, $tanggalAkhirBulanKemarin])->sum('19_00') + data_beban_puncak30::whereBetween('tanggal', [$tanggalMulaiBulanKemarin, $tanggalAkhirBulanKemarin])->sum('19_30') + data_beban_puncak30::whereBetween('tanggal', [$tanggalMulaiBulanKemarin, $tanggalAkhirBulanKemarin])->sum('20_00') + data_beban_puncak30::whereBetween('tanggal', [$tanggalMulaiBulanKemarin, $tanggalAkhirBulanKemarin])->sum('20_30') + data_beban_puncak30::whereBetween('tanggal', [$tanggalMulaiBulanKemarin, $tanggalAkhirBulanKemarin])->sum('21_00') + data_beban_puncak30::whereBetween('tanggal', [$tanggalMulaiBulanKemarin, $tanggalAkhirBulanKemarin])->sum('21_30') + data_beban_puncak30::whereBetween('tanggal', [$tanggalMulaiBulanKemarin, $tanggalAkhirBulanKemarin])->sum('22_00') + data_beban_puncak30::whereBetween('tanggal', [$tanggalMulaiBulanKemarin, $tanggalAkhirBulanKemarin])->sum('22_30') + data_beban_puncak30::whereBetween('tanggal', [$tanggalMulaiBulanKemarin, $tanggalAkhirBulanKemarin])->sum('23_00') + data_beban_puncak30::whereBetween('tanggal', [$tanggalMulaiBulanKemarin, $tanggalAkhirBulanKemarin])->sum('23_30') + data_beban_puncak30::whereBetween('tanggal', [$tanggalMulaiBulanKemarin, $tanggalAkhirBulanKemarin])->sum('23_59');
            $totalBulanKemarinLusa  = data_beban_puncak30::whereBetween('tanggal', [$tanggalMulaiBulanKemarinLusa, $tanggalAkhirBulanKemarinLusa])->sum('00_30') + data_beban_puncak30::whereBetween('tanggal', [$tanggalMulaiBulanKemarinLusa, $tanggalAkhirBulanKemarinLusa])->sum('01_00') + data_beban_puncak30::whereBetween('tanggal', [$tanggalMulaiBulanKemarinLusa, $tanggalAkhirBulanKemarinLusa])->sum('01_30') + data_beban_puncak30::whereBetween('tanggal', [$tanggalMulaiBulanKemarinLusa, $tanggalAkhirBulanKemarinLusa])->sum('02_00') + data_beban_puncak30::whereBetween('tanggal', [$tanggalMulaiBulanKemarinLusa, $tanggalAkhirBulanKemarinLusa])->sum('02_30') + data_beban_puncak30::whereBetween('tanggal', [$tanggalMulaiBulanKemarinLusa, $tanggalAkhirBulanKemarinLusa])->sum('03_00') + data_beban_puncak30::whereBetween('tanggal', [$tanggalMulaiBulanKemarinLusa, $tanggalAkhirBulanKemarinLusa])->sum('03_30') + data_beban_puncak30::whereBetween('tanggal', [$tanggalMulaiBulanKemarinLusa, $tanggalAkhirBulanKemarinLusa])->sum('04_00') + data_beban_puncak30::whereBetween('tanggal', [$tanggalMulaiBulanKemarinLusa, $tanggalAkhirBulanKemarinLusa])->sum('04_30') + data_beban_puncak30::whereBetween('tanggal', [$tanggalMulaiBulanKemarinLusa, $tanggalAkhirBulanKemarinLusa])->sum('05_00') + data_beban_puncak30::whereBetween('tanggal', [$tanggalMulaiBulanKemarinLusa, $tanggalAkhirBulanKemarinLusa])->sum('05_30') + data_beban_puncak30::whereBetween('tanggal', [$tanggalMulaiBulanKemarinLusa, $tanggalAkhirBulanKemarinLusa])->sum('06_00') + data_beban_puncak30::whereBetween('tanggal', [$tanggalMulaiBulanKemarinLusa, $tanggalAkhirBulanKemarinLusa])->sum('06_30') + data_beban_puncak30::whereBetween('tanggal', [$tanggalMulaiBulanKemarinLusa, $tanggalAkhirBulanKemarinLusa])->sum('07_00') + data_beban_puncak30::whereBetween('tanggal', [$tanggalMulaiBulanKemarinLusa, $tanggalAkhirBulanKemarinLusa])->sum('07_30') + data_beban_puncak30::whereBetween('tanggal', [$tanggalMulaiBulanKemarinLusa, $tanggalAkhirBulanKemarinLusa])->sum('08_00') + data_beban_puncak30::whereBetween('tanggal', [$tanggalMulaiBulanKemarinLusa, $tanggalAkhirBulanKemarinLusa])->sum('08_30') + data_beban_puncak30::whereBetween('tanggal', [$tanggalMulaiBulanKemarinLusa, $tanggalAkhirBulanKemarinLusa])->sum('09_00') + data_beban_puncak30::whereBetween('tanggal', [$tanggalMulaiBulanKemarinLusa, $tanggalAkhirBulanKemarinLusa])->sum('09_30') + data_beban_puncak30::whereBetween('tanggal', [$tanggalMulaiBulanKemarinLusa, $tanggalAkhirBulanKemarinLusa])->sum('10_00') + data_beban_puncak30::whereBetween('tanggal', [$tanggalMulaiBulanKemarinLusa, $tanggalAkhirBulanKemarinLusa])->sum('10_30') + data_beban_puncak30::whereBetween('tanggal', [$tanggalMulaiBulanKemarinLusa, $tanggalAkhirBulanKemarinLusa])->sum('11_00') + data_beban_puncak30::whereBetween('tanggal', [$tanggalMulaiBulanKemarinLusa, $tanggalAkhirBulanKemarinLusa])->sum('11_30') + data_beban_puncak30::whereBetween('tanggal', [$tanggalMulaiBulanKemarinLusa, $tanggalAkhirBulanKemarinLusa])->sum('12_00') + data_beban_puncak30::whereBetween('tanggal', [$tanggalMulaiBulanKemarinLusa, $tanggalAkhirBulanKemarinLusa])->sum('12_30') + data_beban_puncak30::whereBetween('tanggal', [$tanggalMulaiBulanKemarinLusa, $tanggalAkhirBulanKemarinLusa])->sum('13_00') + data_beban_puncak30::whereBetween('tanggal', [$tanggalMulaiBulanKemarinLusa, $tanggalAkhirBulanKemarinLusa])->sum('13_30') + data_beban_puncak30::whereBetween('tanggal', [$tanggalMulaiBulanKemarinLusa, $tanggalAkhirBulanKemarinLusa])->sum('14_00') + data_beban_puncak30::whereBetween('tanggal', [$tanggalMulaiBulanKemarinLusa, $tanggalAkhirBulanKemarinLusa])->sum('14_30') + data_beban_puncak30::whereBetween('tanggal', [$tanggalMulaiBulanKemarinLusa, $tanggalAkhirBulanKemarinLusa])->sum('15_00') + data_beban_puncak30::whereBetween('tanggal', [$tanggalMulaiBulanKemarinLusa, $tanggalAkhirBulanKemarinLusa])->sum('15_30') + data_beban_puncak30::whereBetween('tanggal', [$tanggalMulaiBulanKemarinLusa, $tanggalAkhirBulanKemarinLusa])->sum('16_00') + data_beban_puncak30::whereBetween('tanggal', [$tanggalMulaiBulanKemarinLusa, $tanggalAkhirBulanKemarinLusa])->sum('16_30') + data_beban_puncak30::whereBetween('tanggal', [$tanggalMulaiBulanKemarinLusa, $tanggalAkhirBulanKemarinLusa])->sum('17_00') + data_beban_puncak30::whereBetween('tanggal', [$tanggalMulaiBulanKemarinLusa, $tanggalAkhirBulanKemarinLusa])->sum('17_30') + data_beban_puncak30::whereBetween('tanggal', [$tanggalMulaiBulanKemarinLusa, $tanggalAkhirBulanKemarinLusa])->sum('18_00') + data_beban_puncak30::whereBetween('tanggal', [$tanggalMulaiBulanKemarinLusa, $tanggalAkhirBulanKemarinLusa])->sum('18_30') + data_beban_puncak30::whereBetween('tanggal', [$tanggalMulaiBulanKemarinLusa, $tanggalAkhirBulanKemarinLusa])->sum('19_00') + data_beban_puncak30::whereBetween('tanggal', [$tanggalMulaiBulanKemarinLusa, $tanggalAkhirBulanKemarinLusa])->sum('19_30') + data_beban_puncak30::whereBetween('tanggal', [$tanggalMulaiBulanKemarinLusa, $tanggalAkhirBulanKemarinLusa])->sum('20_00') + data_beban_puncak30::whereBetween('tanggal', [$tanggalMulaiBulanKemarinLusa, $tanggalAkhirBulanKemarinLusa])->sum('20_30') + data_beban_puncak30::whereBetween('tanggal', [$tanggalMulaiBulanKemarinLusa, $tanggalAkhirBulanKemarinLusa])->sum('21_00') + data_beban_puncak30::whereBetween('tanggal', [$tanggalMulaiBulanKemarinLusa, $tanggalAkhirBulanKemarinLusa])->sum('21_30') + data_beban_puncak30::whereBetween('tanggal', [$tanggalMulaiBulanKemarinLusa, $tanggalAkhirBulanKemarinLusa])->sum('22_00') + data_beban_puncak30::whereBetween('tanggal', [$tanggalMulaiBulanKemarinLusa, $tanggalAkhirBulanKemarinLusa])->sum('22_30') + data_beban_puncak30::whereBetween('tanggal', [$tanggalMulaiBulanKemarinLusa, $tanggalAkhirBulanKemarinLusa])->sum('23_00') + data_beban_puncak30::whereBetween('tanggal', [$tanggalMulaiBulanKemarinLusa, $tanggalAkhirBulanKemarinLusa])->sum('23_30') + data_beban_puncak30::whereBetween('tanggal', [$tanggalMulaiBulanKemarinLusa, $tanggalAkhirBulanKemarinLusa])->sum('23_59');
            $totalBulanempat = data_beban_puncak30::whereBetween('tanggal', [$tanggalMulaiBulanKe4, $tanggalAkhirBulanKe4])->sum('00_30') + data_beban_puncak30::whereBetween('tanggal', [$tanggalMulaiBulanKe4, $tanggalAkhirBulanKe4])->sum('01_00') + data_beban_puncak30::whereBetween('tanggal', [$tanggalMulaiBulanKe4, $tanggalAkhirBulanKe4])->sum('01_30') + data_beban_puncak30::whereBetween('tanggal', [$tanggalMulaiBulanKe4, $tanggalAkhirBulanKe4])->sum('02_00') + data_beban_puncak30::whereBetween('tanggal', [$tanggalMulaiBulanKe4, $tanggalAkhirBulanKe4])->sum('02_30') + data_beban_puncak30::whereBetween('tanggal', [$tanggalMulaiBulanKe4, $tanggalAkhirBulanKe4])->sum('03_00') + data_beban_puncak30::whereBetween('tanggal', [$tanggalMulaiBulanKe4, $tanggalAkhirBulanKe4])->sum('03_30') + data_beban_puncak30::whereBetween('tanggal', [$tanggalMulaiBulanKe4, $tanggalAkhirBulanKe4])->sum('04_00') + data_beban_puncak30::whereBetween('tanggal', [$tanggalMulaiBulanKe4, $tanggalAkhirBulanKe4])->sum('04_30') + data_beban_puncak30::whereBetween('tanggal', [$tanggalMulaiBulanKe4, $tanggalAkhirBulanKe4])->sum('05_00') + data_beban_puncak30::whereBetween('tanggal', [$tanggalMulaiBulanKe4, $tanggalAkhirBulanKe4])->sum('05_30') + data_beban_puncak30::whereBetween('tanggal', [$tanggalMulaiBulanKe4, $tanggalAkhirBulanKe4])->sum('06_00') + data_beban_puncak30::whereBetween('tanggal', [$tanggalMulaiBulanKe4, $tanggalAkhirBulanKe4])->sum('06_30') + data_beban_puncak30::whereBetween('tanggal', [$tanggalMulaiBulanKe4, $tanggalAkhirBulanKe4])->sum('07_00') + data_beban_puncak30::whereBetween('tanggal', [$tanggalMulaiBulanKe4, $tanggalAkhirBulanKe4])->sum('07_30') + data_beban_puncak30::whereBetween('tanggal', [$tanggalMulaiBulanKe4, $tanggalAkhirBulanKe4])->sum('08_00') + data_beban_puncak30::whereBetween('tanggal', [$tanggalMulaiBulanKe4, $tanggalAkhirBulanKe4])->sum('08_30') + data_beban_puncak30::whereBetween('tanggal', [$tanggalMulaiBulanKe4, $tanggalAkhirBulanKe4])->sum('09_00') + data_beban_puncak30::whereBetween('tanggal', [$tanggalMulaiBulanKe4, $tanggalAkhirBulanKe4])->sum('09_30') + data_beban_puncak30::whereBetween('tanggal', [$tanggalMulaiBulanKe4, $tanggalAkhirBulanKe4])->sum('10_00') + data_beban_puncak30::whereBetween('tanggal', [$tanggalMulaiBulanKe4, $tanggalAkhirBulanKe4])->sum('10_30') + data_beban_puncak30::whereBetween('tanggal', [$tanggalMulaiBulanKe4, $tanggalAkhirBulanKe4])->sum('11_00') + data_beban_puncak30::whereBetween('tanggal', [$tanggalMulaiBulanKe4, $tanggalAkhirBulanKe4])->sum('11_30') + data_beban_puncak30::whereBetween('tanggal', [$tanggalMulaiBulanKe4, $tanggalAkhirBulanKe4])->sum('12_00') + data_beban_puncak30::whereBetween('tanggal', [$tanggalMulaiBulanKe4, $tanggalAkhirBulanKe4])->sum('12_30') + data_beban_puncak30::whereBetween('tanggal', [$tanggalMulaiBulanKe4, $tanggalAkhirBulanKe4])->sum('13_00') + data_beban_puncak30::whereBetween('tanggal', [$tanggalMulaiBulanKe4, $tanggalAkhirBulanKe4])->sum('13_30') + data_beban_puncak30::whereBetween('tanggal', [$tanggalMulaiBulanKe4, $tanggalAkhirBulanKe4])->sum('14_00') + data_beban_puncak30::whereBetween('tanggal', [$tanggalMulaiBulanKe4, $tanggalAkhirBulanKe4])->sum('14_30') + data_beban_puncak30::whereBetween('tanggal', [$tanggalMulaiBulanKe4, $tanggalAkhirBulanKe4])->sum('15_00') + data_beban_puncak30::whereBetween('tanggal', [$tanggalMulaiBulanKe4, $tanggalAkhirBulanKe4])->sum('15_30') + data_beban_puncak30::whereBetween('tanggal', [$tanggalMulaiBulanKe4, $tanggalAkhirBulanKe4])->sum('16_00') + data_beban_puncak30::whereBetween('tanggal', [$tanggalMulaiBulanKe4, $tanggalAkhirBulanKe4])->sum('16_30') + data_beban_puncak30::whereBetween('tanggal', [$tanggalMulaiBulanKe4, $tanggalAkhirBulanKe4])->sum('17_00') + data_beban_puncak30::whereBetween('tanggal', [$tanggalMulaiBulanKe4, $tanggalAkhirBulanKe4])->sum('17_30') + data_beban_puncak30::whereBetween('tanggal', [$tanggalMulaiBulanKe4, $tanggalAkhirBulanKe4])->sum('18_00') + data_beban_puncak30::whereBetween('tanggal', [$tanggalMulaiBulanKe4, $tanggalAkhirBulanKe4])->sum('18_30') + data_beban_puncak30::whereBetween('tanggal', [$tanggalMulaiBulanKe4, $tanggalAkhirBulanKe4])->sum('19_00') + data_beban_puncak30::whereBetween('tanggal', [$tanggalMulaiBulanKe4, $tanggalAkhirBulanKe4])->sum('19_30') + data_beban_puncak30::whereBetween('tanggal', [$tanggalMulaiBulanKe4, $tanggalAkhirBulanKe4])->sum('20_00') + data_beban_puncak30::whereBetween('tanggal', [$tanggalMulaiBulanKe4, $tanggalAkhirBulanKe4])->sum('20_30') + data_beban_puncak30::whereBetween('tanggal', [$tanggalMulaiBulanKe4, $tanggalAkhirBulanKe4])->sum('21_00') + data_beban_puncak30::whereBetween('tanggal', [$tanggalMulaiBulanKe4, $tanggalAkhirBulanKe4])->sum('21_30') + data_beban_puncak30::whereBetween('tanggal', [$tanggalMulaiBulanKe4, $tanggalAkhirBulanKe4])->sum('22_00') + data_beban_puncak30::whereBetween('tanggal', [$tanggalMulaiBulanKe4, $tanggalAkhirBulanKe4])->sum('22_30') + data_beban_puncak30::whereBetween('tanggal', [$tanggalMulaiBulanKe4, $tanggalAkhirBulanKe4])->sum('23_00') + data_beban_puncak30::whereBetween('tanggal', [$tanggalMulaiBulanKe4, $tanggalAkhirBulanKe4])->sum('23_30') + data_beban_puncak30::whereBetween('tanggal', [$tanggalMulaiBulanKe4, $tanggalAkhirBulanKe4])->sum('23_59');
            $totalBulanlima = data_beban_puncak30::whereBetween('tanggal', [$tanggalMulaiBulanKe5, $tanggalAkhirBulanKe5])->sum('00_30') + data_beban_puncak30::whereBetween('tanggal', [$tanggalMulaiBulanKe5, $tanggalAkhirBulanKe5])->sum('01_00') + data_beban_puncak30::whereBetween('tanggal', [$tanggalMulaiBulanKe5, $tanggalAkhirBulanKe5])->sum('01_30') + data_beban_puncak30::whereBetween('tanggal', [$tanggalMulaiBulanKe5, $tanggalAkhirBulanKe5])->sum('02_00') + data_beban_puncak30::whereBetween('tanggal', [$tanggalMulaiBulanKe5, $tanggalAkhirBulanKe5])->sum('02_30') + data_beban_puncak30::whereBetween('tanggal', [$tanggalMulaiBulanKe5, $tanggalAkhirBulanKe5])->sum('03_00') + data_beban_puncak30::whereBetween('tanggal', [$tanggalMulaiBulanKe5, $tanggalAkhirBulanKe5])->sum('03_30') + data_beban_puncak30::whereBetween('tanggal', [$tanggalMulaiBulanKe5, $tanggalAkhirBulanKe5])->sum('04_00') + data_beban_puncak30::whereBetween('tanggal', [$tanggalMulaiBulanKe5, $tanggalAkhirBulanKe5])->sum('04_30') + data_beban_puncak30::whereBetween('tanggal', [$tanggalMulaiBulanKe5, $tanggalAkhirBulanKe5])->sum('05_00') + data_beban_puncak30::whereBetween('tanggal', [$tanggalMulaiBulanKe5, $tanggalAkhirBulanKe5])->sum('05_30') + data_beban_puncak30::whereBetween('tanggal', [$tanggalMulaiBulanKe5, $tanggalAkhirBulanKe5])->sum('06_00') + data_beban_puncak30::whereBetween('tanggal', [$tanggalMulaiBulanKe5, $tanggalAkhirBulanKe5])->sum('06_30') + data_beban_puncak30::whereBetween('tanggal', [$tanggalMulaiBulanKe5, $tanggalAkhirBulanKe5])->sum('07_00') + data_beban_puncak30::whereBetween('tanggal', [$tanggalMulaiBulanKe5, $tanggalAkhirBulanKe5])->sum('07_30') + data_beban_puncak30::whereBetween('tanggal', [$tanggalMulaiBulanKe5, $tanggalAkhirBulanKe5])->sum('08_00') + data_beban_puncak30::whereBetween('tanggal', [$tanggalMulaiBulanKe5, $tanggalAkhirBulanKe5])->sum('08_30') + data_beban_puncak30::whereBetween('tanggal', [$tanggalMulaiBulanKe5, $tanggalAkhirBulanKe5])->sum('09_00') + data_beban_puncak30::whereBetween('tanggal', [$tanggalMulaiBulanKe5, $tanggalAkhirBulanKe5])->sum('09_30') + data_beban_puncak30::whereBetween('tanggal', [$tanggalMulaiBulanKe5, $tanggalAkhirBulanKe5])->sum('10_00') + data_beban_puncak30::whereBetween('tanggal', [$tanggalMulaiBulanKe5, $tanggalAkhirBulanKe5])->sum('10_30') + data_beban_puncak30::whereBetween('tanggal', [$tanggalMulaiBulanKe5, $tanggalAkhirBulanKe5])->sum('11_00') + data_beban_puncak30::whereBetween('tanggal', [$tanggalMulaiBulanKe5, $tanggalAkhirBulanKe5])->sum('11_30') + data_beban_puncak30::whereBetween('tanggal', [$tanggalMulaiBulanKe5, $tanggalAkhirBulanKe5])->sum('12_00') + data_beban_puncak30::whereBetween('tanggal', [$tanggalMulaiBulanKe5, $tanggalAkhirBulanKe5])->sum('12_30') + data_beban_puncak30::whereBetween('tanggal', [$tanggalMulaiBulanKe5, $tanggalAkhirBulanKe5])->sum('13_00') + data_beban_puncak30::whereBetween('tanggal', [$tanggalMulaiBulanKe5, $tanggalAkhirBulanKe5])->sum('13_30') + data_beban_puncak30::whereBetween('tanggal', [$tanggalMulaiBulanKe5, $tanggalAkhirBulanKe5])->sum('14_00') + data_beban_puncak30::whereBetween('tanggal', [$tanggalMulaiBulanKe5, $tanggalAkhirBulanKe5])->sum('14_30') + data_beban_puncak30::whereBetween('tanggal', [$tanggalMulaiBulanKe5, $tanggalAkhirBulanKe5])->sum('15_00') + data_beban_puncak30::whereBetween('tanggal', [$tanggalMulaiBulanKe5, $tanggalAkhirBulanKe5])->sum('15_30') + data_beban_puncak30::whereBetween('tanggal', [$tanggalMulaiBulanKe5, $tanggalAkhirBulanKe5])->sum('16_00') + data_beban_puncak30::whereBetween('tanggal', [$tanggalMulaiBulanKe5, $tanggalAkhirBulanKe5])->sum('16_30') + data_beban_puncak30::whereBetween('tanggal', [$tanggalMulaiBulanKe5, $tanggalAkhirBulanKe5])->sum('17_00') + data_beban_puncak30::whereBetween('tanggal', [$tanggalMulaiBulanKe5, $tanggalAkhirBulanKe5])->sum('17_30') + data_beban_puncak30::whereBetween('tanggal', [$tanggalMulaiBulanKe5, $tanggalAkhirBulanKe5])->sum('18_00') + data_beban_puncak30::whereBetween('tanggal', [$tanggalMulaiBulanKe5, $tanggalAkhirBulanKe5])->sum('18_30') + data_beban_puncak30::whereBetween('tanggal', [$tanggalMulaiBulanKe5, $tanggalAkhirBulanKe5])->sum('19_00') + data_beban_puncak30::whereBetween('tanggal', [$tanggalMulaiBulanKe5, $tanggalAkhirBulanKe5])->sum('19_30') + data_beban_puncak30::whereBetween('tanggal', [$tanggalMulaiBulanKe5, $tanggalAkhirBulanKe5])->sum('20_00') + data_beban_puncak30::whereBetween('tanggal', [$tanggalMulaiBulanKe5, $tanggalAkhirBulanKe5])->sum('20_30') + data_beban_puncak30::whereBetween('tanggal', [$tanggalMulaiBulanKe5, $tanggalAkhirBulanKe5])->sum('21_00') + data_beban_puncak30::whereBetween('tanggal', [$tanggalMulaiBulanKe5, $tanggalAkhirBulanKe5])->sum('21_30') + data_beban_puncak30::whereBetween('tanggal', [$tanggalMulaiBulanKe5, $tanggalAkhirBulanKe5])->sum('22_00') + data_beban_puncak30::whereBetween('tanggal', [$tanggalMulaiBulanKe5, $tanggalAkhirBulanKe5])->sum('22_30') + data_beban_puncak30::whereBetween('tanggal', [$tanggalMulaiBulanKe5, $tanggalAkhirBulanKe5])->sum('23_00') + data_beban_puncak30::whereBetween('tanggal', [$tanggalMulaiBulanKe5, $tanggalAkhirBulanKe5])->sum('23_30') + data_beban_puncak30::whereBetween('tanggal', [$tanggalMulaiBulanKe5, $tanggalAkhirBulanKe5])->sum('23_59');

            // dd($totalBulanempat);

            $getDataBebanPuncak = data_beban_puncak30::where('tanggal', '2024-01-25')->limit(5)->get();

            // dd($getDataBebanPuncak);

            foreach ($getDataBebanPuncak as $data => $d) {

                $dataJam = [
                    '00_30', '01_00', '01_30', '02_00', '02_30', '03_00', '03_30', '04_00', '04_30', '05_00', '05_30', '06_00', '06_30', '07_00', '07_30', '08_00', '08_30', '09_00', '09_30', '10_00', '10_30', '11_00', '11_30', '12_00', '12_30', '13_00', '13_30', '14_00', '14_30', '15_00', '15_30', '16_00', '16_30', '17_00', '17_30', '18_00', '18_30', '19_00', '19_30', '20_00', '20_30', '21_00', '21_30', '22_00', '22_30', '23_00', '23_30', '23_59',
                ];

                // dd($dataJam);

                foreach ($dataJam as $i => $value) {

                    // dd($value);

                    $single = data_beban_puncak30::where('gardu_induk',$d->gardu_induk)->first();

                    // dd($single);

                    $totalHari = $single->sum($value);
                    
                    // dd($totalHari);
                }

                $data2[]= [

                    'gardu_induk' => $d->gardu_induk,
                    'incoming' => $d->incoming,
                    'TotalHari' => $totalHari,
                    'TotalKemarin' => 0, 
                    'TotalLusaKemarin' => 0,
                ];
                // dd($totalHari);

            }
            // dd($data2);


            $data3hari = data_beban_puncak30::whereIn('tanggal', [$tanggalHariIni, $tanggalKemarin, $tanggalKemarinLusa])->get();
            // Menambahkan total untuk setiap mw
            foreach ($data3hari as $item) {
                $item->total = $item->{"00_30"} + $item->{"01_00"} + $item->{"01_30"} + $item->{"02_00"} + $item->{"02_30"} + $item->{"03_00"} + $item->{"03_30"} + $item->{"04_00"} + $item->{"04_30"} + $item->{"05_00"} + $item->{"05_30"} + $item->{"06_00"} + $item->{"06_30"} + $item->{"07_00"} + $item->{"07_30"} + $item->{"08_00"} + $item->{"08_30"} + $item->{"09_00"} + $item->{"09_30"} + $item->{"10_00"} + $item->{"10_30"} + $item->{"11_00"} + $item->{"11_30"} + $item->{"12_00"} + $item->{"12_30"} + $item->{"13_00"} + $item->{"13_30"} + $item->{"14_00"} + $item->{"14_30"} + $item->{"15_00"} + $item->{"15_30"} + $item->{"16_00"} + $item->{"16_00"} + $item->{"16_30"} + $item->{"17_00"} + $item->{"17_30"} + $item->{"18_00"} + $item->{"18_30"} + $item->{"19_00"} + $item->{"19_30"} + $item->{"20_00"} + $item->{"20_30"} + $item->{"21_00"} + $item->{"21_30"} + $item->{"22_00"} + $item->{"22_30"} + $item->{"23_00"} + $item->{"23_30"} + $item->{"23_59"};
            }

            // Ambil data dengan total dan kenaikan
            $data = $this->getData();

            //grafik tahunan
           
            
            
            return view('monitoring.beban', compact('data2','totalBulanlima','totalBulanempat','totalBulanKemarinLusa','totalBulanKemarin','totalBulanIni','data','dataharike5','dataharike4','dataharike3','dataharike2','dataharike1','data3hari','selectedDate', 'maxValueToday', 'maxColumnToday', 'maxValueMonth', 'maxColumnMonth', 'maxDateMonth', 'maxValueYear', 'maxColumnYear', 'maxDateYear'));
        }
    }

    public function getData()
    {
        // Ambil tanggal hari ini, kemarin, dan kemarin lusa
        $today = now()->toDateString();
        $yesterday = now()->subDays(1)->toDateString();
        $dayBeforeYesterday = now()->subDays(2)->toDateString();

        // Ambil data dari model berdasarkan tanggal
        $data = data_beban_puncak30::whereIn('tanggal', [$today, $yesterday, $dayBeforeYesterday])
            ->select('gardu_induk', 'incoming', '00_30', '01_00', '01_30', '02_00', '02_30', '03_00', '03_30', '04_00', '04_30', '05_00', '05_30', '06_00', '06_30', '07_00', '07_30', '08_00', '08_30', '09_00', '09_30', '10_00', '10_30', '11_00', '11_30', '12_00', '12_30', '13_00', '13_30', '14_00', '14_30', '15_00', '15_30', '16_00', '16_30', '17_00', '17_30', '18_00', '18_30', '19_00', '19_30', '20_00', '20_30', '21_00', '21_30', '22_00', '22_30', '23_00', '23_30', '23_59')
            ->get();

        // Transformasi data
        $data->transform(function ($item) {
            // Hitung total untuk hari ini
            $total_today = $item->{'00_30'} + $item->{'01_00'} + $item->{'01_30'} + $item->{'02_00'} + $item->{'02_30'} + $item->{'03_00'} + $item->{'03_30'} + $item->{'04_00'} + $item->{'04_30'} + $item->{'05_00'} + $item->{'05_30'} + $item->{'06_00'} + $item->{'06_30'} + $item->{'07_00'} + $item->{'07_30'} + $item->{'08_00'} + $item->{'08_30'} + $item->{'09_00'} + $item->{'09_30'} + $item->{'10_00'} + $item->{'10_30'} + $item->{'11_00'} + $item->{'11_30'} + $item->{'12_00'} + $item->{'12_30'} + $item->{'13_00'} + $item->{'13_30'} + $item->{'14_00'} + $item->{'14_30'} + $item->{'15_00'} + $item->{'15_30'} + $item->{'16_00'} + $item->{'16_30'} + $item->{'17_00'} + $item->{'17_30'} + $item->{'18_00'} + $item->{'18_30'} + $item->{'19_00'} + $item->{'19_30'} + $item->{'20_00'} + $item->{'20_30'} + $item->{'21_00'} + $item->{'21_30'} + $item->{'22_00'} + $item->{'22_30'} + $item->{'23_00'} + $item->{'23_30'} + $item->{'23_59'};
            // Hitung total untuk kemarin
            $total_yesterday = data_beban_puncak30::where('tanggal', now()->subDays(1)->toDateString())->sum('00_30', '01_00', '01_30', '02_00', '02_30', '03_00', '03_30', '04_00', '04_30', '05_00', '05_30', '06_00', '06_30', '07_00', '07_30', '08_00', '08_30', '09_00', '09_30', '10_00', '10_30', '11_00', '11_30', '12_00', '12_30', '13_00', '13_30', '14_00', '14_30', '15_00', '15_30', '16_00', '16_30', '17_00', '17_30', '18_00', '18_30', '19_00', '19_30', '20_00', '20_30', '21_00', '21_30', '22_00', '22_30', '23_00', '23_30', '23_59');
            // Hitung total untuk kemarin lusa
            $total_day_before_yesterday = data_beban_puncak30::where('tanggal', now()->subDays(2)->toDateString())->sum('00_30', '01_00', '01_30', '02_00', '02_30', '03_00', '03_30', '04_00', '04_30', '05_00', '05_30', '06_00', '06_30', '07_00', '07_30', '08_00', '08_30', '09_00', '09_30', '10_00', '10_30', '11_00', '11_30', '12_00', '12_30', '13_00', '13_30', '14_00', '14_30', '15_00', '15_30', '16_00', '16_30', '17_00', '17_30', '18_00', '18_30', '19_00', '19_30', '20_00', '20_30', '21_00', '21_30', '22_00', '22_30', '23_00', '23_30', '23_59');

            // Hitung kenaikan
            $increase = $total_today - $total_yesterday;
            $comparison = $total_yesterday - $total_day_before_yesterday;

            $item->total_today = $total_today;
            $item->total_yesterday = $total_yesterday;
            $item->total_day_before_yesterday = $total_day_before_yesterday;
            $item->increase = $increase;
            $item->comparison = $comparison;

            return $item;
        });

        return $data;
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

    //     return view('monitoring.hari', compact('data', 'selectedDate', 'dataHariIni', 'dataBulanIni', 'dataTahunIni'));
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

    //     return view('monitoring.minggu', compact('data', 'selectedDate', 'dataHariIni', 'dataBulanIni', 'dataTahunIni'));
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


    //     return view('monitoring.bulan', compact('data', 'selectedDate', 'dataHariIni', 'dataBulanIni', 'dataTahunIni'));

    // }
    public function detail(Request $request)
    {
        if (Auth::user()->hasRole(['Administrator','operator','ValidatorOpsis','ValidatorFasop','EditorOpsis','Visitor'])) {

            // Validasi input tanggal (opsional)
            $request->validate([
                'start_date' => 'date',
                'end_date' => 'date|after_or_equal:start_date',
            ]);

            // Mengambil input tanggal (jika ada)
            $startDate = $request->input('start_date', Carbon::today()->toDateString());
            $endDate = $request->input('end_date', Carbon::today()->toDateString());

            // Mengkonversi tanggal ke format yang sesuai dengan kolom
            $startDay = (int)date('d', strtotime($startDate));
            $endDay = (int)date('d', strtotime($endDate));
            $startMonth = date('F', strtotime($startDate));
            $endMonth = date('F', strtotime($endDate));

            // Membuat array kolom yang perlu diambil
            $columns = ['id', 'feeder_pkey', 'gardu_induk', 'incoming', 'name', 'bulan'];
            $dayColumns = [];
            for ($day = $startDay; $day <= $endDay; $day++) {
                $dayString = str_pad($day, 2, '0', STR_PAD_LEFT);
                $columns[] = $dayString . '_S';
                $columns[] = $dayString . '_M';
                $dayColumns[] = $dayString;
            }

            // Query untuk mendapatkan data berdasarkan rentang tanggal dan bulan
            $results = DB::table('data_beban_puncak')
                ->select($columns)
                ->whereIn('bulan', [$startMonth, $endMonth])
                ->get();

            // Mengolah hasil untuk menampilkan nilai yang lebih besar antara _S dan _M
            $processedResults = $results->map(function ($item) use ($dayColumns) {
                $result = [
                    'id' => $item->id,
                    'feeder_pkey' => $item->feeder_pkey,
                    'gardu_induk' => $item->gardu_induk,
                    'incoming' => $item->incoming,
                    'name' => $item->name,
                    'bulan' => $item->bulan,
                ];
                foreach ($dayColumns as $day) {
                    $sColumn = $day . '_S';
                    $mColumn = $day . '_M';
                    $result[$day] = max($item->$sColumn, $item->$mColumn);
                }
                return (object)$result;
            });

            // Bulanan
            // Mengambil input bulan (jika ada)
            $StartBulan1 = $request->input('StartBulan', Carbon::today()->toDateString());

            $startMonths = date('F', strtotime($StartBulan1));

            // Membuat array kolom yang perlu diambil
            $columnsmonth = ['id', 'feeder_pkey', 'gardu_induk', 'incoming', 'name', 'bulan'];
            for ($day = 1; $day <= 31; $day++) {
                $dayString = str_pad($day, 2, '0', STR_PAD_LEFT);
                $columnsmonth[] = $dayString . '_S';
                $columnsmonth[] = $dayString . '_M';
            }

            // Query untuk mendapatkan data berdasarkan bulan yang dipilih
            $resultsMonth = DB::table('data_beban_puncak')
                ->select($columnsmonth)
                ->where('bulan', $startMonths)
                ->get();

            // Debugging: Lihat hasil query
            //dd($startDate,$startMonth,$StartBulan1,$startMonths);
            // Mengolah hasil untuk menampilkan nilai yang lebih besar antara _S dan _M
            $processedresultsMonth = $resultsMonth->map(function ($item) {
                $result = [
                    'id' => $item->id,
                    'feeder_pkey' => $item->feeder_pkey,
                    'gardu_induk' => $item->gardu_induk,
                    'incoming' => $item->incoming,
                    'name' => $item->name,
                    'bulan' => $item->bulan,
                ];
                for ($day = 1; $day <= 31; $day++) {
                    $dayString = str_pad($day, 2, '0', STR_PAD_LEFT);
                    $sColumn = $dayString . '_S';
                    $mColumn = $dayString . '_M';
                    $result[$dayString] = max($item->$sColumn, $item->$mColumn);
                }
                return (object)$result;
            });

            // Debugging: Lihat hasil pemrosesan
            // dd($processedresultsMonth);


            // Mengambil data dari tabel data_beban_puncak30 berdasarkan tanggal terpilih
            $selectedDate = $request->input('selected_date', Carbon::today()->toDateString());
            $data = data_beban_puncak30::whereDate('tanggal', $selectedDate)->get();

            // Hitung rata-rata dan nilai maksimum untuk data harian
            $averageValue = $data->avg(function ($item) {
                return ($item->{"04_00"} + $item->{"04_30"} + $item->{"05_00"} + $item->{"05_30"} + $item->{"06_00"} + $item->{"06_30"} + $item->{"07_00"} + $item->{"07_30"} + $item->{"08_00"} + $item->{"08_30"} + $item->{"09_00"} + $item->{"09_30"} + $item->{"10_00"} + $item->{"10_30"} + $item->{"11_00"} + $item->{"11_30"} + $item->{"12_00"} + $item->{"12_30"} + $item->{"13_00"} + $item->{"13_30"} + $item->{"14_00"} + $item->{"14_30"} + $item->{"15_00"} + $item->{"15_30"} + $item->{"16_00"}) / 25;
            });

            $maxValue = 0;
            $maxColumn = '';
            foreach ($data as $item) {
                foreach ([
                    '04_00', '04_30', '05_00', '05_30', '06_00', '06_30', '07_00', '07_30', '08_00', '08_30', '09_00', '09_30', '10_00', '10_30', '11_00', '11_30', '12_00', '12_30', '13_00', '13_30', '14_00', '14_30', '15_00', '15_30', '16_00',
                ] as $columnName) {
                    if ($item->{$columnName} > $maxValue) {
                        $maxValue = $item->{$columnName};
                        $maxColumn = $columnName;
                    }
                }
            }

            // Lakukan hal yang sama untuk data malam
            // Hitung rata-rata dan nilai maksimum
            $averageValueM = $data->avg(function ($item) {
                return ($item->{"16_00"} + $item->{"16_30"} + $item->{"17_00"} + $item->{"17_30"} + $item->{"18_00"} + $item->{"18_30"} + $item->{"19_00"} + $item->{"19_30"} + $item->{"20_00"} + $item->{"20_30"} + $item->{"21_00"} + $item->{"21_30"} + $item->{"22_00"} + $item->{"22_30"} + $item->{"23_00"} + $item->{"23_30"} + $item->{"23_59"} + $item->{"00_30"} + $item->{"01_00"} + $item->{"01_30"} + $item->{"02_00"} + $item->{"02_30"} + $item->{"03_00"} + $item->{"03_30"} + $item->{"04_00"}) / 25;
            });

            $maxValueM = 0;
            $maxColumnM = '';
            foreach ($data as $item) {
                foreach ([
                    '16_00', '16_30', '17_00', '17_30', '18_00', '18_30', '19_00', '19_30', '20_00', '20_30', '21_00', '21_30', '22_00', '22_30', '23_00', '23_30', '23_59', '00_30', '01_00', '01_30', '02_00', '02_30', '03_00', '03_30', '04_00',
                ] as $columnNameM) {
                    if ($item->{$columnNameM} > $maxValueM) {
                        $maxValueM = $item->{$columnNameM};
                        $maxColumnM = $columnNameM;
                    }
                }
            }

            // Analytics untuk hari ini
            $maxValueToday = 0;
            $maxColumnToday = '';
            $tanggalHariIni = Carbon::today()->toDateString();
            $dataHariIni = data_beban_puncak30::whereDate('tanggal', $tanggalHariIni)->get();
            foreach ($dataHariIni as $item) {
                foreach ([
                    '00_30', '01_00', '01_30', '02_00', '02_30', '03_00', '03_30', '04_00', '04_30', '05_00', '05_30', '06_00', '06_30', '07_00', '07_30', '08_00', '08_30', '09_00', '09_30', '10_00', '10_30', '11_00', '11_30', '12_00', '12_30', '13_00', '13_30', '14_00', '14_30', '15_00', '15_30', '16_00', '16_30', '17_00', '17_30', '18_00', '18_30', '19_00', '19_30', '20_00', '20_30', '21_00', '21_30', '22_00', '22_30', '23_00', '23_30', '23_59',
                ] as $columnNameToday) {
                    if ($item->{$columnNameToday} > $maxValueToday) {
                        $maxValueToday = $item->{$columnNameToday};
                        $maxColumnToday = $columnNameToday;
                    }
                }
            }

            // Analytics untuk bulan ini
            $maxValueMonth = 0;
            $maxColumnMonth = '';
            $maxDateMonth = '';
            $bulanIni = date('F');
            $dataBulanIni = data_beban_puncak30::whereMonth('tanggal', now()->month)->get();
            foreach ($dataBulanIni as $item) {
                foreach ([
                    '00_30', '01_00', '01_30', '02_00', '02_30', '03_00', '03_30', '04_00', '04_30', '05_00', '05_30', '06_00', '06_30', '07_00', '07_30', '08_00', '08_30', '09_00', '09_30', '10_00', '10_30', '11_00', '11_30', '12_00', '12_30', '13_00', '13_30', '14_00', '14_30', '15_00', '15_30', '16_00', '16_30', '17_00', '17_30', '18_00', '18_30', '19_00', '19_30', '20_00', '20_30', '21_00', '21_30', '22_00', '22_30', '23_00', '23_30', '23_59',
                ] as $columnNameMonth) {
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
            $maxDateYear = '';
            $dataTahunIni = data_beban_puncak30::whereYear('tanggal', now()->year)->get();
            foreach ($dataTahunIni as $item) {
                foreach ([
                    '00_30', '01_00', '01_30', '02_00', '02_30', '03_00', '03_30', '04_00', '04_30', '05_00', '05_30', '06_00', '06_30', '07_00', '07_30', '08_00', '08_30', '09_00', '09_30', '10_00', '10_30', '11_00', '11_30', '12_00', '12_30', '13_00', '13_30', '14_00', '14_30', '15_00', '15_30', '16_00', '16_30', '17_00', '17_30', '18_00', '18_30', '19_00', '19_30', '20_00', '20_30', '21_00', '21_30', '22_00', '22_30', '23_00', '23_30', '23_59',
                ] as $columnNameYear) {
                    if ($item->{$columnNameYear} > $maxValueYear) {
                        $maxValueYear = $item->{$columnNameYear};
                        $maxColumnYear = $columnNameYear;
                        $maxDateYear = $item->tanggal; // Simpan tanggalnya
                    }
                }
            }

            return view('monitoring.detail', compact('data', 'dataHariIni', 'dataBulanIni', 'dataTahunIni','averageValue', 'maxValue', 'maxColumn', 'selectedDate','averageValueM', 'maxValueM', 'maxColumnM','maxValueToday', 'maxColumnToday','maxValueMonth', 'maxColumnMonth', 'maxDateMonth','maxValueYear', 'maxColumnYear', 'maxDateYear','processedResults', 'startDay', 'endDay','processedresultsMonth','StartBulan1'));
        }
    }


    public function mvcell()
    {

        if (Auth::user()->hasRole('Administrator')) {

            $data = mvcell::all();

            return view('admin.beban.MVCELL.mvcell', compact('data'));
        } elseif (Auth::user()->hasRole('operator')) {

            $data = mvcell::all();

            return view('Operator.beban.MVCELL.mvcell', compact('data'));
        } elseif (Auth::user()->hasRole('Visitor')) {

            $data = mvcell::all();

            return view('Visitor.beban.MVCELL.mvcell', compact('data'));
        } elseif (Auth::user()->hasRole('ValidatorOpsis')) {
            # code...

            $data = mvcell::all();

            return view('Opsis.beban.MVCELL.mvcell', compact('data'));
        }elseif (Auth::user()->hasRole('Manager')) {
            # code...

            $data = mvcell::all();

            return view('Manager.beban.MVCELL.mvcell', compact('data'));
        }
    }

    public function DetailMVCELL($id)
    {

        if (Auth::user()->hasRole(['Administrator', 'Visitor', 'EditorOpsis', 'ValidatorFasop', 'operator', 'ValidatorOpsis'])) {

            $data = mvcell::findOrFail($id);

            // dd($data);

            return view('TabelBeban.MVCELL.detail', compact('data'));
        }
    }

    public function EditMVCELL($id)
    {

        if (Auth::user()->hasRole('Administrator')) {

            $data = mvcell::findOrFail($id);

            // dd($data);

            return view('admin.beban.MVCELL.edit', compact('data'));
        }
    }

    public function downloadMVCELL(){

        return Excel::download(new mvcellExport, 'data_mvcell.xlsx');

    }


    public function bebanup3()
    {
        return view('admin.beban.up');
    }


    public function create()
    {
        return view('admin.createuser');
    }
}
