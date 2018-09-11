<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TahunAjaran extends Model
{
    public $incrementing = false;
    public $primaryKey = 'nama';

    public $fillable = [
        'nama'
    ];

    public function nilais()
    {
        return $this->hasMany(Nilai::class, 'tahun_ajaran');
    }
}
