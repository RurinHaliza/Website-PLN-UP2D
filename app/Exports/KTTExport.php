<?php

namespace App\Exports;

use App\Models\ktt;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class KTTExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return ktt::all();
    }

    public function headings(): array
    {
        return ["id", "pkey", "Station","Nama Pelanggan", "Daya","Alamat","Tanggal", "CB", "Meter", "Status Meter", "Dibuat", "Diupdate"];
    }
}
