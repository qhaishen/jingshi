<?php

namespace App\Http\Controllers\Api;

use App\Models\Site;
use App\Models\Article;
use App\Models\Advert;
use App\Models\Team;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ConfigController extends Controller
{
    
	/**
	 * 获取首页轮播图api
	 * 
	 * @return json  
	 */
    public function carousel()
    {
    	$data = Advert::orderBy('sort','asc')->orderBy('id','asc')->get();
    	foreach ($data as $value) {
    		$value['thumb'] = getenv('APP_URL').$value['thumb'];
    	}
    	return $data;
    }


    /**
     * 获取公司基本配置api
     * 
     * @return json  [description]
     */
    public function site()
    {
    	$data = Site::pluck('value','key');
		$data['avatar'] = getenv('APP_URL').$data['avatar'];
		if($data['video'])
		{
			$data['video'] = getenv('APP_URL').$data['video'];
		}
		$data['filter_description'] = strip_tags($data['description']);
		$data['filter_description'] = str_replace('&nbsp;','',$data['filter_description']);
    	return $data;
    }
	
	//获取首页最新的资讯 3条数据
	public function getIndexCase()
	{
		$data = Article::orderBy('id','desc')->limit(3)->get();
		return $data;
	}


    //获取首页推荐的团队成员
	public function getIndexMember()
	{
		$data = Team::orderBy('sort','asc')->limit(2)->get();
		foreach ($data as $value) {
			$value['avatar'] = getenv('APP_URL').$value['avatar'];
			
    	}
		return $data;
	}
}
