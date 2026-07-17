<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PemeriksaanMedis extends Model
{
    protected $table = 'pemeriksaan_medis';
    protected $primaryKey = 'pemeriksaan_id';
    public $incrementing = false;
    protected $keyType = 'int';

    protected $fillable = [
        'pemeriksaan_id',
        'user_id',
        'pemberian_vitamin',
        'pemberian_obat_cacing',
        'status_rujukan_medis',
        'catatan',
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
