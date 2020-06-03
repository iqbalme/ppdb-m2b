<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hubungan extends Model
{
    protected $table = 't_hubungan';
    public $timestamps = false;
    protected $fillable = ['id', 'hubungan'];
	
	public function data_pendaftar(){
        //return $this->hasOne('App\DataPendaftar', 'hubungan_wali_id');
    }

}
