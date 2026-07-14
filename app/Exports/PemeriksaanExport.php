<?php

namespace App\Exports;

use App\Models\Pemeriksaan;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class PemeriksaanExport implements FromCollection, WithHeadings, WithStyles
{
    protected $search;

    public function __construct($search = null)
    {
        $this->search = $search;
    }

    public function collection()
    {
        return Pemeriksaan::with(['jadwal', 'anak', 'user', 'approvedBy'])
            ->when($this->search, function ($query, $search) {
                $query->whereHas('anak', function ($q) use ($search) {
                    $q->where('nama', 'like', "%{$search}%");
                })->orWhere('nomor_antri', 'like', "%{$search}%");
            })
            ->latest()
            ->get()
            ->map(function ($item, $index) {
                return [
                    'No' => $index + 1,
                    'Nomor Pemeriksaan' => $item->nomor_pemeriksaan,
                    'Nomor Antrean' => $item->nomor_antri,
                    'Nama Anak' => $item->anak->nama ?? '-',
                    'Nama Kegiatan' => $item->jadwal->nama_kegiatan ?? '-',
                    'Metode Kunjungan' => $item->metode_kunjungan == 'hari_h' ? 'Hari H' : 'Sweeping',
                    'Tanggal Kunjungan' => $item->tanggal_kunjungan,
                    'Umur (Bulan)' => $item->umur_bulan,
                    'Status' => ucfirst($item->approvel_status),
                    'Penginput' => $item->user->name ?? '-',
                    'Verifikator' => $item->approvedBy->name ?? 'Belum Diverifikasi',
                ];
            });
    }

    public function headings(): array
    {
        return ['No', 'Nomor Pemeriksaan', 'Nomor Antrean', 'Nama Anak', 'Nama Kegiatan', 'Metode Kunjungan', 'Tanggal Kunjungan', 'Umur (Bulan)', 'Status', 'Penginput', 'Verifikator'];
    }

    public function styles(Worksheet $sheet)
    {
        $sheet->getStyle('A1:K1')->applyFromArray([
            'font' => ['bold' => true, 'color' => ['rgb' => 'FFFFFF'], 'size' => 12],
            'fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '2563EB']],
            'alignment' => ['horizontal' => 'center', 'vertical' => 'center'],
        ]);

        $sheet->getStyle('A1:K' . ($sheet->getHighestRow()))
            ->getBorders()->getAllBorders()->setBorderStyle('thin');

        foreach (range('A', 'K') as $col) {
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }
    }
}