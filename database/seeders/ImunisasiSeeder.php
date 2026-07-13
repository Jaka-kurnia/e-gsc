<?php

namespace Database\Seeders;

use App\Models\Imunisasi;
use Illuminate\Database\Seeder;

class ImunisasiSeeder extends Seeder
{
    public function run(): void
    {
        $imunisasis = [
            [
                'kode_imunisasi' => 'IMN-001',
                'nama_imunisasi' => 'Hepatitis B (HB-0)',
                'deskripsi' => 'Imunisasi Hepatitis B dosis pertama, diberikan saat bayi baru lahir',
            ],
            [
                'kode_imunisasi' => 'IMN-002',
                'nama_imunisasi' => 'Polio Tetes (bOPV-1)',
                'deskripsi' => 'Imunisasi Polio tetes dosis pertama, diberikan saat usia 1 bulan',
            ],
            [
                'kode_imunisasi' => 'IMN-003',
                'nama_imunisasi' => 'BCG',
                'deskripsi' => 'Imunisasi untuk mencegah TBC, diberikan saat usia 1 bulan',
            ],
            [
                'kode_imunisasi' => 'IMN-004',
                'nama_imunisasi' => 'DPT-HB-Hib 1',
                'deskripsi' => 'Imunisasi kombinasi DPT, Hepatitis B, dan Hib dosis pertama',
            ],
            [
                'kode_imunisasi' => 'IMN-005',
                'nama_imunisasi' => 'Polio Tetes (bOPV-2)',
                'deskripsi' => 'Imunisasi Polio tetes dosis kedua, diberikan saat usia 2 bulan',
            ],
            [
                'kode_imunisasi' => 'IMN-006',
                'nama_imunisasi' => 'Polio Suntik (IPV-1)',
                'deskripsi' => 'Imunisasi Polio suntik dosis pertama',
            ],
            [
                'kode_imunisasi' => 'IMN-007',
                'nama_imunisasi' => 'DPT-HB-Hib 2',
                'deskripsi' => 'Imunisasi kombinasi DPT, Hepatitis B, dan Hib dosis kedua',
            ],
            [
                'kode_imunisasi' => 'IMN-008',
                'nama_imunisasi' => 'Polio Tetes (bOPV-3)',
                'deskripsi' => 'Imunisasi Polio tetes dosis ketiga',
            ],
            [
                'kode_imunisasi' => 'IMN-009',
                'nama_imunisasi' => 'DPT-HB-Hib 3',
                'deskripsi' => 'Imunisasi kombinasi DPT, Hepatitis B, dan Hib dosis ketiga',
            ],
            [
                'kode_imunisasi' => 'IMN-010',
                'nama_imunisasi' => 'Polio Suntik (IPV-2)',
                'deskripsi' => 'Imunisasi Polio suntik dosis kedua',
            ],
            [
                'kode_imunisasi' => 'IMN-011',
                'nama_imunisasi' => 'Campak Rubela (MR-1)',
                'deskripsi' => 'Imunisasi Campak dan Rubela dosis pertama',
            ],
            [
                'kode_imunisasi' => 'IMN-012',
                'nama_imunisasi' => 'DPT-HB-Hib Lanjutan',
                'deskripsi' => 'Imunisasi lanjutan DPT, Hepatitis B, dan Hib',
            ],
            [
                'kode_imunisasi' => 'IMN-013',
                'nama_imunisasi' => 'Campak Rubela (MR-2)',
                'deskripsi' => 'Imunisasi Campak dan Rubela dosis kedua (lanjutan)',
            ],
            [
                'kode_imunisasi' => 'IMN-014',
                'nama_imunisasi' => 'Polio Tetes (bOPV-4)',
                'deskripsi' => 'Imunisasi Polio tetes dosis keempat (lanjutan)',
            ],
            [
                'kode_imunisasi' => 'IMN-015',
                'nama_imunisasi' => 'JE (Japanese Encephalitis)',
                'deskripsi' => 'Imunisasi untuk mencegah radang otak akibat virus JE',
            ],
            [
                'kode_imunisasi' => 'IMN-016',
                'nama_imunisasi' => 'Td (Tetanus Difteri)',
                'deskripsi' => 'Imunisasi lanjutan Tetanus dan Difteri untuk anak sekolah',
            ],
            [
                'kode_imunisasi' => 'IMN-017',
                'nama_imunisasi' => 'HPV-1',
                'deskripsi' => 'Imunisasi Human Papillomavirus dosis pertama untuk mencegah kanker serviks',
            ],
            [
                'kode_imunisasi' => 'IMN-018',
                'nama_imunisasi' => 'HPV-2',
                'deskripsi' => 'Imunisasi Human Papillomavirus dosis kedua',
            ],
            [
                'kode_imunisasi' => 'IMN-019',
                'nama_imunisasi' => 'Rotavirus',
                'deskripsi' => 'Imunisasi untuk mencegah diare berat akibat infeksi Rotavirus',
            ],
            [
                'kode_imunisasi' => 'IMN-020',
                'nama_imunisasi' => 'Influenza',
                'deskripsi' => 'Imunisasi untuk mencegah flu musiman',
            ],
        ];

        foreach ($imunisasis as $imunisasi) {
            Imunisasi::create($imunisasi);
        }
    }
}
