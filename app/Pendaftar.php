<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pendaftar extends Model
{
    protected $table = 't_pendaftar';
    //public $timestamps = false;
    protected $guarded = [];

	public function agama(){
        return $this->belongsTo('App\Agama');
    }
	
	public function hobi(){
        return $this->belongsTo('App\Hobi');
    }	
	
	public function tahun_ajaran_pendaftar(){
        return $this->hasOne('App\TahunAjaranPendaftar', 'pendaftar_id');
    }
	
	public function cita_cita(){
        return $this->belongsTo('App\CitaCita');
    }	
	
	public function data_pendaftar(){
        return $this->hasOne('App\DataPendaftar', 'pendaftar_id');
    }
	
	public function nilai_akademik(){
        return $this->hasMany('App\NilaiAkademik');
    }
	
	public function prestasi_non_akademik(){
        return $this->hasMany('App\Prestasi');
    }
	
	public function peminatan_siswa(){
        return $this->hasMany('App\PeminatanSiswa');
    }
	
	public function peminatan(){
        return $this->hasManyThrough('App\Peminatan', 'App\PeminatanSiswa', 'pendaftar_id', 'id');
    }
	
	public function lampiran(){
        return $this->hasMany('App\Lampiran');
    }
	
	public function status_pendaftar(){
        return $this->hasOne('App\StatusPendaftar', 'pendaftar_id');
    }
	
	public function pendaftar_kelas(){
        return $this->hasOne('App\PendaftarKelas');
    }
	
}