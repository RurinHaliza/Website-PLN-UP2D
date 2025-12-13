<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// use App\Models\data_beban_puncak30;
class data_beban_puncak30 extends Model
{
    use HasFactory;
    protected $table = 'data_beban_puncak30';

    public $timestamps = false;

    protected $fillable = [
        'id',
        'feeder_pkey',
        'gardu_induk',
        'incoming',
        'name',
        'bulan',
        '01_S',
        '01_M',
        '02_S',
        '02_M',
        '03_S',
        '03_M',
        '04_S',
        '04_M',
        '05_S',
        '05_M',
        '06_S',
        '06_M',
        '07_S',
        '07_M',
        '08_S',
        '08_M',
        '09_S',
        '09_M',
        '10_S',
        '10_M',
        '11_S',
        '11_M',
        '12_S',
        '12_M',
        '13_S',
        '13_M',
        '14_S',
        '14_M',
        '15_S',
        '15_M',
        '16_S',
        '16_M',
        '17_S',
        '17_M',
        '18_S',
        '18_M',
        '19_S',
        '19_M',
        '20_S',
        '20_M',
        '21_S',
        '21_M',
        '22_S',
        '22_M',
        '23_S',
        '23_M',
        '24_S',
        '24_M',
        '25_S',
        '25_M',
        '26_S',
        '26_M',
        '27_S',
        '27_M',
        '28_S',
        '28_M',
        '29_S',
        '29_M',
        '30_S',
        '30_M',
        '31_S',
        '31_M',
    ];
    // Definisikan metode untuk mengambil data dari hari sebelumnya
    public function yesterday()
    {
        return $this->where('tanggal', now()->subDay()->toDateString());
    }

    // Definisikan metode untuk mengambil data dari dua hari sebelumnya
    public function dayBeforeYesterday()
    {
        return $this->where('tanggal', now()->subDays(2)->toDateString());
    }
}
