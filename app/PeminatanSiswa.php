<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PeminatanSiswa extends Model
{
    protected $table = 't_peminatan_siswa';
    public $timestamps = false;
    protected $guarded  = [];

    public function peminatan(){
        return $this->belongsTo('App\Peminatan', 'peminatan_id');
    }
	
	public function Pendaftar(){
        return $this->belongsTo('App\Pendaftar', 'pendaftar_id');
    }
}
