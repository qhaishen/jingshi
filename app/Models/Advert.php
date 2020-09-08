<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Advert extends Model
{

    protected $table = 'carousels';
    
    protected $fillable = ['title','desc','thumb','sort'];

    public $timestamps = false;
   

}
