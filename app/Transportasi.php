<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transportasi extends Model
{
    protected $table = 't_transportasi';
    public $timestamps = false;
    protected $fillable = ['transportasi'];

    public function pendaftar(){
        return $this->hasManyThrough('App\Pendaftar', 'App\TahunAjaranPendaftar', 'tahun_ajaran_id', 'pendaftar_id');
    }
}
