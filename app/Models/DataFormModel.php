<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataFormModel extends Model
{
    use HasFactory;

    protected $table = 'formdata';
    protected $fillable = [
        'gardu_induk',
        'wilayah',
        'up3',
        'no_trafo',
        'primer',
        'sekunder',
        'daya',
        'Inom',
        'ISiang',
        'Imalam',
        'persensiang',
        'persenmalam',
        'bebantertinggi',
        'persentertinggi',
    ];

    public $timestamps = true;
}
