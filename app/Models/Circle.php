<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Circle extends Model
{

    protected $table = 'circles';

    protected $fillable = ['openid', 'content', 'date'];

    public $timestamps = false;

    /**
     * 获取动态对应图片，
     */
    public function imgs()
    {
        return $this->hasMany('App\Models\Img');
    }


    /**
     * 获取动态对应的用户
     */
    public function members()
    {
        return $this->hasOne('App\Models\Member', 'openid', 'openid');
    }


    /**
     * 获取动态对应的评论
     */
    public function comments()
    {
        return $this->hasMany('App\Models\Comment')->orderBy('date', 'desc');
    }

    /**
     * 获取动态对应的赞
     */
    public function praise()
    {
        return $this->hasMany('App\Models\Praise');
    }
}
