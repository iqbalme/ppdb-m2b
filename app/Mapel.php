<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mapel extends Model
{
    protected $table = 't_mapel';
    public $timestamps = false;
    protected $fillable = ['id', 'nama_mapel'];

}
