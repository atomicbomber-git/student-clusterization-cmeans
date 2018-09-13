<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TahunAjaran extends Model
{
    public $fillable = [
        'tahun_mulai',
        'tahun_selesai'
    ];

    public function nilais()
    {
        return $this->hasMany(Nilai::class);
    }

    public function nama()
    {
        return $this->tahun_mulai . '-' . $this->tahun_selesai;
    }
}
