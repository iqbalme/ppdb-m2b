<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StatusPendaftar extends Model
{
    protected $table = 't_status_pendaftar';
    public $timestamps = false;
    protected $guarded = [];

    public function pendaftar(){
        return $this->belongsTo('App\Pendaftar');
    }
	
}
