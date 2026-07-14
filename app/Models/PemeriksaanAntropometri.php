<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PemeriksaanAntropometri extends Model
{
    protected $table = 'pemeriksaan_antropometris';
    protected $primaryKey = 'pemeriksaan_id';
    public $incrementing = false;
    protected $keyType = 'int';
    protected $fillable = [
        'pemeriksaan_id',
        'user_id',
        'berat_badan',
        'tinggi_badan',
        'lingkar_kepala',
        'tren_pertumbuhan',
        'status_gizi',
    ];

    public function pemeriksaan()
    {
        return $this->belongsTo(Pemeriksaan::class, 'pemeriksaan_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
