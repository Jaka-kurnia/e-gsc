<?php

namespace App\Exports;

use App\Models\Imunisasi;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ImunisasiExport implements FromCollection, WithHeadings, WithStyles
{
    protected $search;

    public function __construct($search = null)
    {
        $this->search = $search;
    }

    public function collection()
    {
        return Imunisasi::query()
            ->when($this->search, function ($query, $search) {
                $query->where('nama_imunisasi', 'like', "%{$search}%")
                    ->orWhere('kode_imunisasi', 'like', "%{$search}%");
            })
            ->latest()
            ->get()
            ->map(function ($item, $index) {
                return [
                    'No' => $index + 1,
                    'Kode Imunisasi' => $item->kode_imunisasi,
                    'Nama Imunisasi' => $item->nama_imunisasi,
                    'Deskripsi' => $item->deskripsi ?? '-',
                ];
            });
    }

    public function headings(): array
    {
        return ['No', 'Kode Imunisasi', 'Nama Imunisasi', 'Deskripsi'];
    }

    public function styles(Worksheet $sheet)
    {
        $sheet->getStyle('A1:D1')->applyFromArray([
            'font' => ['bold' => true, 'color' => ['rgb' => 'FFFFFF'], 'size' => 12],
            'fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '2563EB']],
            'alignment' => ['horizontal' => 'center', 'vertical' => 'center'],
        ]);

        $sheet->getStyle('A1:D' . ($sheet->getHighestRow()))
            ->getBorders()->getAllBorders()->setBorderStyle('thin');

        foreach (range('A', 'D') as $col) {
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }
    }
}
