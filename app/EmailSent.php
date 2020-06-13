<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmailSent extends Model
{
    protected $table = 't_email_sent';
    protected $guarded = [];

    public function pendaftar(){
        return $this->belongsTo('App\Pendaftar', 'pendaftar_id');
    }
}
