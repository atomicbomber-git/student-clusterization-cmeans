<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    public $fillable = [
        'nama', 'NIM', 'angkatan_id', 'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

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
