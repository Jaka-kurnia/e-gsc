<?php

namespace App\Exports;

use App\Models\PemeriksaanMedis;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class PemeriksaanMedisExport implements FromCollection, WithHeadings, WithStyles
{
    protected $search;

    public function __construct($search = null)
    {
        $this->search = $search;
    }

    public function collection()
    {
        return PemeriksaanMedis::with(['pemeriksaan.anak', 'pemeriksaan.jadwal', 'user'])
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
                    'Pemberian Vitamin' => ucwords(str_replace('_', ' ', $item->pemberian_vitamin)),
                    'Pemberian Obat Cacing' => $item->pemberian_obat_cacing ? 'Ya' : 'Tidak',
                    'Status Rujukan Medis' => $item->status_rujukan_medis ? 'Ya' : 'Tidak',
                    'Catatan' => $item->catatan ?? '-',
                ];
            });
    }

    public function headings(): array
    {
        return ['No', 'No. Pemeriksaan', 'Nama Anak', 'Pemberian Vitamin', 'Pemberian Obat Cacing', 'Status Rujukan Medis', 'Catatan'];
    }

    public function styles(Worksheet $sheet)
    {
        $sheet->getStyle('A1:G1')->applyFromArray([
            'font' => ['bold' => true, 'color' => ['rgb' => 'FFFFFF'], 'size' => 12],
            'fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '2563EB']],
            'alignment' => ['horizontal' => 'center', 'vertical' => 'center'],
        ]);

        $sheet->getStyle('A1:G' . ($sheet->getHighestRow()))
            ->getBorders()->getAllBorders()->setBorderStyle('thin');

        foreach (range('A', 'G') as $col) {
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }
    }
}
