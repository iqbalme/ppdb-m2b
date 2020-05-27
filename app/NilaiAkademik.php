<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NilaiAkademik extends Model
{
    protected $table = 't_nilai_akademik';
    public $timestamps = false;
    protected $guarded = [];

    public function pendaftar(){
        return $this->belongsTo('App\Pendaftar');
    }
	
}
