<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Angkatan extends Model
{
    public $fillable = [
        'tahun'
    ];

    public function mahasiswas()
    {
        return $this->hasMany(Mahasiswa::class);
    }
}
