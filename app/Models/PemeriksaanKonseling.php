<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Models\Concerns\LogsActivity;
use Spatie\Activitylog\Support\LogOptions;

class PemeriksaanKonseling extends Model
{
    use LogsActivity;

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logAll()
            ->logOnlyDirty();
    }

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

    public function pemeriksaan()
    {
        return $this->belongsTo(Pemeriksaan::class, 'pemeriksaan_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
