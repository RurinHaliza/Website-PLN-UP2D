<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\ktt;

class KTTController extends Controller
{
    public function index(){

        if (Auth::user()->hasRole('Administrator')) {

            $bebanktt = ktt::all();
            //dd($bebanktt);
            return view('admin.beban.ktt', compact('bebanktt'));
        } elseif (Auth::user()->hasRole('operator')) {

            $bebanktt = ktt::all();
            //dd($bebanktt);
            return view('Operator.beban.ktt', compact('bebanktt'));
        } elseif (Auth::user()->hasRole('Visitor')) {

            $bebanktt = ktt::all();
            //dd($bebanktt); 
            return view('Visitor.beban.ktt', compact('bebanktt'));
        } elseif (Auth::user()->hasRole('ValidatorFasop')) {

            $bebanktt = ktt::all();
            //dd($bebanktt); 
            return view('Fasop.beban.ktt', compact('bebanktt'));

    } elseif (Auth::user()->hasRole('ValidatorOpsis')) {

        $bebanktt = ktt::all();
        //dd($bebanktt); 
        return view('Opsis.beban.ktt', compact('bebanktt'));

    }
    }

    public function Detail($id){

        if(Auth::user()->hasRole('Administrator')){
            $data = ktt::findOrFail($id);
            
            return view('admin.beban.KTT.detail',compact('data'));

        }elseif(Auth::user()->hasRole('Visitor')){


        }elseif(Auth::user()->hasRole('EditorOpsis')){

        }elseif(Auth::user()->hasRole('ValidatorFasop')){
            $data = ktt::findOrFail($id);
            
            return view('Fasop.beban.KTT.detail',compact('data'));
                
        }elseif(Auth::user()->hasRole('operator')){
            
            $data = ktt::findOrFail($id);
            
            return view('Operator.beban.KTT.detail',compact('data'));

        }elseif(Auth::user()->hasRole('ValidatorOpsis')){
            
            $data = ktt::findOrFail($id);
            
            return view('Opsis.beban.KTT.detail',compact('data'));

        }


    }

    public function Edit($id){

        if(Auth::user()->hasRole('Administrator')){

            $data = ktt::findOrFail($id);

            // dd($data); 

            return view('admin.beban.KTT.edit',compact('data'));
        }

    }

    public function updateData(Request $request, $id){

        if(Auth::user()->hasRole('Administrator')){

            $update = ktt::where('id', $id)->update([

                'pkey' => $request->pkey,
                'station' => $request->station,
                'nama' => $request->nama,
                'daya' => $request->daya,
                'alamat' => $request->alamat,
                'tanggal' => $request->tanggal,
                'cb' => $request->cb,
                'meter' => $request->meter,
                'status_meter' => $request->status_meter,
            ]);

            if ($update) {
                return redirect()->route('bebanktt')->with('success', 'Data Berhasil di update');
            }


        }
        
    }


}
