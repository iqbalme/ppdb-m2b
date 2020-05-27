<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lampiran extends Model
{
    protected $table = 't_lampiran';
    public $timestamps = false;
    protected $guarded = [];

    public function pendaftar(){
        return $this->belongsTo('App\Pendaftar');
    }
	
}
