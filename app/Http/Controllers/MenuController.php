<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MenuController extends Controller
{

    public function harian()
    {
        return view('admin.monitoring.hari');
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
}
