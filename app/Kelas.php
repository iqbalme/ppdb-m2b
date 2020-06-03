<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    protected $table = 't_kelas';
    public $timestamps = false;
    protected $fillable = ['id', 'nama_kelas'];
	
	public function pendaftar_kelas(){
        return $this->hasMany('App\PendaftarKelas', 'kelas_id');
    }

}
