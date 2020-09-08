<?php
//文件上传接口，前后台共用
Route::post('uploadImg', 'PublicController@uploadImg')->name('uploadImg');

Route::post('uploadMp4', 'PublicController@uploadMp4')->name('uploadMp4');
//清除所有缓存
Route::any('clear', 'PublicController@clear')->name('clear');

Route::redirect('/', 'admin', 301);
//支付

