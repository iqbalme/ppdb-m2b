<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Wilayah extends Model
{
    protected $table = 't_wilayah';
    public $timestamps = false;
    protected $fillable = ['kode', 'nama'];

}
