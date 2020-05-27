<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Penghasilan extends Model
{
    protected $table = 't_penghasilan';
    public $timestamps = false;
    protected $fillable = ['penghasilan'];

    public function pendaftar(){
        return $this->belongsTo('App\Pendaftar')->withDefault();
    }
}
