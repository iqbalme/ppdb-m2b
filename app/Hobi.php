<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hobi extends Model
{
    protected $table = 't_hobi';
    public $timestamps = false;
    protected $fillable = ['hobi'];

    public function pendaftar(){
        return $this->hasOne('App\Pendaftar');
    }
}
