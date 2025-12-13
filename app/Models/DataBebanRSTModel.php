<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataBebanRSTModel extends Model
{
    use HasFactory;

    protected $table = 'data_bebanrst';

    public function latestRecord()
    {
        return $this->hasOne(self::class, 'gardu_induk', 'gardu_induk')
            ->where('name', 'IR')
            ->whereNotIn('feeder', ['inc.01', 'inc.02', 'inc.03', 'inc.04', 'inc.05', 'inc.06', 'inc.07'])
            ->latest('id');
    }
}
