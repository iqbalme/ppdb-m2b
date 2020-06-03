<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PendaftarKelas extends Model
{
    protected $table = 't_pendaftar_kelas';
    public $timestamps = false;
    protected $guarded = [];
	
	public function pendaftar(){
        return $this->belongsTo('App\Pendaftar');
    }
	
	public function kelas(){
        return $this->belongsTo('App\Kelas', 'kelas_id');
    }

}
