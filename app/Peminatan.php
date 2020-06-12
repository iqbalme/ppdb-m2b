<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Peminatan extends Model
{
    protected $table = 't_peminatan';
    public $timestamps = false;
    protected $guarded  = [];

    public function peminatan_siswa(){
        return $this->hasMany('App\PeminatanSiswa');
    }
}
