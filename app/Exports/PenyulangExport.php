<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use App\Models\Penyulang;

class PenyulangExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Penyulang::all();
    }

    public function headings(): array
    {
        return ["id", "ID_JTM", "ID_GI","ID_TRAFOGI", "NM_JTM","NM_GI","NM_SINGKATAN", "UP3", "ULP"];
    }    

}
