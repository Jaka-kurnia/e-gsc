<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Imunisasi extends Model
{
    protected $table = 'imunisasis';
    protected $fillable = [
        'kode_imunisasi',
        'nama_imunisasi',
        'deskripsi',
    ];

    public function pemeriksaanMedis()
    {
        return $this->belongsToMany(PemeriksaanMedis::class, 'detail_imunisasis', 'imunisasi_id', 'pemeriksaan_medis_id', 'id', 'pemeriksaan_id');
    }
}
