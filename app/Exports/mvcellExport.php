<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use App\Models\mvcell;

class mvcellExport implements FromCollection,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return mvcell::all();
    }


    public function headings(): array
    {
        return ["id", "ID_CELL", "LOKASI_PENEMPATAN","NAMA_JTM", "MERK","TYPE","NO_SERI", "MERK2", "TYPE2","NO_SERI2","JENIS"];
    }  


}
