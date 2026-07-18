<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Models\Concerns\LogsActivity;
use Spatie\Activitylog\Support\LogOptions;

class Ibu extends Model
{
    use HasFactory, LogsActivity;

    protected $table = 'ibus';
    protected $fillable = [
        'nik',
        'nama_ibu',
        'nama_ayah',
        'no_hp',
        'rt',
        'rw',
        'alamat',
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logAll()
            ->logOnlyDirty();
    }

    public function anaks()
    {
        return $this->hasMany(Anak::class, 'ibu_id');
    }
}
