<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DataMasterFeeder extends Model
{
    use HasFactory;

    // Nama tabel di database sudah benar
    protected $table = 'data_master_feeder'; 

    public $timestamps = false;

    // Kolom-kolom yang boleh diisi (mass assignment)
    protected $fillable = [
        // Foreign Key
        'penyulang_id', 
        
        // Data Umum Feeder, Disesuaikan dengan NAMA KOLOM DB di Gambar
        'gardu_induk',      // Sesuai 'gardu_induk' di DB
        't_daya',           // Sesuai 't_daya' di DB
        't_no',             // Sesuai 't_no' di DB
        't_primary',        // Sesuai 't_primary' di DB
        't_secondary',      // Sesuai 't_secondary' di DB
        'kms',              // Sesuai 'kms' di DB
        'feeder',           // Kolom 'feeder' di DB
        'mvcell',           // Sesuai 'mvcell' di DB
        'pelanggan',        // Sesuai 'pelanggan' di DB
        'kelas',            // Sesuai 'kelas' di DB
        'l/r',               // Sesuai 'ir' di DB
        'inom',             // Sesuai 'inom' di DB
        'iset',             // Sesuai 'iset' di DB
        'feeder_pkey',      // Sesuai 'feeder_pkey' di DB
        
        // KOLOM KRUSIAL UNTUK FORMAT VERTIKAL PKEY (sesuai gambar)
        'name',             // Kolom untuk menyimpan nama PKEY ('IR', 'IS', 'IT', 'P', 'V')
        'up3',              // Kolom untuk menyimpan NILAI PKEY (berdasarkan nilai yang ada di kolom 'up3' di gambar)
    ];

    /**
     * Definisikan relasi Many-to-One dengan Penyulang.
     * Setiap DataMasterFeeder hanya dimiliki oleh satu Penyulang.
     */
    public function penyulang(): BelongsTo
    {
        // Foreign key di tabel ini adalah 'penyulang_id'
        return $this->belongsTo(Penyulang::class, 'penyulang_id', 'id');
    }
}