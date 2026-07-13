<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Anak extends Model
{

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
