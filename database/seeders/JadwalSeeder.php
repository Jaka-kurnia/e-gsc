<?php

namespace Database\Seeders;

use App\Models\Jadwal;
use Illuminate\Database\Seeder;

class JadwalSeeder extends Seeder
{
    public function run(): void
    {
        $jadwals = [
            [
                'tanggal_kegiatan' => '2026-01-10',
                'nama_kegiatan' => 'Posyandu Melati - Imunisasi HB-0 & BCG',
                'status_logistik' => 'Siap',
                'catatan' => 'Lokasi di Balai RW 01, dimulai pukul 08.00 WIB',
            ],
            [
                'tanggal_kegiatan' => '2026-01-24',
                'nama_kegiatan' => 'Posyandu Mawar - Imunisasi Polio 1',
                'status_logistik' => 'Siap',
                'catatan' => 'Lokasi di Posyandu Mawar RW 02',
            ],
            [
                'tanggal_kegiatan' => '2026-02-07',
                'nama_kegiatan' => 'Sosialisasi Imunisasi DPT-HB-Hib 1',
                'status_logistik' => 'Belum Siap',
                'catatan' => 'Mengundang kader posyandu se-Kelurahan Sukamaju',
            ],
            [
                'tanggal_kegiatan' => '2026-02-21',
                'nama_kegiatan' => 'Imunisasi Massal - DPT-HB-Hib 1 & Polio 2',
                'status_logistik' => 'Siap',
                'catatan' => 'Bekerja sama dengan Puskesmas Sukamaju',
            ],
            [
                'tanggal_kegiatan' => '2026-03-07',
                'nama_kegiatan' => 'Posyandu Anggrek - Imunisasi IPV 1',
                'status_logistik' => 'Belum Siap',
                'catatan' => 'Butuh tambahan vaksin IPV dari puskesmas',
            ],
            [
                'tanggal_kegiatan' => '2026-03-21',
                'nama_kegiatan' => 'Kegiatan Bulan Imunisasi Anak Sekolah (BIAS)',
                'status_logistik' => 'Siap',
                'catatan' => 'Target: SDN Sukamaju 1 dan SDN Sukamaju 2',
            ],
            [
                'tanggal_kegiatan' => '2026-04-04',
                'nama_kegiatan' => 'Posyandu Melati - Imunisasi DPT-HB-Hib 2',
                'status_logistik' => 'Siap',
                'catatan' => '',
            ],
            [
                'tanggal_kegiatan' => '2026-04-18',
                'nama_kegiatan' => 'Penyuluhan Gizi dan Imunisasi',
                'status_logistik' => 'Belum Siap',
                'catatan' => 'Materi: pentingnya imunisasi lengkap untuk balita',
            ],
            [
                'tanggal_kegiatan' => '2026-05-02',
                'nama_kegiatan' => 'Imunisasi MR-1 (Campak Rubela)',
                'status_logistik' => 'Siap',
                'catatan' => 'Sasaran bayi usia 9 bulan',
            ],
            [
                'tanggal_kegiatan' => '2026-05-16',
                'nama_kegiatan' => 'Posyandu Mawar - Imunisasi DPT-HB-Hib 3',
                'status_logistik' => 'Siap',
                'catatan' => '',
            ],
            [
                'tanggal_kegiatan' => '2026-06-06',
                'nama_kegiatan' => 'Imunisasi Kejar (Outreach)',
                'status_logistik' => 'Belum Siap',
                'catatan' => 'Menjangkau anak yang belum lengkap imunisasinya di daerah terpencil',
            ],
            [
                'tanggal_kegiatan' => '2026-06-20',
                'nama_kegiatan' => 'Posyandu Anggrek - Imunisasi IPV 2',
                'status_logistik' => 'Siap',
                'catatan' => '',
            ],
            [
                'tanggal_kegiatan' => '2026-07-04',
                'nama_kegiatan' => 'Pelatihan Kader Imunisasi',
                'status_logistik' => 'Belum Siap',
                'catatan' => 'Peserta: 30 kader posyandu se-Kecamatan',
            ],
            [
                'tanggal_kegiatan' => '2026-07-18',
                'nama_kegiatan' => 'Imunisasi MR-2 (Campak Rubela Lanjutan)',
                'status_logistik' => 'Siap',
                'catatan' => 'Sasaran balita usia 18-24 bulan',
            ],
            [
                'tanggal_kegiatan' => '2026-08-01',
                'nama_kegiatan' => 'Posyandu Melati - Imunisasi JE',
                'status_logistik' => 'Belum Siap',
                'catatan' => 'Menunggu distribusi vaksin JE dari Dinas Kesehatan',
            ],
            [
                'tanggal_kegiatan' => '2026-08-15',
                'nama_kegiatan' => 'Kegiatan BIAS - Imunisasi Td & HPV',
                'status_logistik' => 'Siap',
                'catatan' => 'Sasaran: siswi SD kelas 5 dan 6',
            ],
            [
                'tanggal_kegiatan' => '2026-09-05',
                'nama_kegiatan' => 'Posyandu Mawar - Imunisasi Lanjutan',
                'status_logistik' => 'Belum Siap',
                'catatan' => 'Meliputi DPT-HB-Hib lanjutan dan Polio 4',
            ],
            [
                'tanggal_kegiatan' => '2026-09-19',
                'nama_kegiatan' => 'Evaluasi Program Imunisasi Semester 1',
                'status_logistik' => 'Siap',
                'catatan' => 'Bertempat di Aula Puskesmas Sukamaju',
            ],
            [
                'tanggal_kegiatan' => '2026-10-03',
                'nama_kegiatan' => 'Imunisasi Rotavirus (Tahap 1)',
                'status_logistik' => 'Belum Siap',
                'catatan' => 'Program baru, perlu sosialisasi terlebih dahulu',
            ],
            [
                'tanggal_kegiatan' => '2026-10-17',
                'nama_kegiatan' => 'Peringatan Pekan Imunisasi Nasional',
                'status_logistik' => 'Siap',
                'catatan' => 'Kegiatan serentak di seluruh posyandu kelurahan',
            ],
        ];

        foreach ($jadwals as $jadwal) {
            Jadwal::create($jadwal);
        }
    }
}
