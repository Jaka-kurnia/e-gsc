<?php

namespace App\Exports;

use App\Models\Anak;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class AnakExport implements FromCollection, WithHeadings, WithStyles
{
    protected $search;

    public function __construct($search = null)
    {
        $this->search = $search;
    }

    public function collection()
    {
        return Anak::with('ibu')
            ->when($this->search, function ($query, $search) {
                $query->where('nama', 'like', "%{$search}%");
            })
            ->latest()
            ->get()
            ->map(function ($item, $index) {
                return [
                    'No' => $index + 1,
                    'NIK' => $item->nik,
                    'Nama Anak' => $item->nama,
                    'Nama Orang Tua' => $item->ibu->nama_ibu ?? '-',
                    'Tanggal Lahir' => $item->tanggal_lahir,
                    'Jenis Kelamin' => $item->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan',
                    'Berat Badan (kg)' => $item->berat_badan ?? '-',
                    'Tinggi Badan (cm)' => $item->tinggi_badan ?? '-',
                ];
            });
    }

    public function headings(): array
    {
        return ['No', 'NIK', 'Nama Anak', 'Nama Orang Tua', 'Tanggal Lahir', 'Jenis Kelamin', 'Berat Badan (kg)', 'Tinggi Badan (cm)'];
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
