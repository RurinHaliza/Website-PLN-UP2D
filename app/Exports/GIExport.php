<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use App\Models\GITable;

class GIExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return GITable::all();
    }

    public function headings(): array
    {
        return ["id", "ID_FGI", "Nama_GI","NAMA_SINGKATAN", "KD_PEMILIK","KD_PENGELOLA","TINGKAT_RESIKO", "X", "Y"];
    }   

}
