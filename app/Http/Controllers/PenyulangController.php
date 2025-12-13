<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Penyulang;
use App\Exports\PenyulangExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\DataMasterFeeder;
use App\Models\DgMvcell;
use Illuminate\Support\Facades\DB;

class PenyulangController extends Controller
{
    // ... method detail(), create(), dll. (TIDAK BERUBAH) ...

    /**
     * Menyimpan data Penyulang baru dan Data Master Feeder terkait ke database.
     */
    public function store(Request $request)
    {
        // Hanya izinkan role tertentu untuk menyimpan data baru
        if (!Auth::user()->hasRole(['Administrator', 'EditorOpsis', 'operator', 'ValidatorOpsis'])) {
            return redirect()->back()->with('error', 'Anda tidak memiliki izin untuk melakukan aksi ini.');
        }

        // 1. VALIDASI DATA (PENTING!)
        $request->validate([
            'ULP' => 'required|string|max:255',
            'GARDU_INDUK' => 'required|string|max:255',
            'UPT' => 'required|exists:dg_mvcell,id',
            'NM_JTM' => 'required|string|max:255',
            'T_DAYA' => 'nullable|numeric',
            'UP3' => 'required|max:255',
            // VALIDASI MINIMAL UNTUK PKEY
            'PKEY_VAL_IR' => 'required|max:255',
            'PKEY_VAL_IS' => 'required|max:255',
            'PKEY_VAL_IT' => 'required|max:255',
            'PKEY_VAL_P' => 'required|max:255',
            'PKEY_VAL_V' => 'required|max:255',
            // Tambahkan validasi lain sesuai kebutuhan form
            'T_NO' => 'nullable|string|max:255',
            'T_PRIMARY' => 'nullable|string|max:255',
            'T_SECONDARY' => 'nullable|string|max:255',
            'KMS' => 'nullable|numeric',
            'MVCELL' => 'nullable|string|max:255',
            'PELANGGAN' => 'nullable|string|max:255',
            'KELAS' => 'nullable|string|max:255',
            'IR_VAL' => 'nullable|string|max:255', // Ini adalah I/R di form
            'INOM' => 'nullable|string|max:255',
            'ISET' => 'nullable|string|max:255',
            'ID_FEEDER_PKEY' => 'nullable|string|max:255',
        ]);

        // dd($request->all());

        try {
            // Mulai Transaksi Database
            DB::beginTransaction();

            // Penyulang::create($request->all());     
            // ===============================================
            // 2. SIMPAN KE TABEL PENYULANG (Data Identitas & Lokasi)
            // ===============================================

            // Ambil ID terbesar dari database
            $lastID_JTM = Penyulang::max('ID_JTM');
            $lastID_GI = Penyulang::max('ID_GI');
            $lastID_TRAFOGI = Penyulang::max('ID_TRAFOGI');

            // Jika data masih kosong → siapkan fallback default
            $lastID_JTM = $lastID_JTM ?? '51FG0000000000';
            $lastID_GI = $lastID_GI ?? '51FG0000000000';
            $lastID_TRAFOGI = $lastID_TRAFOGI ?? '51FG0000000000';

            // === MEMISAHKAN PREFIX (4 HURUF) DENGAN ANGKA ===
            $prefixJTM = substr($lastID_JTM, 0, 4);
            $prefixGI = substr($lastID_GI, 0, 4);
            $prefixTR = substr($lastID_TRAFOGI, 0, 4);

            $numJTM = intval(substr($lastID_JTM, 4));        // ambil angka saja
            $numGI = intval(substr($lastID_GI, 4));
            $numTR = intval(substr($lastID_TRAFOGI, 4));

            // === MENAMBAHKAN 1 KE ANGKA ===
            $newNumJTM = $numJTM + 1;
            $newNumGI = $numGI + 1;
            $newNumTR = $numTR + 1;

            // === MENGEMBALIKAN PREFIX + ANGKA (DENGAN ZERO-PADDING) ===
            $newID_JTM = $prefixJTM . str_pad($newNumJTM, strlen(substr($lastID_JTM, 4)), '0', STR_PAD_LEFT);
            $newID_GI = $prefixGI . str_pad($newNumGI, strlen(substr($lastID_GI, 4)), '0', STR_PAD_LEFT);
            $newID_TRAFOGI = $prefixTR . str_pad($newNumTR, strlen(substr($lastID_TRAFOGI, 4)), '0', STR_PAD_LEFT);

            // === SIMPAN ===
            $penyulang = Penyulang::create([
                'ID_JTM' => $newID_JTM,
                'ID_GI' => $newID_GI,
                'ID_TRAFOGI' => $newID_TRAFOGI,

                'NM_SINGKATAN' => $request->NM_SINGKATAN,
                'ULP' => $request->ULP,
                'NM_GI' => $request->GARDU_INDUK,
                'NM_JTM' => $namaUPT,
                'UP3' => $request->UP3,
            ]);


            // ===============================================
            // PRE-PROCESSING: Convert empty string for nullable numeric field to NULL
            // Ini mencegah error "Incorrect decimal value" jika user membiarkan field numerik kosong
            // ===============================================
            $t_daya = $request->T_DAYA !== null && $request->T_DAYA !== '' ? $request->T_DAYA : null;
            $kms = $request->KMS !== null && $request->KMS !== '' ? $request->KMS : null;

            // ===============================================
            // 3. SIMPAN KE TABEL DATA MASTER FEEDER (Data Teknis - 5 BARIS)
            // ===============================================

            $pkeys_to_save = ['IR', 'IS', 'IT', 'P', 'V'];

            // Siapkan data umum, disesuaikan dengan nama kolom DB (lowercase/snake_case)
            $common_data = [
                // 'penyulang_id' => $penyulang->id, 
                'gardu_induk' => $request->GARDU_INDUK, // << Duplikasi: GARDU_INDUK (form) -> gardu_induk (feeder)
                't_daya' => $t_daya, // Menggunakan nilai yang sudah diproses
                't_no' => $request->T_NO,
                't_primary' => $request->T_PRIMARY,
                't_secondary' => $request->T_SECONDARY,
                'kms' => $kms, // Menggunakan nilai yang sudah diproses
                'feeder' => $namaUPT,// << Duplikasi: NM_JTM (form) -> feeder (feeder)
                'mvcell' => $request->MVCELL,
                'pelanggan' => $request->PELANGGAN,
                'kelas' => $request->KELAS,
                'l/r' => "R",
                'inom' => $request->INOM,
                'iset' => $request->ISET,

                // Duplikasi ULP
                'ulp' => $request->ULP,
                'up3' => $request->UP3,
            ];

            //ini unutk mengambil feeder_pkey terakhir

            foreach ($pkeys_to_save as $pkey_name) {

                // Cek feeder_pkey terakhir
                $last = DataMasterFeeder::orderBy('feeder_pkey', 'desc')->first();
                $lastNumber = $last ? (int) $last->feeder_pkey : 0;

                // feeder_pkey baru
                $feeder_pkey = $lastNumber + 1;

                $data_row = array_merge($common_data, [
                    'name' => $pkey_name,
                    'feeder_pkey' => $feeder_pkey,
                ]);

                DataMasterFeeder::create($data_row);
            }

            // Commit Transaksi jika kedua operasi berhasil
            DB::commit();

            // 📢 PERUBAHAN: Mengganti 'penyulang.index' menjadi 'penyulang.operator'
            // return redirect()->route('penyulang.operator')->with('success', 'Data Penyulang dan 5 data PKEY terkait berhasil ditambahkan!');
            return redirect()->route('bebanpenyulang')->with('success', 'Data penyulang berhasil disimpan!');

        } catch (\Exception $e) {
            // Rollback Transaksi jika terjadi kegagalan
            DB::rollback();

            return redirect()->back()
                ->withInput()
                ->with('error', 'Gagal menyimpan data. Terdapat masalah skema database (Foreign Key/Kolom). Error: ' . $e->getMessage());
        }
    }

    // ======================================================================================
    // 📢 MODIFIKASI: Method index() sekarang menangani filter 'show entries' (limit), 'search', dan 'table'
    // ======================================================================================
    public function index(Request $request) // <-- Wajib menambahkan (Request $request)
    {
        // 1. Ambil nilai filter dari request (query string)
        $limit = $request->get('show', 10); // Default ke 10 entries
        $search = $request->get('search');
        $current_table = $request->get('table', 'penyulang'); // Default ke 'penyulang'

        // 2. Memulai Query Eloquent berdasarkan tabel yang dipilih
        if ($current_table === 'feeder') {
            $query = DataMasterFeeder::query();
        } else {
            // Default: 'penyulang'
            $query = Penyulang::query();
            // Eager Loading (hanya berlaku untuk tabel Penyulang)
            $query->with('dataMasterFeeder');
        }

        // 3. Logika Pencarian
        if ($search) {
            $query->where(function ($q) use ($search, $current_table) {
                if ($current_table === 'feeder') {
                    // Pencarian di tabel DataMasterFeeder
                    $q->where('feeder', 'LIKE', "%{$search}%")
                        ->orWhere('gardu_induk', 'LIKE', "%{$search}%")
                        ->orWhere('name', 'LIKE', "%{$search}%");
                } else {
                    // Pencarian di tabel Penyulang
                    $q->where('NM_JTM', 'LIKE', "%{$search}%")
                        ->orWhere('ID_JTM', 'LIKE', "%{$search}%")
                        ->orWhere('NM_SINGKATAN', 'LIKE', "%{$search}%");

                    // Pencarian di tabel DataMasterFeeder (melalui relasi)
                    $q->orWhereHas('dataMasterFeeder', function ($subQuery) use ($search) {
                        $subQuery->where('feeder', 'LIKE', "%{$search}%");
                    });
                }
            });
        }

        // 4. Menerapkan Limit dan Pagination
        $data = $query->paginate($limit)
            ->withQueryString(); // Memastikan parameter 'show', 'search', dan 'table' dipertahankan

        // Logika View lama Anda:
        $userRole = Auth::user()->roles()->first()->name ?? 'Visitor';

        // Mapping role ke view folder
        $roleToView = [
            'Administrator' => 'admin.beban.penyulang',
            'operator' => 'Operator.beban.penyulang',
            'Visitor' => 'Visitor.beban.penyulang',
            'ValidatorFasop' => 'Fasop.beban.penyulang',
            'ValidatorOpsis' => 'Opsis.beban.penyulang',
            'Manager' => 'Manager.beban.penyulang',
            'EditorOpsis' => 'EditorOpsis.beban.penyulang',
        ];

        // Jika role ada di mapping, gunakan view tersebut. Jika tidak, default ke Visitor.
        $viewPath = $roleToView[$userRole] ?? 'Visitor.beban.penyulang';

        // 5. Mengirim data ke View
        return view($viewPath, [
            'penyulang' => $data, // Menggunakan variabel $data yang bisa berupa Penyulang atau Feeder
            'current_limit' => $limit,
            'current_search' => $search,
            'current_table' => $current_table, // MENGIRIM PARAMETER TABEL YANG AKTIF
        ]);
    }

    public function detail($id)
    {
        if (Auth::user()->hasRole(['Administrator', 'Visitor', 'EditorOpsis', 'ValidatorFasop', 'operator', 'ValidatorOpsis', 'Manager'])) {
            $data = Penyulang::findOrFail($id);
            // Anda mungkin ingin memuat data Master Feeder terkait di sini
            // $data_master = $data->dataMasterFeeder; 

            return view('TabelBeban.Penyulang.detail', compact('data'));
        }
    }

    public function create()
    {
        if (Auth::user()->hasRole(['Administrator', 'EditorOpsis', 'operator', 'ValidatorOpsis'])) {

            // $unique_gardu_induk = DgMvcell::selectRaw('GARDU INDUK AS gardu_induk')
            //     ->distinct()
            //     ->pluck('gardu_induk');
            $unique_gardu_induk = DgMvcell::selectRaw('`GARDU INDUK` AS gardu_induk')
                ->distinct()
                ->pluck('gardu_induk');


            $feeders = DataMasterFeeder::all();
            $penyulangs = Penyulang::all();
            $dg_mvcell = DgMvcell::all();

            $viewName = Auth::user()->hasRole('Administrator') ?
                'admin.beban.Penyulang.create' :
                (Auth::user()->hasRole('operator') ?
                    'Operator.beban.Penyulang.create' :
                    'EditorOpsis.beban.Penyulang.create');

            // 🔥 Tambahkan unique_gardu_induk di compact
            return view($viewName, compact('feeders', 'penyulangs', 'dg_mvcell', 'unique_gardu_induk'));
        }

        return redirect()->route('penyulang.operator')->with('error', 'Anda tidak memiliki akses untuk menambah data');
    }

    public function update(Request $request, $id)
    {

        if (Auth::user()->hasRole('Administrator')) {

            $req = $request->all();

            $update = Penyulang::where('id', $id)->update([

                'ID_JTM' => $request->ID_JTM,
                'ID_GI' => $request->ID_GI,
                'ID_TRAFOGI' => $request->ID_TRAFOGI,
                'NM_JTM' => $request->NM_JTM,
                'NM_GI' => $request->NM_GI,
                'NM_SINGKATAN' => $request->NM_SINGKATAN,
                'UP3' => $request->UP3,
                'ULP' => $request->ULP,

            ]);

            if ($update) {
                // Sesuai permintaan: menggunakan 'bebanpenyulang' - TIDAK BERUBAH
                // Jika ingin diarahkan ke halaman indeks penyulang, ganti 'bebanpenyulang' menjadi 'penyulang.operator'
                return redirect()->route('bebanpenyulang')->with('success', 'Data Berhasil di update');
            }
        }
    }

    // Tambahan method destroy
    public function destroy($id)
    {
        if (Auth::user()->hasRole('Administrator')) {
            $penyulang = Penyulang::findOrFail($id);

            // Hapus data terkait di DataMasterFeeder terlebih dahulu (wajib untuk menghindari foreign key constraint error)
            DataMasterFeeder::where('id', $id)->delete();

            if ($penyulang->delete()) {
                // 📢 PERUBAHAN: Mengganti 'penyulang.index' menjadi 'penyulang.operator'
                return redirect()->route('bebanpenyulang')->with('success', 'Data berhasil dihapus');
            } else {
                // 📢 PERUBAHAN: Mengganti 'penyulang.index' menjadi 'penyulang.operator'
                return redirect()->route('bebanpenyulang')->with('error', 'Data gagal dihapus');
            }
        } else {
            // 📢 PERUBAHAN: Mengganti 'penyulang.index' menjadi 'penyulang.operator'
            return redirect()->route('bebanpenyulang')->with('error', 'Anda tidak memiliki akses untuk menghapus data');
        }
    }

    public function getKubikel(Request $request)
    {
        $request->validate([
            'gardu_induk' => 'required'
        ]);

        $garduInduk = $request->gardu_induk;

        $kubikel = DgMvcell::selectRaw('NAMA KUBIKEL AS nama_kubikel')
            ->whereRaw('GARDU INDUK= ?', [$garduInduk])
            ->whereRaw('STATUS = "Operasi"')
            ->whereIn('KATEGORI', ['outgoing', 'incoming'])
            ->orderByRaw('NAMA KUBIKEL ASC')
            ->get();

        return response()->json($kubikel);
    }

    public function filterKubikel($gardu_id)
    {
        $kubikels = Dgmvcell::where('gardu_induk_id', $gardu_id)
            ->where('status', 'Operasi')
            ->whereIn('kategori', ['incoming', 'outgoing'])
            ->get(['nama_kubikel']); // ambil hanya nama kubikel

        return response()->json($kubikels);
    }

    /**
     * Ambil detail kubikel berdasarkan nama kubikel
     */
    public function getKubikelDetail($nama_kubikel)
    {
        $kubikel = Dgmvcell::where('NAMA KUBIKEL', $nama_kubikel)
            ->where('status', 'Operasi')
            ->first();

        if ($kubikel) {
            return response()->json([
                'no_trafo' => $kubikel->{'NO TRAFO'},
                'up3' => $kubikel->UP3,
                'ulp' => $kubikel->ULP,
                'mvcell' => $kubikel->MERK,
                'pelanggan' => $kubikel->{'JENIS PELANGGAN'},
                'kms' => $kubikel->{'panjang KMS'},
                'ir' => $kubikel->{'PKEY IR SCADA'},
            ]);
        }

        return response()->json(['error' => 'Data tidak ditemukan'], 404);
    }


    public function Export()
    {
        return Excel::download(new PenyulangExport, 'data_penyulang.xlsx');
    }
}