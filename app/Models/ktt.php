<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ktt extends Model
{
    use HasFactory;

    protected $table = 'beban_ktt';

    protected $fillable = [
        'pkey',
        'station',
        'nama',
        'daya',
        'alamat',
        'tanggal',
        'cb',
        'meter',
        'status_meter',
    ];
}
