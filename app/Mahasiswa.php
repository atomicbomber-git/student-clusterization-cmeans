<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    public $fillable = [
        'NIM', 'angkatan_id'
    ];

    public function angkatan()
    {
        return $this->belongsTo(Angkatan::class);
    }

    public function nilais()
    {
        return $this->hasMany(Nilai::class);
    }

    public function nilai()
    {
        return $this->hasOne(Nilai::class);
    }
}
