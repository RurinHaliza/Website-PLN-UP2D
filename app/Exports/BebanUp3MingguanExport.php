<?php

namespace App\Exports;

use App\Models\DataBebanRSTModel;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class BebanUp3MingguanExport implements FromView, ShouldAutoSize, WithStyles
{
    protected $feeder;
    protected $name;
    protected $tanggalMulai;
    protected $tanggalAkhir;

    public function __construct($feeder, $name, $tanggalMulai, $tanggalAkhir)
    {
        $this->feeder = $feeder;
        $this->name = $name;
        $this->tanggalMulai = $tanggalMulai;
        $this->tanggalAkhir = $tanggalAkhir;
    }

    public function view(): View
    {
        $timeColumns = [];
        for ($i = 0; $i < 24; $i++) {
            for ($j = 0; $j < 60; $j += 15) {
                if (!($i == 0 && $j == 0)) {
                    $timeColumns[] = sprintf("%02d_%02d", $i, $j);
                }
                if ($i == 23 && $j == 45) {
                    $timeColumns[] = "23_59";
                }
            }
        }

        $selects = [
            'up3',
            'gardu_induk',
            'feeder',
            'name',
        ];

        foreach ($timeColumns as $col) {
            $selects[] = \DB::raw("SUM($col) as $col");
        }

        $query = DataBebanRSTModel::where('name', $this->name)
            ->whereBetween('tanggal', [$this->tanggalMulai, $this->tanggalAkhir]);

        if ($this->feeder === 'Incoming') {
            $query->where('feeder', 'like', '%Incoming%');
        } else {
            $query->where('feeder', 'not like', '%Incoming%');
        }

        $data = $query->select($selects)
            ->groupBy('up3', 'gardu_induk', 'feeder', 'name')
            ->get();

        return view('BebanRST.bebanUP3New.exportmingguan', [
            'data' => $data,
            'tanggalMulai' => $this->tanggalMulai,
            'tanggalAkhir' => $this->tanggalAkhir,
            'feeder' => $this->feeder,
            'name' => $this->name
        ]);
    }

    public function styles(Worksheet $sheet)
    {
        $sheet->getStyle('A1:Z1')->applyFromArray([
            'font' => ['bold' => true, 'color' => ['rgb' => 'FFFFFF']],
            'fill' => ['fillType' => 'solid', 'color' => ['rgb' => '0070C0']],
            'alignment' => ['horizontal' => 'center', 'vertical' => 'center'],
        ]);

        $highestRow = $sheet->getHighestRow();
        $highestColumn = $sheet->getHighestColumn();

        $sheet->getStyle("A1:{$highestColumn}{$highestRow}")->applyFromArray([
            'borders' => ['allBorders' => ['borderStyle' => 'thin', 'color' => ['rgb' => '808080']]],
            'alignment' => ['horizontal' => 'center', 'vertical' => 'center'],
        ]);
    }
}
