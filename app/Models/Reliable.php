<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reliable extends Model
{
    protected $table = 'reliable';

    protected $fillable = ['openid', 'tid', 'date'];

    public $timestamps = false;
}
