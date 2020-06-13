<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmailToSend extends Model
{
    protected $table = 't_email_to_send';
    protected $guarded = [];

    public function pendaftar(){
        return $this->belongsTo('App\Pendaftar', 'pendaftar_id');
    }
}
