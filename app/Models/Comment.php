<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table = 'comments';

    protected $fillable = ['circle_id','content','openid','rec_openid','parent_id','type','date'];

    public $timestamps = false;


     /**
     * 获取评论的用户信息
     */
    public function users()
    {
        return $this->hasOne('App\Models\Member','openid','openid');
    }

    public function receive()
    {
    	return $this->hasOne('App\Models\Member','openid','rec_openid');
    }
}
