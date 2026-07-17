<?php

namespace App\Models;

use App\Models\Jadwal;
use Illuminate\Database\Eloquent\Model;

class Pemeriksaan extends Model
{
    protected $fillable = [
        'nomor_pemeriksaan',
        'jadwal_id',
        'anak_id',
        'user_id',
        'approved_by',
        'nomor_antri',
        'metode_kunjungan',
        'tanggal_kunjungan',
        'umur_bulan',
        'approvel_status',
    ];

    protected $casts = [
        'tanggal_kunjungan' => 'date',
        'umur_bulan' => 'integer',
    ];

    public function jadwal()
    {
        return $this->belongsTo(Jadwal::class, 'jadwal_id');
    }

    public function anak()
    {
        return $this->belongsTo(Anak::class, 'anak_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function approvedBy()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

    public function pemeriksaanAntropometris()
    {
        return $this->hasMany(PemeriksaanAntropometri::class, 'pemeriksaan_id');
    }

    public function pemeriksaanKonseling()
    {
        return $this->hasOne(PemeriksaanKonseling::class, 'pemeriksaan_id');
    }


    public function pemeriksaanMedis()
    {
        return $this->hasMany(PemeriksaanMedis::class, 'pemeriksaan_id');
    }
}
