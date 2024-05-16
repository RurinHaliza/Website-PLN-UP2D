<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use App\Models\trafo;

class TrafoExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return trafo::orderBy('id','ASC')->select('id','Nama_GI','TRAFO','ID_TRAFO','ID_KELAS','KD_PEMILIK','KD_PENGELOLA','TINGKAT_RESIKO','STATUS')->get();
    }

    public function headings(): array
    {
        return ["id", "Nama GI", "TRAFO","ID TRAFO", "ID KELAS","KD_PEMILIK","KD_PENGELOLA", "TINGKAT RESIKO", "STATUS"];
    }

}
