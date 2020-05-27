<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jarak extends Model
{
    protected $table = 't_jarak';
    public $timestamps = false;
    protected $fillable = ['jarak'];

    public function pendaftar(){
        return $this->belongsTo('App\Pendaftar')->withDefault();
    }
}
