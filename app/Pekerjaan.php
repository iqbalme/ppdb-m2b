<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pekerjaan extends Model
{
    protected $table = 't_pekerjaan';
    public $timestamps = false;
    protected $fillable = ['pekerjaan'];

    public function pendaftar(){
        return $this->belongsTo('App\Pendaftar')->withDefault();
    }
}
