<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Models\Concerns\LogsActivity;
use Spatie\Activitylog\Support\LogOptions;

class Imunisasi extends Model
{
    use HasFactory, LogsActivity;

    protected $table = 'imunisasis';
    protected $fillable = [
        'kode_imunisasi',
        'nama_imunisasi',
        'deskripsi',
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logAll()
            ->logOnlyDirty();
            
    }

    public function pemeriksaanMedis()
    {
        return $this->belongsToMany(PemeriksaanMedis::class, 'detail_imunisasis', 'imunisasi_id', 'pemeriksaan_medis_id', 'id', 'pemeriksaan_id');
    }
}
