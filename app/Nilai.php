<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Nilai extends Model
{
    public $fillable = [
        'mahasiswa_id', 'tahun_ajaran_id', 'ganjil_genap',
        'IPK', 'IPS', 'cluster'
    ];

    public function tahun_ajaran()
    {
        return $this->belongsTo(TahunAjaran::class);
    }

    public static function ganjil_genap()
    {
        return ['GANJIL', 'GENAP'];
    }
}
