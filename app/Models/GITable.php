<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GITable extends Model
{
    use HasFactory;

    protected $table = 'GITable';

    protected $fillable = [
        'ID_FGI',
        'Nama_GI',
        'NAMA_SINGKATAN',
        'KD_PEMILIK',
        'KD_PENGELOLA',
        'tingkat_resiko',
        'x',
        'y',
    ];

}
