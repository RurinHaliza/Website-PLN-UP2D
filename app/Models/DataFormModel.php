<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataFormModel extends Model
{
    use HasFactory;

    protected $table = 'dataform';
    protected $fillable = [
        'nama_gi',
        'wilayah',
        'up3',
        'no_trafo',
        'primer',
        'sekunder',
        'daya',
        'inom',
        'i_siang',
        'i_malam',
        'persen_siang',
        'persen_malam',
    ];

    public $timestamps = true;
}
