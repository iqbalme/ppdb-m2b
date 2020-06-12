<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TahunAjaran extends Model
{
	protected $table = 't_tahun_ajaran';
    public $timestamps = false;
    protected $fillable = ['tahun_ajaran'];

    public function pendaftar(){
        return $this->belongsTo('App\Pendaftar')->withDefault();
    }
}
