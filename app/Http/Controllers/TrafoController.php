<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TrafoController extends Controller
{
    public function index(){

        return view('admin.beban.DetailGI');

    }
}
