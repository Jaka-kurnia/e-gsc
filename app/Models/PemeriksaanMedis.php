<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Models\Concerns\LogsActivity;
use Spatie\Activitylog\Support\LogOptions;

class PemeriksaanMedis extends Model
{
    use HasFactory, LogsActivity;

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

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logAll()
            ->logOnlyDirty();
    }

    public function pemeriksaan()
    {
        return $this->belongsTo(Pemeriksaan::class, 'pemeriksaan_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function imunisasis()
    {
        return $this->belongsToMany(Imunisasi::class, 'detail_imunisasis', 'pemeriksaan_medis_id', 'imunisasi_id', 'pemeriksaan_id', 'id');
    }
}
