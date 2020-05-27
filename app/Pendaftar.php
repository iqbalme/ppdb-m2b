<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pendaftar extends Model
{
    protected $table = 't_pendaftar';
    //public $timestamps = false;
    protected $guarded = [];

	public function agama(){
        return $this->hasOne('App\Agama');
    }
	
	public function hobi(){
        return $this->hasOne('App\Hobi');
    }	
	
	public function cita_cita(){
        return $this->hasOne('App\CitaCita');
    }	
	
	public function data_pendaftar(){
        return $this->hasOne('App\DataPendaftar');
    }
	
	public function nilai_akademik(){
        return $this->hasMany('App\NilaiAkademik');
    }
	
	public function prestasi_non_akademik(){
        return $this->hasMany('App\Prestasi');
    }
	
	public function lampiran(){
        return $this->hasMany('App\Lampiran');
    }
	
	public function status_pendaftar(){
        return $this->hasOne('App\StatusPendaftar');
    }
	
}