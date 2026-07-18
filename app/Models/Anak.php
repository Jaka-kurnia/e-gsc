<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Models\Concerns\LogsActivity;
use Spatie\Activitylog\Support\LogOptions;

class Anak extends Model
{
    use HasFactory, LogsActivity;

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logAll()
            ->logOnlyDirty();
    }

    protected $fillable = [
        'ibu_id',
        'nik',
        'nama',
        'tanggal_lahir',
        'jenis_kelamin',
        'berat_badan',
        'tinggi_badan',
    ];

    public function ibu()
    {
        return $this->belongsTo(Ibu::class, 'ibu_id');
    }

    public function pemeriksaans()
    {
        return $this->hasMany(Pemeriksaan::class, 'anak_id');
    }
}
