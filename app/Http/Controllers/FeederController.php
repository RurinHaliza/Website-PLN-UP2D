<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DataMasterFeeder; // Nama Model yang BENAR
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel; // Untuk fungsi Export

class FeederController extends Controller
{
    /**
     * Menampilkan daftar semua data Feeder (Index).
     * Route Name: bebanfeeder
     */
    public function index()
    {
        // KOREKSI: Menggunakan DataMasterFeeder::
        $dataFeeders = DataMasterFeeder::paginate(10); 
        
        return view('admin.beban.Feeder_master.feeder_master', [
            'dataFeeders' => $dataFeeders,
            'title' => 'Beban Feeder'
        ]);
    }

    /**
     * Menampilkan detail data Feeder.
     * Route Name: detail.feeder.admin
     */
    public function detail($id)
    {
        // Data diambil dan dinamai $feeder
        $feeder = DataMasterFeeder::findOrFail($id);
        
        // PERBAIKAN: Mengirim $feeder ke view, tetapi menggunakan key 'data'
        // Sehingga di view, data bisa diakses sebagai $data
        return view('admin.beban.Feeder_master.detail', [
            'data' => $feeder, // <-- Bagian ini yang mengatasi error 'Undefined variable $data'
            'title' => 'Detail Feeder'
        ]);
    }
    
    /**
     * Menampilkan form untuk menambah data Feeder.
     * Route Name: feeder.create.admin
     */
    public function create()
    {
        return view('admin.beban.Feeder_master.create', [
            'title' => 'Tambah Data Feeder'
        ]);
    }

    /**
     * Menyimpan data Feeder baru ke database.
     * Route Name: feeder.store.admin
     */
    public function store(Request $request)
    {
        // --- VALIDASI DATA ---
        $request->validate([
            'feeder_pkey' => 'required|string|unique:data_master_feeder,feeder_pkey',
            'gardu_induk' => 'required|string|max:50',
            't_no' => 'nullable|string|max:10',
            't_primary' => 'nullable|numeric',
            't_secondary' => 'nullable|numeric',
            't_daya' => 'nullable|numeric',
            'kms' => 'nullable|numeric',
            'mvcell' => 'nullable|string|max:50',
            'pelanggan' => 'nullable|string|max:50',
            'kelas' => 'nullable|string|max:10',
            'l/r' => 'nullable|string|max:2',
            'inom' => 'nullable|numeric',
            'iset' => 'nullable|numeric',
            'up3' => 'nullable|string|max:10',
            'name' => 'nullable|string|max:50',
        ]);

        // --- SIMPAN DATA ---
        try {
            // KOREKSI: Menggunakan DataMasterFeeder::
            DataMasterFeeder::create($request->all());
            return redirect()->route('bebanfeeder')->with('success', 'Data Feeder berhasil ditambahkan.');
        } catch (\Exception $e) {
            // Menambahkan withInput() untuk mempertahankan data yang di-submit
            return redirect()->back()->with('error', 'Gagal menyimpan data Feeder: ' . $e->getMessage())->withInput();
        }
    }

    /**
     * Menampilkan form untuk mengedit data Feeder.
     * Route Name: feeder.edit.admin
     */
    public function edit($id)
    {
        // KOREKSI: Menggunakan DataMasterFeeder::
        $feeder = DataMasterFeeder::findOrFail($id);
        
        return view('admin.beban.Feeder_master.edit', [
            'feeder' => $feeder,
            'title' => 'Edit Data Feeder'
        ]);
    }

    /**
     * Memperbarui data Feeder di database.
     * Route Name: feeder.update.admin
     */
    public function update(Request $request, $id)
    {
        // KOREKSI: Menggunakan DataMasterFeeder::
        $feeder = DataMasterFeeder::findOrFail($id);
        
        // --- VALIDASI DATA (LENGKAP DAN KONSISTEN) ---
        $request->validate([
            'feeder_pkey' => 'required|string|max:255',
            'gardu_induk' => 'required|string|max:50',
            't_no' => 'nullable|string|max:10',
            't_primary' => 'nullable|numeric',
            't_secondary' => 'nullable|numeric',
            't_daya' => 'nullable|numeric',
            'kms' => 'nullable|numeric',
            'mvcell' => 'nullable|string|max:50',
            'pelanggan' => 'nullable|string|max:50',
            'kelas' => 'nullable|string|max:10',
            'l/r' => 'nullable|string|max:2',
            'inom' => 'nullable|numeric',
        ]);

        
        // --- UPDATE DATA ---
        try {
            $feeder->update($request->all());
            return redirect()->route('bebanpenyulang')->with('success', 'Data Feeder berhasil diperbarui.');
        } catch (\Exception $e) {
            // Menambahkan withInput() untuk mempertahankan data yang di-submit
            return redirect()->back()->with('error', 'Gagal memperbarui data Feeder: ' . $e->getMessage())->withInput();
        }
    }

    /**
     * Menghapus data Feeder.
     * Route Name: feeder.delete.admin
     */
    public function destroy($id)
    {
        try {
            // KOREKSI: Menggunakan DataMasterFeeder::
            $feeder = DataMasterFeeder::findOrFail($id);
            $feeder->delete();
            return redirect()->route('bebanpenyulang')->with('success', 'Data Feeder berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->route('bebanpenyulang')->with('error', 'Gagal menghapus data Feeder: ' . $e->getMessage());
        }
    }
    
    /**
     * Export data Feeder ke format Excel.
     * Route Name: download.excel.adminfeeder
     */
    public function Export()
    {
        // Fungsi ini dibiarkan sebagai placeholder karena butuh class Export
        return redirect()->route('bebanfeeder')->with('info', 'Fungsi Export Feeder sedang dikembangkan atau membutuhkan package Laravel Excel.');
    }
}