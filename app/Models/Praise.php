<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Praise extends Model
{

	protected $table = 'praises';

    protected $fillable = ['circle_id','openid','date'];

    public $timestamps = false;
   
}
