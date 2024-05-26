<?php

namespace App\Http\Controllers;

use App\Models\data_beban_puncak30;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\GITable;
use App\Models\trafo;
use App\Models\Penyulang;
use App\Models\mvcell;
use App\Models\formdata;

class DashboardController extends Controller
{
    public function index()
    {

        if (Auth::user()->hasRole('Administrator')) {

            $countGI = GITable::count();
            $countTrafo = trafo::count();
            $countPenyulang = Penyulang::count();
            $feeder = Penyulang::count();
            $countMvcell = mvcell::count();

            $getLokasiGI = GITable::orderBy('Nama_GI', 'ASC')->get();

            foreach ($getLokasiGI as $lok) {

                $jumlahpenyulang = Penyulang::where('ID_GI',$lok->ID_FGI)->count();
                $jumlahTrafo = trafo::where('Nama_GI',$lok->Nama_GI)->count();
                // dd($jumlahTrafo);

                $initialMarkers[] = [
                    'position' => [
                        'lat' => (float) $lok->x,
                        'lng' => (float) $lok->y,
                    ],
                    'note' => [
                        'idx' => $lok->id,
                        'id' => $lok->ID_FGI,
                        'nama' => $lok->Nama_GI,
                        'nama_singkatan' => $lok->NAMA_SINGKATAN,
                        'pengelola' => $lok->KD_Pengelola,
                        'jumlah_penyulang' => $jumlahpenyulang,
                        'jumlah_trafo' => $jumlahTrafo,
                    ],
                    'draggable' => false,
                ];
            }

            $CountTrafoSiang80 = formdata::where('persentertinggi','>',80)->count();
            $TrafoSiang80 = formdata::where('persentertinggi','>',80)->select('id','gardu_induk','wilayah','persensiang','persenmalam','persentertinggi')->get();
    
            $CountTrafo30 = formdata::where('persentertinggi','<',30)->count();
            $Trafo30 = formdata::where('persentertinggi','<',30)->select('id','gardu_induk','wilayah','persensiang','persenmalam','persentertinggi')->get();



            // dd($CountTrafoSiang80);

            // dd($initialMarkers);

            // dd($countPenyulang);
            return view('admin.Dashboard', compact('countGI', 'countTrafo', 'countPenyulang', 'feeder', 'countMvcell', 'initialMarkers','CountTrafoSiang80','TrafoSiang80','CountTrafo30','Trafo30'));
        } elseif (Auth::user()->hasRole('operator')) {
            $countGI = GITable::count();
            $countTrafo = trafo::count();
            $countPenyulang = Penyulang::count();
            $feeder = Penyulang::count();
            $countMvcell = mvcell::count();

            return view('Operator.Dashboard', compact('countGI', 'countTrafo', 'countPenyulang', 'feeder', 'countMvcell'));
        } elseif (Auth::user()->hasRole('ValidatorOpsis')) {

            return view('Opsis.Dashboard');
        } elseif (Auth::user()->hasRole('ValidatorFasop')) {

            $countGI = GITable::count();
            $countTrafo = trafo::count();
            $countPenyulang = Penyulang::count();
            $feeder = Penyulang::count();
            $countMvcell = mvcell::count();

            return view('Fasop.Dashboard', compact('countGI', 'countTrafo', 'countPenyulang', 'feeder', 'countMvcell'));
        } elseif (Auth::user()->hasRole('EditorOpsis')) {

            return view('EditorOpsis.Dashboard');
        } elseif (Auth::user()->hasRole('Visitor')) {

            $countGI = GITable::count();
            $countTrafo = trafo::count();
            $countPenyulang = Penyulang::count();
            $feeder = Penyulang::count();
            $countMvcell = mvcell::count();

            return view('Visitor.Dashboard', compact('countGI', 'countTrafo', 'countPenyulang', 'feeder', 'countMvcell'));
        } elseif (Auth::user()->hasRole('Manager')) {

            $countGI = GITable::count();
            $countTrafo = trafo::count();
            $countPenyulang = Penyulang::count();
            $feeder = Penyulang::count();
            $countMvcell = mvcell::count();

            return view('Manager.Dashboard', compact('countGI', 'countTrafo', 'countPenyulang', 'feeder', 'countMvcell'));
        }
    }

                    // $getbeban = data_beban_puncak30::where('gardu_induk', 'LIKE', $lok->Nama_GI)->where('tanggal', '2024-01-25')->first();

                // // dd($getbeban);
                // $J00_30 = $getbeban->{'00_30'};
                // $J01_00 = $getbeban->{'01_00'};
                // $J01_30 = $getbeban->{'01_30'};
                // $J02_00 = $getbeban->{'02_00'};
                // $J02_30 = $getbeban->{'02_30'};
                // $J03_00 = $getbeban->{'03_00'};
                // $J03_30 = $getbeban->{'03_30'};
                // $J04_00 = $getbeban->{'04_00'};
                // $J04_30 = $getbeban->{'04_30'};
                // $J05_00 = $getbeban->{'05_00'};
                // $J05_30 = $getbeban->{'05_30'};
                // $J06_00 = $getbeban->{'06_00'};
                // $J06_30 = $getbeban->{'06_30'};
                // $J07_00 = $getbeban->{'07_00'};
                // $J07_30 = $getbeban->{'07_30'};
                // $J08_00 = $getbeban->{'08_00'};
                // $J08_30 = $getbeban->{'08_30'};
                // $J09_00 = $getbeban->{'09_00'};
                // $J09_30 = $getbeban->{'09_30'};
                // $J10_00 = $getbeban->{'10_00'};
                // $J10_30 = $getbeban->{'10_30'};
                // $J11_00 = $getbeban->{'11_00'};
                // $J11_30 = $getbeban->{'11_30'};
                // $J12_00 = $getbeban->{'12_00'};
                // $J12_30 = $getbeban->{'12_30'};
                // $J13_00 = $getbeban->{'13_00'};
                // $J13_30 = $getbeban->{'13_30'};
                // $J14_00 = $getbeban->{'14_00'};
                // $J14_30 = $getbeban->{'14_30'};
                // $J15_00 = $getbeban->{'15_00'};
                // $J15_30 = $getbeban->{'15_30'};
                // $J16_00 = $getbeban->{'16_00'};
                // $J16_30 = $getbeban->{'16_30'};
                // $J17_00 = $getbeban->{'17_00'};
                // $J17_30 = $getbeban->{'17_30'};
                // $J18_00 = $getbeban->{'18_00'};
                // $J18_30 = $getbeban->{'18_30'};

                // $J19_00 = $getbeban->{'19_00'};
                // $J19_30 = $getbeban->{'19_30'};
                // $J20_00 = $getbeban->{'20_00'};
                // $J20_30 = $getbeban->{'20_30'};
                // $J21_00 = $getbeban->{'21_00'};
                // $J21_30 = $getbeban->{'21_30'};
                // $J22_00 = $getbeban->{'22_00'};
                // $J22_30 = $getbeban->{'22_30'};
                // $J23_00 = $getbeban->{'23_00'};
                // $J23_30 = $getbeban->{'23_30'};
                // $J23_59 = $getbeban->{'23_59'};

                // $max = max([
                //     $J00_30, $J01_00, $J01_30,
                //     $J02_00,
                //     $J02_30,
                //     $J03_00,
                //     $J03_30,
                //     $J04_00,
                //     $J04_30,
                //     $J05_00,
                //     $J05_30,
                //     $J06_00,
                //     $J06_30,
                //     $J07_00,
                //     $J07_30,
                //     $J08_00,
                //     $J08_30,
                //     $J09_00,
                //     $J09_30,
                //     $J10_00,
                //     $J10_30,
                //     $J11_00,
                //     $J11_30,
                //     $J12_00,
                //     $J12_30,
                //     $J13_00,
                //     $J13_30,
                //     $J14_00,
                //     $J14_30,
                //     $J15_00,
                //     $J15_30,
                //     $J16_00,
                //     $J16_30,
                //     $J17_00,
                //     $J17_30,
                //     $J18_00,
                //     $J18_30,

                //     $J19_00,
                //     $J19_30,
                //     $J20_00,
                //     $J20_30,
                //     $J21_00,
                //     $J21_30,
                //     $J22_00,
                //     $J22_30,
                //     $J23_00,
                //     $J23_30,
                //     $J23_59,
                // ]);

                // dd($max);
}
