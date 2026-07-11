<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Imunisasi extends Model
{
    protected $table = 'imunisasis';
    protected $fillable = [
        'kode_imunisasi',
        'nama_imunisasi',
        'deskripsi',
    ];
}
