<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DgMvcell extends Model
{
    use HasFactory;

    protected $table = 'dg_mvcell';   // nama tabel
    protected $primaryKey = 'id';     // primary key
    public $incrementing = true;      // id bertipe integer auto increment
    protected $keyType = 'int';

    public $timestamps = true;        // karena ada updated_at & created_at

    // kolom yang bisa diisi (jika butuh)
    protected $fillable = [
        'UPT',
    ];
}