<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Resume extends Model
{

    protected $table = 'resumes';
    
    protected $fillable = ['name','sex','title','parent_id','eid'];

   

}
