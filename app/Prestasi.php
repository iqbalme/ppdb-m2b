<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Prestasi extends Model
{
    protected $table = 't_prestasi_non_akademik';
    public $timestamps = false;
    protected $guarded = [];

    public function pendaftar(){
        return $this->belongsTo('App\Pendaftar');
    }
	
}
