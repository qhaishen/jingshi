<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{

    protected $guarded = ['_token'];


    public function browseLimit()
    {
        return $this->hasMany('App\Models\View','tid')->limit(3)->orderBy('date', 'desc');
    }

    public function browse()
    {
        return $this->hasMany('App\Models\View','tid');
    }


    public function reliable()
    {
    	return $this->hasMany('App\Models\Reliable','tid');
    }

}

