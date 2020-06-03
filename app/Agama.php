<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Agama extends Model
{
    protected $table = 't_agama';
    public $timestamps = false;
    protected $fillable = ['agama'];

    public function pendaftar(){
        return $this->hasOne('App\Pendaftar', 'agama_id');
    }
}
