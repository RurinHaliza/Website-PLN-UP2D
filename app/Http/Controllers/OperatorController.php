<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OperatorController extends Controller
{
    public function ScadaFailIndex(){

        return view('Operator.ScadaFail.input');

    }
}
