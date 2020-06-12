<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TahunAjaranPendaftar extends Model
{
	protected $table = 't_tahun_ajaran_pendaftar';
    public $timestamps = false;
    protected $guarded = [];

    public function tahun_ajaran(){
        return $this->belongsTo('App\TahunAjaran', 'tahun_ajaran_id');
    }
}
