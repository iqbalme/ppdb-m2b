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
        return $this->belongsTo('App\Hubungan', 'hubungan_wali_id');
    }	
	
	public function jarak(){
        return $this->belongsTo('App\Jarak', 'jarak_rumah_madrasah_id');
    }	
	
	public function jenis_tinggal(){
        return $this->belongsTo('App\JenisTinggal','jenis_tempat_tinggal_id');
    }
	
	public function transportasi(){
        return $this->belongsTo('App\Transportasi');
    }	
	
	public function penghasilan(){
        return $this->belongsTo('App\Penghasilan');
    }

	public function pendidikan_ayah(){
        return $this->belongsTo('App\Pendidikan');
    }
	
	public function pekerjaan_ayah(){
        return $this->belongsTo('App\Pekerjaan');
    }
	
	public function agama_ayah(){
        return $this->belongsTo('App\Agama');
    }
	
	public function pendidikan_ibu(){
        return $this->belongsTo('App\Pendidikan');
    }
	
	public function agama_ibu(){
        return $this->belongsTo('App\Agama');
    }
	
	public function pekerjaan_ibu(){
        return $this->belongsTo('App\Pekerjaan');
    }
	
	public function pendidikan_wali(){
        return $this->belongsTo('App\Pendidikan');
    }
	
	public function pekerjaan_wali(){
        return $this->belongsTo('App\Pekerjaan');
    }
	
	public function agama_wali(){
        return $this->belongsTo('App\Agama');
    }
	
}
