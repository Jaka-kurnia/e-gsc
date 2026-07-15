<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PemeriksaanKonseling extends Model
{
    protected $table = 'pemeriksaan_konselings';
    protected $primaryKey = 'pemeriksaan_id';
    public $incrementing = false;
    protected $keyType = 'int';

    protected $fillable = [
        'pemeriksaan_id',
        'user_id',
        'konseling',
        'pemberian_pmt',
    ];
}
