<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\DataBebanRSTModel;

class BebanUp3BulananExport implements FromView, WithStyles, ShouldAutoSize, WithEvents
{
    protected $feeder, $name, $filterBulan;

    public function __construct($feeder, $name, $filterBulan)
    {
        $this->feeder = $feeder;
        $this->name = $name;
        $this->filterBulan = $filterBulan;
    }

    public function view(): View
    {
        $tanggalMulai = Carbon::createFromFormat('Y-m', $this->filterBulan)->startOfMonth()->format('Y-m-d');
        $tanggalAkhir = Carbon::createFromFormat('Y-m', $this->filterBulan)->endOfMonth()->format('Y-m-d');

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
            DB::raw("'$tanggalMulai s/d $tanggalAkhir' as tanggal"),
        ];

        foreach ($timeColumns as $col) {
            $selects[] = DB::raw("SUM($col) as $col");
        }

        $query = DataBebanRSTModel::where('name', $this->name)
            ->whereBetween('tanggal', [$tanggalMulai, $tanggalAkhir]);

        if ($this->feeder === 'Incoming') {
            $query->where('feeder', 'like', '%Incoming%');
        } else {
            $query->where('feeder', 'not like', '%Incoming%');
        }

        $data = $query->select($selects)
            ->groupBy('up3', 'gardu_induk', 'feeder', 'name')
            ->get();

        return view('BebanRST.BebanUP3New.exportbulanan', [
            'data' => $data,
            'timeColumns' => $timeColumns,
            'periode' => "$tanggalMulai s/d $tanggalAkhir",
        ]);
    }

    // Styling dasar sheet
    public function styles(\PhpOffice\PhpSpreadsheet\Worksheet\Worksheet $sheet)
    {
        // Style header
        $sheet->getStyle('A1:Z1')->getFont()->setBold(true);
        $sheet->getStyle('A1:Z1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
    }

    // Event untuk styling tambahan (header, border, warna, dll)
    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();
                $highestRow = $sheet->getHighestRow();
                $highestColumn = $sheet->getHighestColumn();
                $range = "A1:{$highestColumn}{$highestRow}";

                // 🎨 Header Style
                $sheet->getStyle('A1:' . $highestColumn . '1')->applyFromArray([
                    'font' => [
                        'bold' => true,
                        'color' => ['rgb' => 'FFFFFF']
                    ],
                    'fill' => [
                        'fillType' => Fill::FILL_SOLID,
                        'startColor' => ['rgb' => '4472C4'] // biru elegan
                    ],
                    'alignment' => [
                        'horizontal' => Alignment::HORIZONTAL_CENTER,
                        'vertical' => Alignment::VERTICAL_CENTER
                    ]
                ]);

                // 🟦 Border & Alignment semua sel
                $sheet->getStyle($range)->applyFromArray([
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => Border::BORDER_THIN,
                            'color' => ['rgb' => '000000']
                        ]
                    ],
                    'alignment' => [
                        'vertical' => Alignment::VERTICAL_CENTER
                    ]
                ]);

                // 🩶 Warna bergantian untuk baris data
                for ($row = 2; $row <= $highestRow; $row++) {
                    $fillColor = ($row % 2 == 0) ? 'F2F2F2' : 'FFFFFF';
                    $sheet->getStyle("A{$row}:{$highestColumn}{$row}")->applyFromArray([
                        'fill' => [
                            'fillType' => Fill::FILL_SOLID,
                            'startColor' => ['rgb' => $fillColor]
                        ]
                    ]);
                }

                // 🧭 Auto filter di header
                $sheet->setAutoFilter("A1:" . $highestColumn . "1");
            },
        ];
    }
}
