<?php
/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| 后台公共路由部分
|
*/
Route::group(['namespace'=>'Admin','prefix'=>'admin'],function (){
    //登录、注销
    Route::get('login','LoginController@showLoginForm')->name('admin.loginForm');
    Route::post('login','LoginController@login')->name('admin.login');
    Route::get('logout','LoginController@logout')->name('admin.logout');

});


/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| 后台需要授权的路由 admins
|
*/
Route::group(['namespace'=>'Admin','prefix'=>'admin','middleware'=>'auth'],function (){
    //后台布局
    Route::get('/','IndexController@layout')->name('admin.layout');
    //后台首页
    Route::get('/index','IndexController@index')->name('admin.index');
    //图标
    Route::get('icons','IndexController@icons')->name('admin.icons');
});

//系统管理
Route::group(['namespace'=>'Admin','prefix'=>'admin','middleware'=>['auth','permission:system.manage']],function (){
    //数据表格接口
    Route::get('data','IndexController@data')->name('admin.data')->middleware('permission:system.role|system.user|system.permission');
    //用户管理
    Route::group(['middleware'=>['permission:system.user']],function (){
        Route::get('user','UserController@index')->name('admin.user');
        //添加
        Route::get('user/create','UserController@create')->name('admin.user.create')->middleware('permission:system.user.create');
        Route::post('user/store','UserController@store')->name('admin.user.store')->middleware('permission:system.user.create');
        //编辑
        Route::get('user/{id}/edit','UserController@edit')->name('admin.user.edit')->middleware('permission:system.user.edit');
        Route::put('user/{id}/update','UserController@update')->name('admin.user.update')->middleware('permission:system.user.edit');
        //删除
        Route::delete('user/destroy','UserController@destroy')->name('admin.user.destroy')->middleware('permission:system.user.destroy');
        //分配角色
        Route::get('user/{id}/role','UserController@role')->name('admin.user.role')->middleware('permission:system.user.role');
        Route::put('user/{id}/assignRole','UserController@assignRole')->name('admin.user.assignRole')->middleware('permission:system.user.role');
        //分配权限
        Route::get('user/{id}/permission','UserController@permission')->name('admin.user.permission')->middleware('permission:system.user.permission');
        Route::put('user/{id}/assignPermission','UserController@assignPermission')->name('admin.user.assignPermission')->middleware('permission:system.user.permission');
    });
    //角色管理
    Route::group(['middleware'=>'permission:system.role'],function (){
        Route::get('role','RoleController@index')->name('admin.role');
        //添加
        Route::get('role/create','RoleController@create')->name('admin.role.create')->middleware('permission:system.role.create');
        Route::post('role/store','RoleController@store')->name('admin.role.store')->middleware('permission:system.role.create');
        //编辑
        Route::get('role/{id}/edit','RoleController@edit')->name('admin.role.edit')->middleware('permission:system.role.edit');
        Route::put('role/{id}/update','RoleController@update')->name('admin.role.update')->middleware('permission:system.role.edit');
        //删除
        Route::delete('role/destroy','RoleController@destroy')->name('admin.role.destroy')->middleware('permission:system.role.destroy');
        //分配权限
        Route::get('role/{id}/permission','RoleController@permission')->name('admin.role.permission')->middleware('permission:system.role.permission');
        Route::put('role/{id}/assignPermission','RoleController@assignPermission')->name('admin.role.assignPermission')->middleware('permission:system.role.permission');
    });
    //权限管理
    Route::group(['middleware'=>'permission:system.permission'],function (){
        Route::get('permission','PermissionController@index')->name('admin.permission');
        //添加
        Route::get('permission/create','PermissionController@create')->name('admin.permission.create')->middleware('permission:system.permission.create');
        Route::post('permission/store','PermissionController@store')->name('admin.permission.store')->middleware('permission:system.permission.create');
        //编辑
        Route::get('permission/{id}/edit','PermissionController@edit')->name('admin.permission.edit')->middleware('permission:system.permission.edit');
        Route::put('permission/{id}/update','PermissionController@update')->name('admin.permission.update')->middleware('permission:system.permission.edit');
        //删除
        Route::delete('permission/destroy','PermissionController@destroy')->name('admin.permission.destroy')->middleware('permission:system.permission.destroy');
    });
    //菜单管理
    Route::group(['middleware'=>'permission:system.menu'],function (){
        Route::get('menu','MenuController@index')->name('admin.menu');
        Route::get('menu/data','MenuController@data')->name('admin.menu.data');
        //添加
        Route::get('menu/create','MenuController@create')->name('admin.menu.create')->middleware('permission:system.menu.create');
        Route::post('menu/store','MenuController@store')->name('admin.menu.store')->middleware('permission:system.menu.create');
        //编辑
        Route::get('menu/{id}/edit','MenuController@edit')->name('admin.menu.edit')->middleware('permission:system.menu.edit');
        Route::put('menu/{id}/update','MenuController@update')->name('admin.menu.update')->middleware('permission:system.menu.edit');
        //删除
        Route::delete('menu/destroy','MenuController@destroy')->name('admin.menu.destroy')->middleware('permission:system.menu.destroy');
    });
});


//内容管理
Route::group(['namespace' => 'Admin', 'prefix' => 'admin', 'middleware' => ['auth', 'permission:zixun.manage']], function () {
 
    //文章管理
    Route::group(['middleware' => 'permission:zixun.article'], function () {
        Route::get('article/data', 'ArticleController@data')->name('admin.article.data');
        Route::get('article', 'ArticleController@index')->name('admin.article');
        //添加
        Route::get('article/create', 'ArticleController@create')->name('admin.article.create')->middleware('permission:zixun.article.create');
        Route::post('article/store', 'ArticleController@store')->name('admin.article.store')->middleware('permission:zixun.article.create');
        //编辑
        Route::get('article/{id}/edit', 'ArticleController@edit')->name('admin.article.edit')->middleware('permission:zixun.article.edit');
        Route::put('article/{id}/update', 'ArticleController@update')->name('admin.article.update')->middleware('permission:zixun.article.edit');
        //删除
        Route::delete('article/destroy', 'ArticleController@destroy')->name('admin.article.destroy')->middleware('permission:zixun.article.destroy');
    });
    //留言管理
    Route::group(['middleware' => 'permission:zixun.message'], function () {
        Route::get('message/data', 'MessageController@data')->name('admin.message.data');
        Route::get('message', 'MessageController@index')->name('admin.message');
        
        // //删除
        Route::delete('message/destroy', 'MessageController@destroy')->name('admin.message.destroy')->middleware('permission:zixun.message.destroy');
    });

    //动态管理管理
    Route::group(['middleware' => 'permission:zixun.circle'], function () {
        Route::get('circle/data', 'CircleController@data')->name('admin.circle.data');
        Route::get('circle', 'CircleController@index')->name('admin.circle');
        
        // //删除
        Route::delete('circle/destroy', 'CircleController@destroy')->name('admin.circle.destroy')->middleware('permission:zixun.circle.destroy');
        
        Route::get('circle/comments', 'CircleController@comments')->name('admin.circle.comments');

        Route::get('circle/commentsData', 'CircleController@commentsData')->name('admin.circle.commentsData');


        Route::delete('circle/delComments', 'CircleController@delComments')->name('admin.circle.delComments');
    
    });
});
//配置管理
Route::group(['namespace' => 'Admin', 'prefix' => 'admin', 'middleware' => ['auth', 'permission:config.manage']], function () {
    //基本信息
    Route::group(['middleware' => 'permission:config.site'], function () {
        Route::get('site', 'SiteController@index')->name('admin.site');
        Route::put('site', 'SiteController@update')->name('admin.site.update')->middleware('permission:config.site.update');
    });
 
    //轮播图管理
    Route::group(['middleware' => 'permission:config.advert'], function () {
        Route::get('advert/data', 'AdvertController@data')->name('admin.advert.data');
        Route::get('advert', 'AdvertController@index')->name('admin.advert');
        //添加
        Route::get('advert/create', 'AdvertController@create')->name('admin.advert.create')->middleware('permission:config.advert.create');
        Route::post('advert/store', 'AdvertController@store')->name('admin.advert.store')->middleware('permission:config.advert.create');
        //编辑
        Route::get('advert/{id}/edit', 'AdvertController@edit')->name('admin.advert.edit')->middleware('permission:config.advert.edit');
        Route::put('advert/{id}/update', 'AdvertController@update')->name('admin.advert.update')->middleware('permission:config.advert.edit');
        //删除
        Route::delete('advert/destroy', 'AdvertController@destroy')->name('admin.advert.destroy')->middleware('permission:config.advert.destroy');
    });
    //团队管理
    Route::group(['middleware' => 'permission:config.team'], function () {
        Route::get('team/data', 'TeamController@data')->name('admin.team.data');
        Route::get('team', 'TeamController@index')->name('admin.team');
        //添加
        Route::get('team/create', 'TeamController@create')->name('admin.team.create')->middleware('permission:config.team.create');
        Route::post('team/store', 'TeamController@store')->name('admin.team.store')->middleware('permission:config.team.create');
        //编辑
        Route::get('team/{id}/edit', 'TeamController@edit')->name('admin.team.edit')->middleware('permission:config.team.edit');
        Route::put('team/{id}/update', 'TeamController@update')->name('admin.team.update')->middleware('permission:config.team.edit');
        //删除
        Route::delete('team/destroy', 'TeamController@destroy')->name('admin.team.destroy')->middleware('permission:config.team.destroy');
    });
});
//会员管理
Route::group(['namespace' => 'Admin', 'prefix' => 'admin', 'middleware' => ['auth', 'permission:member.manage']], function () {
    //账号管理
    Route::group(['middleware' => 'permission:member.member'], function () {
        Route::get('member/data', 'MemberController@data')->name('admin.member.data');
        Route::get('member', 'MemberController@index')->name('admin.member');
        //添加
        Route::get('member/create', 'MemberController@create')->name('admin.member.create')->middleware('permission:member.member.create');
        Route::post('member/store', 'MemberController@store')->name('admin.member.store')->middleware('permission:member.member.create');
        //编辑
        Route::post('permissions', 'MemberController@permissions')->name('admin.member.permissions');
        Route::get('member/{id}/edit', 'MemberController@edit')->name('admin.member.edit')->middleware('permission:member.member.edit');
        Route::put('member/{id}/update', 'MemberController@update')->name('admin.member.update')->middleware('permission:member.member.edit');
        //删除
        Route::delete('member/destroy', 'MemberController@destroy')->name('admin.member.destroy')->middleware('permission:member.member.destroy');
    });
});
//消息管理


//测试
Route::group(['namespace' => 'Admin', 'prefix' => 'admin', 'middleware' => ['auth', 'permission:tree.manage']], function () {
 
    
    Route::group(['middleware' => 'permission:tree.test'], function () {
        Route::get('test/data', 'TestController@data')->name('admin.test.data');
        Route::get('test', 'TestController@index')->name('admin.test');

        Route::any('tree', 'TestController@showTree')->name('admin.tree');
        //添加
        Route::get('test/create', 'TestController@create')->name('admin.test.create');
        Route::post('test/store', 'TestController@store')->name('admin.test.store');
        //编辑
      
    });

    Route::group(['middleware' => 'permission:tree.enter'], function () {
        Route::get('enter/data', 'EnterController@data')->name('admin.enter.data');
        Route::get('enter', 'EnterController@index')->name('admin.enter');

   
        //添加
        Route::get('test/create', 'TestController@create')->name('admin.test.create');
        Route::post('test/store', 'TestController@store')->name('admin.test.store');
        //编辑
      
    });

    Route::group(['middleware' => 'permission:tree.enter'], function () {
        Route::get('resume/data', 'ResumeController@data')->name('admin.resume.data');
        Route::get('resume', 'ResumeController@index')->name('admin.resume');
        //添加
        Route::get('resume/{eid}/create', 'ResumeController@create')->name('admin.resume.create');
        Route::post('resume/store', 'ResumeController@store')->name('admin.resume.store');
        //删除
        Route::delete('resume/destroy', 'ResumeController@destroy')->name('admin.resume.destroy');
      
    });


    Route::group(['middleware' => 'permission:tree.enter'], function () {
        Route::get('resume/data', 'ResumeController@data')->name('admin.resume.data');
        Route::get('resume', 'ResumeController@index')->name('admin.resume');
        //添加
        Route::any('atree/create', 'TreeController@create')->name('admin.atree.create');
        Route::post('atree/store', 'TreeController@store')->name('admin.atree.store');
        //删除
        Route::delete('atree/destroy', 'TreeController@destroy')->name('admin.atree.destroy');

        Route::any('atree/{id}/edit', 'TreeController@edit')->name('admin.atree.edit');
        Route::post('atree/update', 'TreeController@update')->name('admin.atree.update');
      
    });
});


