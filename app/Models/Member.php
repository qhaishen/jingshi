<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    protected $table = 'members';

    protected $fillable = ['openid','session_key','nickname','avatar','country','province','city','language','phone'];

    protected $guarded = ['id'];


}
