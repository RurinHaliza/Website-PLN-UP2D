<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\View\View;
use App\Models\data_beban_puncak30;
use Session;
class MenuController extends Controller
{

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

    public function GI(){
        return view('admin.beban.GI');
    }

    public function create()
    {
        return view('admin.createuser');
    }
}
