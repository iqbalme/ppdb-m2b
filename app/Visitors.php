<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Visitors extends Model
{
    protected $table = 't_visitors';
    //public $timestamps = false;
    protected $fillable = ['ip'];

}
