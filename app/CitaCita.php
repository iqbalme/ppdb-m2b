<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CitaCita extends Model
{
    protected $table = 't_cita_cita';
    public $timestamps = false;
    protected $fillable = ['cita_cita'];

    public function pendaftar(){
        return $this->belongsTo('App\Pendaftar')->withDefault();
    }
}
