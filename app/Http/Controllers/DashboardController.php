<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\GITable;
use App\Models\trafo;
use App\Models\Penyulang;
use App\Models\mvcell;

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

            $getLokasiGI = GITable::orderBy('Nama_GI','ASC')->get();

            foreach($getLokasiGI as $lok){

                $initialMarkers[] = [
                    'position' => [
                        'lat' => (float) $lok->x,
                        'lng' => (float) $lok->y,
                    ],
                    'note' => [
                        'id' => 'ID_FGI',
                        'nama' => $lok->Nama_GI,
                        'KD_Pemilik' => $lok->KD_Pemilik,
                        
                    ],
                    'draggable' => false,
                ];

            }

            // dd($initialMarkers);

            // dd($countPenyulang);
            return view('admin.Dashboard',compact('countGI','countTrafo','countPenyulang','feeder','countMvcell','initialMarkers'));

        }elseif(Auth::user()->hasRole('operator')){
            $countGI = GITable::count();
            $countTrafo = trafo::count();
            $countPenyulang = Penyulang::count();
            $feeder = Penyulang::count();
            $countMvcell = mvcell::count();

            return view('Operator.Dashboard',compact('countGI','countTrafo','countPenyulang','feeder','countMvcell'));

        }elseif(Auth::user()->hasRole('ValidatorOpsis')){

            return view('Opsis.Dashboard');

        }elseif(Auth::user()->hasRole('ValidatorFasop')){

            $countGI = GITable::count();
            $countTrafo = trafo::count();
            $countPenyulang = Penyulang::count();
            $feeder = Penyulang::count();
            $countMvcell = mvcell::count();

            return view('Fasop.Dashboard',compact('countGI','countTrafo','countPenyulang','feeder','countMvcell'));

        }elseif(Auth::user()->hasRole('EditorOpsis')){

            return view('EditorOpsis.Dashboard');

        }elseif(Auth::user()->hasRole('Visitor')){

            $countGI = GITable::count();
            $countTrafo = trafo::count();
            $countPenyulang = Penyulang::count();
            $feeder = Penyulang::count();
            $countMvcell = mvcell::count();

            return view('Visitor.Dashboard',compact('countGI','countTrafo','countPenyulang','feeder','countMvcell'));

        }elseif(Auth::user()->hasRole('Manager')){

            $countGI = GITable::count();
            $countTrafo = trafo::count();
            $countPenyulang = Penyulang::count();
            $feeder = Penyulang::count();
            $countMvcell = mvcell::count();

            return view('Manager.Dashboard',compact('countGI','countTrafo','countPenyulang','feeder','countMvcell'));

        }


    }
}
