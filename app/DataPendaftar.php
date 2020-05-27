<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DataPendaftar extends Model
{
    protected $table = 't_data_pendaftar';
    public $timestamps = false;
    protected $guard = [];

    public function pendaftar(){
        return $this->belongsTo('App\Pendaftar');
    }

	public function hubungan(){
        return $this->hasOne('App\Hubungan');
    }	
	
	public function jarak(){
        return $this->hasOne('App\Jarak');
    }	
	
	public function jenis_tinggal(){
        return $this->hasOne('App\JenisTinggal');
    }
	
	public function transportasi(){
        return $this->hasOne('App\Transportasi');
    }	
	
	public function penghasilan(){
        return $this->hasOne('App\Penghasilan');
    }	
	
	public function pendidikan(){
        return $this->hasOne('App\Pendidikan');
    }		
}
