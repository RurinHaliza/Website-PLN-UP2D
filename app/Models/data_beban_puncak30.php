<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\data_beban_puncak30;
class data_beban_puncak30 extends Model
{
    use HasFactory;
    protected $table = 'data_beban_puncak30';

    protected $fillable = [
        'id',
        'feeder_pkey',
        'gardu_induk',
        'incoming',
        'name',
        'tanggal',
        '00_30',
        '01_00',
        '01_30',
        '02_00',
        '02_30',
        '03_00',
        '03_30',
        '04_00',
        '04_30',
        '05_00',
        '05_30',
        '06_00',
        '06_30',
        '07_00',
        '07_30',
        '08_00',
        '08_30',
        '09_00',
        '09_30',
        '10_00',
        '10_30',
        '11_00',
        '11_30',
        '12_00',
        '12_30',
        '13_00',
        '13_30',
        '14_00',
        '14_30',
        '15_00',
        '15_30',
        '16_00',
        '16_30',
        '17_00',
        '17_30',
        '18_00',
        '18_30',
        '19_00',
        '19_30',
        '20_00',
        '20_30',
        '21_00',
        '21_30',
        '22_00',
        '22_30',
        '23_00',
        '23_30',
        '23_59'
    ];
}
