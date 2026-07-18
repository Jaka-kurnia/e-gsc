<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Models\Concerns\LogsActivity;
use Spatie\Activitylog\Support\LogOptions;

class PemeriksaanAntropometri extends Model
{
    use HasFactory, LogsActivity;

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
}
