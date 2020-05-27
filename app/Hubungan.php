<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hubungan extends Model
{
    protected $table = 't_hubungan';
    public $timestamps = false;
    protected $fillable = ['id', 'hubungan'];

}
