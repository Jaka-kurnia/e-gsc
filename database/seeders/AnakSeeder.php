<?php

namespace Database\Seeders;

use App\Models\Anak;
use Illuminate\Database\Seeder;

class AnakSeeder extends Seeder
{
    public function run(): void
    {
        $anaks = [
            [
                'ibu_id' => 1,
                'nik' => '3201010101200001',
                'nama' => 'Alif Rizali',
                'tanggal_lahir' => '2020-01-15',
                'jenis_kelamin' => 'L',
                'berat_badan' => 3.2,
                'tinggi_badan' => 48.0,
            ],
            [
                'ibu_id' => 1,
                'nik' => '3201010101200002',
                'nama' => 'Aisyah Rizali',
                'tanggal_lahir' => '2022-06-20',
                'jenis_kelamin' => 'P',
                'berat_badan' => 3.0,
                'tinggi_badan' => 47.5,
            ],
            [
                'ibu_id' => 2,
                'nik' => '3201010101200003',
                'nama' => 'Bima Sakti',
                'tanggal_lahir' => '2021-03-10',
                'jenis_kelamin' => 'L',
                'berat_badan' => 3.5,
                'tinggi_badan' => 50.0,
            ],
            [
                'ibu_id' => 3,
                'nik' => '3201010101200004',
                'nama' => 'Citra Lestari',
                'tanggal_lahir' => '2023-01-05',
                'jenis_kelamin' => 'P',
                'berat_badan' => 2.8,
                'tinggi_badan' => 45.0,
            ],
            [
                'ibu_id' => 4,
                'nik' => '3201010101200005',
                'nama' => 'Danu Prasetyo',
                'tanggal_lahir' => '2021-08-12',
                'jenis_kelamin' => 'L',
                'berat_badan' => 3.4,
                'tinggi_badan' => 49.0,
            ],
            [
                'ibu_id' => 5,
                'nik' => '3201010101200006',
                'nama' => 'Elsa Handayani',
                'tanggal_lahir' => '2022-11-30',
                'jenis_kelamin' => 'P',
                'berat_badan' => 3.1,
                'tinggi_badan' => 46.0,
            ],
            [
                'ibu_id' => 6,
                'nik' => '3201010101200007',
                'nama' => 'Fajar Rahmawan',
                'tanggal_lahir' => '2020-09-22',
                'jenis_kelamin' => 'L',
                'berat_badan' => 3.6,
                'tinggi_badan' => 51.0,
            ],
            [
                'ibu_id' => 7,
                'nik' => '3201010101200008',
                'nama' => 'Gita Suryani',
                'tanggal_lahir' => '2023-04-17',
                'jenis_kelamin' => 'P',
                'berat_badan' => 2.9,
                'tinggi_badan' => 44.5,
            ],
            [
                'ibu_id' => 8,
                'nik' => '3201010101200009',
                'nama' => 'Hadi Prayitno',
                'tanggal_lahir' => '2021-12-01',
                'jenis_kelamin' => 'L',
                'berat_badan' => 3.3,
                'tinggi_badan' => 48.5,
            ],
            [
                'ibu_id' => 9,
                'nik' => '3201010101200010',
                'nama' => 'Intan Maryati',
                'tanggal_lahir' => '2022-07-14',
                'jenis_kelamin' => 'P',
                'berat_badan' => 3.0,
                'tinggi_badan' => 46.5,
            ],
            [
                'ibu_id' => 10,
                'nik' => '3201010101200011',
                'nama' => 'Joko Purnomo',
                'tanggal_lahir' => '2020-05-08',
                'jenis_kelamin' => 'L',
                'berat_badan' => 3.7,
                'tinggi_badan' => 52.0,
            ],
            [
                'ibu_id' => 11,
                'nik' => '3201010101200012',
                'nama' => 'Kiki Amalia',
                'tanggal_lahir' => '2023-02-28',
                'jenis_kelamin' => 'P',
                'berat_badan' => 2.7,
                'tinggi_badan' => 44.0,
            ],
            [
                'ibu_id' => 12,
                'nik' => '3201010101200013',
                'nama' => 'Lutfi Hidayat',
                'tanggal_lahir' => '2021-06-19',
                'jenis_kelamin' => 'L',
                'berat_badan' => 3.5,
                'tinggi_badan' => 49.5,
            ],
            [
                'ibu_id' => 13,
                'nik' => '3201010101200014',
                'nama' => 'Mila Ratnasari',
                'tanggal_lahir' => '2022-10-03',
                'jenis_kelamin' => 'P',
                'berat_badan' => 3.2,
                'tinggi_badan' => 47.0,
            ],
            [
                'ibu_id' => 14,
                'nik' => '3201010101200015',
                'nama' => 'Nando Ardiansyah',
                'tanggal_lahir' => '2020-12-25',
                'jenis_kelamin' => 'L',
                'berat_badan' => 3.8,
                'tinggi_badan' => 53.0,
            ],
            [
                'ibu_id' => 15,
                'nik' => '3201010101200016',
                'nama' => 'Olivia Puspita',
                'tanggal_lahir' => '2023-05-11',
                'jenis_kelamin' => 'P',
                'berat_badan' => 2.9,
                'tinggi_badan' => 45.5,
            ],
            [
                'ibu_id' => 16,
                'nik' => '3201010101200017',
                'nama' => 'Panji Susanto',
                'tanggal_lahir' => '2021-09-07',
                'jenis_kelamin' => 'L',
                'berat_badan' => 3.4,
                'tinggi_badan' => 49.0,
            ],
            [
                'ibu_id' => 17,
                'nik' => '3201010101200018',
                'nama' => 'Rara Permatasari',
                'tanggal_lahir' => '2022-04-15',
                'jenis_kelamin' => 'P',
                'berat_badan' => 3.1,
                'tinggi_badan' => 46.0,
            ],
            [
                'ibu_id' => 18,
                'nik' => '3201010101200019',
                'nama' => 'Sandy Fadhillah',
                'tanggal_lahir' => '2020-08-30',
                'jenis_kelamin' => 'L',
                'berat_badan' => 3.6,
                'tinggi_badan' => 51.5,
            ],
            [
                'ibu_id' => 19,
                'nik' => '3201010101200020',
                'nama' => 'Tania Mariana',
                'tanggal_lahir' => '2023-07-22',
                'jenis_kelamin' => 'P',
                'berat_badan' => 2.8,
                'tinggi_badan' => 44.5,
            ],
        ];

        foreach ($anaks as $anak) {
            Anak::create($anak);
        }
    }
}
