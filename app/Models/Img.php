<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Img extends Model
{

    protected $table = 'img';
    
    protected $fillable = ['url','circle_id'];

    public $timestamps = false;
   
    public function circle()
    {
        return $this->belongsTo('App\Models\Circle');
    }
}
