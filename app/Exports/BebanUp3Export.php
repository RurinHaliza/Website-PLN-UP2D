<?php

namespace App\Exports;

use App\Models\DataBebanRSTModel;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class BebanUp3Export implements FromView, ShouldAutoSize, WithStyles
{
    protected $feeder;
    protected $name;
    protected $tanggal;

    public function __construct($feeder, $name, $tanggal)
    {
        $this->feeder = $feeder;
        $this->name = $name;
        $this->tanggal = $tanggal;
    }

    public function view(): View
    {
        $query = DataBebanRSTModel::where('name', $this->name)
            ->whereDate('tanggal', $this->tanggal);

        if ($this->feeder === 'Incoming') {
            $query->where('feeder', 'like', '%Incoming%');
        } else {
            $query->where('feeder', 'not like', '%Incoming%');
        }

        $data = $query->get();

        return view('BebanRST.BebanUp3New.exportharian', [
            'data' => $data,
            'tanggal' => $this->tanggal,
            'feeder' => $this->feeder,
            'name' => $this->name
        ]);
    }

    public function styles(Worksheet $sheet)
    {
        // Gaya header (baris pertama)
        $sheet->getStyle('A1:Z1')->applyFromArray([
            'font' => [
                'bold' => true,
                'color' => ['rgb' => 'FFFFFF'],
            ],
            'fill' => [
                'fillType' => 'solid',
                'color' => ['rgb' => '0070C0'],
            ],
            'alignment' => [
                'horizontal' => 'center',
                'vertical' => 'center',
            ],
        ]);

        // Gaya border untuk semua sel yang berisi data
        $highestRow = $sheet->getHighestRow();
        $highestColumn = $sheet->getHighestColumn();

        $sheet->getStyle("A1:{$highestColumn}{$highestRow}")->applyFromArray([
            'borders' => [
                'allBorders' => [
                    'borderStyle' => 'thin',
                    'color' => ['rgb' => '808080'],
                ],
            ],
            'alignment' => [
                'horizontal' => 'center',
                'vertical' => 'center',
            ],
        ]);

        return [];
    }
}
