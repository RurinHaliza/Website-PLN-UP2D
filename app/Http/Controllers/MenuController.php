<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function harian()
    {

        return view('admin.monitoring.hari');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function mingguan()
    {
        return view('admin.monitoring.minggu');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
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
