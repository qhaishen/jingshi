<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


//API



Route::group(['namespace' => 'Api'], function () {

	//获取公司基本配置信息
	Route::get('config','ConfigController@site');

	//获取首页轮播图列表api
	Route::get('carousel','ConfigController@carousel');
	
	Route::any('uploader', 'UploadImgController@index');
    
    //获取首页最新资讯
    Route::post('getIndexCase', 'ConfigController@getIndexCase');

    //获取首页推荐成员
    Route::post('getIndexMember', 'ConfigController@getIndexMember');

    //用户登陆api
    Route::post('login', "LoginController@login");


    /**
     * 团队列表api
     */
    
    //团队列表api
    Route::get('team','TeamController@index');

    //获取某个成员详情api
    Route::get('team/{id}','TeamController@memberDetails');

    //获取所有浏览
    Route::post('browseTotal','TeamController@browseTotal');

    //添加浏览记录
    Route::post('browseMembers','TeamController@browseMembers');

    //进行靠谱点击
    Route::post('reliable','TeamController@reliable');


    //靠谱总数
    Route::post('reliableTotal','TeamController@reliableTotal');
    /**
     * 典型案例api
     */
    
    //案例列表api
    Route::get('caseList','CaseController@caseList');

    //获取某个案例详情api
    Route::get('caseDetails/{id}','CaseController@caseDetails');

    //留言api
    Route::post('messages','MessageController@messages');

    //发布动态
    Route::post('issueCircle', 'CircleController@issueCircle');

    //获取用户是否拥有发布动态权限
    Route::post('getPermissions', 'CircleController@permissions');

    //获取动态列表
    
    Route::post('getCircleList', 'CircleController@getCircleList');

    //获取单条动态详情
    Route::post('circleAsComments', 'CircleController@circleAsComments');

    //获取单条动态的所有评论列表
    Route::post('deltetCircle', 'CircleController@deltetCircle');

    //删除评论
    Route::post('deleteComments', 'CircleController@deleteComments');

    //删除动态
    Route::post('getCircleAllComments', 'CircleController@getCircleAllComments');

    //某条动态所有评论列表
    Route::post('commentsList', 'CircleController@commentsList');

    //某条评论的详细信息
    Route::post('commentsToUser', 'CircleController@commentsToUser');

    //获取某条动态下的所有回复列表
    Route::post('commentsReplyList', 'CircleController@commentsReplyList');

    //添加评论
    Route::put('addItional', 'CircleController@addItional');

    //操作点赞
    Route::post('praiseHandle', 'PraiseController@praiseHandle');

    //判断某个动态的点赞状态
    Route::post('confirmPraise', 'PraiseController@confirmPraise');


    Route::post('myPraiseTotal', 'PraiseController@myPraiseTotal');

    Route::post('myPraise', 'PraiseController@myPraise');
});
