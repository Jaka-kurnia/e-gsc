<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    protected $table = 'jadwals';

    protected $fillable = [
        'tanggal_kegiatan',
        'nama_kegiatan',
        'status_logistik',
        'catatan',
    ];


    public function pemeriksaans()
    {
        return $this->hasMany(Pemeriksaan::class, 'jadwal_id');
    }
}
