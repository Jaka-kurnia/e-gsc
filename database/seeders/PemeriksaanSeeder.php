<?php

namespace Database\Seeders;

use App\Models\Anak;
use App\Models\Jadwal;
use App\Models\Pemeriksaan;
use App\Models\PemeriksaanAntropometri;
use App\Models\PemeriksaanKonseling;
use App\Models\PemeriksaanMedis;
use App\Models\User;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class PemeriksaanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        $users = User::all();
        $anaks = Anak::all();
        $jadwals = Jadwal::all();

        // Jika master data kosong, hentikan seeder
        if ($users->isEmpty() || $anaks->isEmpty() || $jadwals->isEmpty()) {
            $this->command->info('Data master (User, Anak, Jadwal) masih kosong. Seeder Pemeriksaan dibatalkan.');
            return;
        }

        $vitaminTypes = ['tidak', 'vitamin_a_merah', 'vitamin_a_biru'];
        $trenPertumbuhan = ['N', 'T', 'BGM', '-'];
        $statusGizi = ['normal', 'gizi_kurang', 'gizi_buruk', 'gizi_lebih'];

        $antrianHarian = [];

        // Buat 20 record pemeriksaan dummy
        for ($i = 0; $i < 20; $i++) {
            $user = $users->random();
            $anak = $anaks->random();
            $jadwal = $jadwals->random();

            $tanggal = $faker->dateTimeBetween('2026-07-15', '2026-07-25')->format('Y-m-d');
            
            if (!isset($antrianHarian[$tanggal])) {
                $antrianHarian[$tanggal] = 1;
            } else {
                $antrianHarian[$tanggal]++;
            }

            // 1. Buat Pemeriksaan Utama
            $pemeriksaan = Pemeriksaan::create([
                'nomor_pemeriksaan' => 'PRK-' . str_replace('-', '', $tanggal) . '-' . str_pad($i + 1, 4, '0', STR_PAD_LEFT),
                'jadwal_id' => $jadwal->id,
                'anak_id' => $anak->id,
                'user_id' => $user->id,
                'approved_by' => $users->random()->id,
                'nomor_antri' => 'A-' . str_pad($antrianHarian[$tanggal], 3, '0', STR_PAD_LEFT),
                'metode_kunjungan' => $faker->randomElement(['hari_h', 'sweeping']),
                'tanggal_kunjungan' => $tanggal,
                'umur_bulan' => $faker->numberBetween(1, 60),
                'approvel_status' => 'approved',
            ]);

            // 2. Buat Pemeriksaan Antropometri
            PemeriksaanAntropometri::create([
                'pemeriksaan_id' => $pemeriksaan->id,
                'user_id' => $user->id,
                'berat_badan' => $faker->randomFloat(2, 3, 20), // 3 kg - 20 kg
                'tinggi_badan' => $faker->randomFloat(2, 50, 110), // 50 cm - 110 cm
                'lingkar_kepala' => $faker->randomFloat(2, 30, 50), // 30 cm - 50 cm
                'tren_pertumbuhan' => $faker->randomElement($trenPertumbuhan),
                'status_gizi' => $faker->randomElement($statusGizi),
            ]);

            // 3. Buat Pemeriksaan Konseling
            PemeriksaanKonseling::create([
                'pemeriksaan_id' => $pemeriksaan->id,
                'user_id' => $user->id,
                'konseling' => $faker->sentence(10),
                'pemberian_pmt' => $faker->boolean(70), // 70% chance of true
            ]);

            // 4. Buat Pemeriksaan Medis
            PemeriksaanMedis::create([
                'pemeriksaan_id' => $pemeriksaan->id,
                'user_id' => $user->id,
                'pemberian_vitamin' => $faker->randomElement($vitaminTypes),
                'pemberian_obat_cacing' => $faker->boolean(50),
                'status_rujukan_medis' => $faker->boolean(10), // 10% chance of true
                'catatan' => $faker->optional(0.7)->sentence(15), // 70% chance of having notes
            ]);
        }
    }
}
