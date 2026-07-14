<?php

namespace App\Exports;

use App\Models\PemeriksaanAntropometri;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class PemeriksaanAntropometriExport implements FromCollection, WithHeadings, WithStyles
{
    protected $search;

    public function __construct($search = null)
    {
        $this->search = $search;
    }

    public function collection()
    {
        return PemeriksaanAntropometri::with(['pemeriksaan.anak', 'pemeriksaan.jadwal', 'user'])
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
                    'Berat Badan (kg)' => $item->berat_badan,
                    'Tinggi Badan (cm)' => $item->tinggi_badan,
                    'Lingkar Kepala (cm)' => $item->lingkar_kepala ?? '-',
                    'Tren Pertumbuhan' => $item->tren_pertumbuhan,
                    'Status Gizi' => ucwords(str_replace('_', ' ', $item->status_gizi)),
                ];
            });
    }

    public function headings(): array
    {
        return ['No', 'No. Pemeriksaan', 'Nama Anak', 'Berat Badan (kg)', 'Tinggi Badan (cm)', 'Lingkar Kepala (cm)', 'Tren Pertumbuhan', 'Status Gizi'];
    }

    public function styles(Worksheet $sheet)
    {
        $sheet->getStyle('A1:H1')->applyFromArray([
            'font' => ['bold' => true, 'color' => ['rgb' => 'FFFFFF'], 'size' => 12],
            'fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '2563EB']],
            'alignment' => ['horizontal' => 'center', 'vertical' => 'center'],
        ]);

        $sheet->getStyle('A1:H' . ($sheet->getHighestRow()))
            ->getBorders()->getAllBorders()->setBorderStyle('thin');

        foreach (range('A', 'H') as $col) {
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }
    }
}
