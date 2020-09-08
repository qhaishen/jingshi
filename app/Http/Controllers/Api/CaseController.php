<?php

namespace App\Http\Controllers\Api;

use App\Models\Article;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CaseController extends Controller
{	

	/**
	 * 获取案例列表api
	 * 
	 * @return json
	 */
    public function caseList()
    {
    	$data = Article::orderBy('id','desc')->get();
    	return response()->json(['code'=>0 , 'data'=>$data]);
    }


    /**
     * 获取案例详情api
     * 
     * @param  int  $id 
     * @return  json     [description]
     */
    public function caseDetails($id)
    {
		$article = Article::find($id);
    	if($article){
			$article['content'] = str_replace('<img src="/uploads/','<img src="https://trepang.top/uploads/',$article['content']);
			$article['content'] = str_replace('<img','<img style="max-width:100%;height:auto;display:block"',$article['content']);
    		return response()->json(['code'=>0 , 'data'=>$article]);
    	}else {
    		return response()->json(['code'=> 1, 'msg'=>'未找到此文章！']);
    	}
    	
    }
}
