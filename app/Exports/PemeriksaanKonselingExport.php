<?php

namespace App\Exports;

use App\Models\PemeriksaanKonseling;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class PemeriksaanKonselingExport implements FromCollection, WithHeadings, WithStyles
{
    protected $search;

    public function __construct($search = null)
    {
        $this->search = $search;
    }

    public function collection()
    {
        return PemeriksaanKonseling::with(['pemeriksaan.anak', 'pemeriksaan.jadwal', 'user'])
            ->when($this->search, function ($query, $search) {
                $query->whereHas('pemeriksaan.anak', function ($q) use ($search) {
                    $q->where('nama', 'like', "%{$search}%");
                })->orWhereHas('pemeriksaan', function ($q) use ($search) {
                    $q->where('nomor_pemeriksaan', 'like', "%{$search}%");
                });
            })
            ->latest()
            ->get()
            ->map(function ($item, $index) {
                return [
                    'No' => $index + 1,
                    'No. Pemeriksaan' => $item->pemeriksaan->nomor_pemeriksaan ?? '-',
                    'Nama Anak' => $item->pemeriksaan->anak->nama ?? '-',
                    'Catatan Konseling' => $item->konseling,
                    'Pemberian PMT' => $item->pemberian_pmt ? 'Ya' : 'Tidak',
                ];
            });
    }

    public function headings(): array
    {
        return ['No', 'No. Pemeriksaan', 'Nama Anak', 'Catatan Konseling', 'Pemberian PMT'];
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
