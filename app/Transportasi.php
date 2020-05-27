<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transportasi extends Model
{
    protected $table = 't_transportasi';
    public $timestamps = false;
    protected $fillable = ['transportasi'];

    public function pendaftar(){
        return $this->belongsTo('App\Pendaftar')->withDefault();
    }
}
