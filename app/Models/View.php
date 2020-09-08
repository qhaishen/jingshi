<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class View extends Model
{
    protected $table = 'views';

    protected $fillable = ['openid', 'tid', 'date'];

    public $timestamps = false;
}
