<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class BebanUp3ExportAll implements FromView, ShouldAutoSize, WithStyles
{
    protected $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function view(): View
    {
        return view('BebanRST.BebanUP3New.exportall', [
            'data' => $this->data
        ]);
    }

    /**
     * Styling Header Row
     */
    public function styles(Worksheet $sheet)
    {
        return [
            1 => [ // header row ke-1
                'font' => [
                    'bold' => true,
                    'color' => ['rgb' => 'FFFFFF'] // font putih
                ],
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'startColor' => ['rgb' => '1F4E78'] // biru elegan
                ]
            ],
        ];
    }
}
