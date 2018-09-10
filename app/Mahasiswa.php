<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    public $incrementing = false;
    public $primaryKey = 'NIM';
}
