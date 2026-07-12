<?php

namespace App\Exports;

use App\Models\Jadwal;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class JadwalExport implements FromCollection, WithHeadings, WithStyles
{
    protected $search;

    public function __construct($search = null)
    {
        $this->search = $search;
    }

    public function collection()
    {
        return Jadwal::query()
            ->when($this->search, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('nama_kegiatan', 'like', "%{$search}%")
                        ->orWhere('tanggal_kegiatan', 'like', "%{$search}%")
                        ->orWhere('catatan', 'like', "%{$search}%");
                });
            })
            ->latest()
            ->get()
            ->map(function ($item, $index) {
                return [
                    'No' => $index + 1,
                    'Nama Kegiatan' => $item->nama_kegiatan,
                    'Tanggal Kegiatan' => $item->tanggal_kegiatan,
                    'Status Logistik' => $item->status_logistik,
                    'Catatan' => $item->catatan ?? '-',
                ];
            });
    }

    public function headings(): array
    {
        return ['No', 'Nama Kegiatan', 'Tanggal Kegiatan', 'Status Logistik', 'Catatan'];
    }

    public function styles(Worksheet $sheet)
    {
        $sheet->getStyle('A1:E1')->applyFromArray([
            'font' => ['bold' => true, 'color' => ['rgb' => 'FFFFFF'], 'size' => 12],
            'fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '2563EB']],
            'alignment' => ['horizontal' => 'center', 'vertical' => 'center'],
        ]);

        $sheet->getStyle('A1:E' . ($sheet->getHighestRow()))
            ->getBorders()->getAllBorders()->setBorderStyle('thin');

        foreach (range('A', 'E') as $col) {
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }
    }
}
