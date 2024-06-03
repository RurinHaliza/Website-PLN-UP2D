<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use App\Models\formdata;

class Trafo80Export implements FromCollection,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
       return formdata::where('persentertinggi', '>', 80)->select('id', 'gardu_induk', 'wilayah', 'persensiang', 'persenmalam', 'persentertinggi','no_trafo')->get();
    }

    public function headings(): array
    {
        return ["id", "Gardu Induk", "No Trafo","Wilayah", "Persen Siang","Persen Malam","Persen Malan"];
    }  

}
