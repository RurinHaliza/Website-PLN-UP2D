<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Penyulang extends Model
{
    use HasFactory;

    protected $table = 'penyulang'; 

    protected $fillable = [
        'ID_JTM',
        'ID_GI',
        'ID_TRAFOGI',
        'NM_JTM',
        'NM_GI',
        'NM_SINGKATAN',
        'UP3',
        'ULP',
    ];
    
    /**
     * Definisikan relasi One-to-One dengan DataMasterFeeder.
     * Menggunakan 'feeder_pkey' sebagai Foreign Key di tabel data_master_feeder 
     * dan 'id' sebagai Local Key di tabel penyulang.
     */
    public function dataMasterFeeder(): HasOne
    {
        // Parameter urutan: (Model Relasi, Foreign Key di tabel Relasi, Local Key di Model ini)
        return $this->hasOne(DataMasterFeeder::class, 'feeder_pkey', 'id');
    }
}