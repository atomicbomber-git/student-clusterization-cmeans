<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Nilai extends Model
{
    public static function ganjil_genap()
    {
        return ['GANJIL', 'GENAP'];
    }
}
