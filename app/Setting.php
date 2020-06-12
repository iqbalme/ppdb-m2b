<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
	protected $table = 't_setting';
    public $timestamps = false;
    protected $guarded = [];

}
