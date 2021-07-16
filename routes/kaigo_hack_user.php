<?php

//user
//ログインユーザのみのアクセスにするため
Route::get('user', 'User\UserController@show')->name('user.show');
Route::get('user/edit', 'User\UserController@edit')->name('user.edit');
Route::put('user', 'User\UserController@update')->name('user.update');

//
Route::get('user/setting', 'User\UserController@settingForm')->name('user.setting_form');
Route::post('user/setting', 'User\UserController@setting')->name('user.setting');

//
Route::get('user/{info_base}/info/edit', 'User\UserInfoController@edit')->name('user.info.edit');
Route::put('user/{info_base}/info', 'User\UserInfoController@update')->name('user.info.update');





//
Route::get('user/group', 'User\UserGroupController@index')->name('user.group.index');
Route::get('user/group/create', 'User\UserGroupController@create')->name('user.group.create');
Route::post('user/group', 'User\UserGroupController@store')->name('user.group.store');
Route::get('user/group/{group}/edit', 'User\UserGroupController@edit')->name('user.group.edit');
Route::put('user/group/{group}', 'User\UserGroupController@update')->name('user.group.update');
Route::delete('user/group/{group}', 'User\UserGroupController@destroy')->name('user.group.destroy');
//
Route::get('user/group/{group}/accept_join_request', 'User\UserGroupController@acceptJoinRequest')->name('user.group.accept_join_request');
Route::get('user/group/{group}/denied_join_request', 'User\UserGroupController@deniedJoinRequest')->name('user.group.denied_join_request');

//
Route::get('user/info_base', 'User\UserInfoBaseController@index')->name('user.info_base.index');
Route::get('user/info_base/create', 'User\UserInfoBaseController@create')->name('user.info_base.create');
Route::post('user/info_base', 'User\UserInfoBaseController@store')->name('user.info_base.store');
Route::get('user/info_base/{info_base}/edit', 'User\UserInfoBaseController@edit')->name('user.info_base.edit');
Route::put('user/info_base/{info_base}', 'User\UserInfoBaseController@update')->name('user.info_base.update');
Route::delete('user/info_base/{info_base}', 'User\UserInfoBaseController@destroy')->name('user.info_base.destroy');