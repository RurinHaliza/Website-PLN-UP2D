<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class trafo extends Model
{
    use HasFactory;

    protected $table = 'trafo';

    protected $fillable = [
        'Nama_GI',
        'TRAFO',
        'ID_TRAFO',
        'ID_KELAS',
        'KD_PEMILIK',
        'KD_PENGELOLA',
        'TINGKAT_RESIKO',
        'KODE_PERALATAN',
        'MERK',
        'NO_SERI' ,
        'PERUNTUKAN' ,
        'JENIS',
        'STATUS',
        'TGL_PASANG',
        'TGL_OPERASI',
        'NILAI_PEROLEHAN',
        'NILAI_BUKU',
        'UMUR_EKONOMIS',
        'UMUR_MANFAAT',
    ];
}
