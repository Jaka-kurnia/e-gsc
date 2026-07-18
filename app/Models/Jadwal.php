<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Models\Concerns\LogsActivity;
use Spatie\Activitylog\Support\LogOptions;

class Jadwal extends Model
{
    use HasFactory, LogsActivity;

    protected $table = 'jadwals';

    protected $fillable = [
        'tanggal_kegiatan',
        'nama_kegiatan',
        'status_logistik',
        'catatan',
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logAll()
            ->logOnlyDirty();
    }

    public function pemeriksaans()
    {
        return $this->hasMany(Pemeriksaan::class, 'jadwal_id');
    }
}
