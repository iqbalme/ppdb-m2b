<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JenisTinggal extends Model
{
    protected $table = 't_jenis_tempat_tinggal';
    public $timestamps = false;
    protected $fillable = ['jenis_tempat_tinggal'];

    public function pendaftar(){
        return $this->belongsTo('App\Pendaftar')->withDefault();
    }
}
