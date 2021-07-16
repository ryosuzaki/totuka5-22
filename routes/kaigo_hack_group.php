<?php

//
Route::post('group/{group}/uploadImg', 'Group\Components\UploadController@uploadImg')->name('group.uploadImg');
Route::delete('group/{group}/deleteImg', 'Group\Components\UploadController@deleteImg')->name('group.deleteImg');
//
Route::get('group/map', 'Group\Components\MapController@map')->name('group.map');
//
Route::get('group/{group}/location/edit', 'Group\GroupLocationController@edit')->name('group_location.edit');
Route::put('group/{group}/location', 'Group\GroupLocationController@update')->name('group_location.update');

//
Route::get('group/{group}/like', 'Group\Components\LikeController@like')->name('group.like');
Route::get('group/{group}/unlike', 'Group\Components\LikeController@unlike')->name('group.unlike');
//
Route::get('group/{group}/watch', 'Group\Components\WatchController@watch')->name('group.watch');
Route::get('group/{group}/unwatch', 'Group\Components\WatchController@unwatch')->name('group.unwatch');
//
Route::get('group/{group}/user/{user}/rescue', 'Group\Components\RescueController@rescue')->name('group.user.rescue');
Route::get('group/{group}/user/{user}/unrescue', 'Group\Components\RescueController@unrescue')->name('group.user.unrescue');
Route::get('group/{group}/user/{user}/rescued', 'Group\Components\RescueController@rescued')->name('group.user.rescued');





//
Route::get('group/create/{type}', 'Group\GroupController@create')->name('group.create');
Route::get('group/{group}/show/{index?}', 'Group\GroupController@show')->name('group.show');
Route::resource('group', 'Group\GroupController',['except' => ['create','show']]);
//
Route::resource('group.role', 'Group\Components\RoleController',['except' => [
]]);
//
Route::get('group/{group}/permission/{index}/edit', 'Group\Components\PermissionController@edit')->name('group.permission.edit');
Route::put('group/{group}/permission/{index}', 'Group\Components\PermissionController@update')->name('group.permission.update');
//
Route::get('group/{group}/user/index/{index?}', 'Group\GroupUserController@index')->name('group.user.index');
Route::get('group/{group}/user/create/{index}', 'Group\GroupUserController@create')->name('group.user.create');
Route::post('group/{group}/user/{index}', 'Group\GroupUserController@store')->name('group.user.store');
Route::post('group/{group}/user/{index}/store_by_csv', 'Group\GroupUserController@storeByCsv')->name('group.user.store_by_csv');
Route::get('group/{group}/user/{user}/show/{index}', 'Group\GroupUserController@show')->name('group.user.show');
Route::delete('group/{group}/user/{user}/{index}', 'Group\GroupUserController@destroy')->name('group.user.destroy');
//
Route::get('group/{group}/user/{user}/quit_request_join/{index}', 'Group\GroupUserController@quitRequestJoin')->name('group.user.quit_request_join');


//
Route::get('group/{group}/info/{index}/edit', 'Group\GroupInfoController@edit')->name('group.info.edit');
Route::put('group/{group}/info/{index}', 'Group\GroupInfoController@update')->name('group.info.update');
    
//
Route::resource('group.info_base', 'Group\GroupInfoBaseController');

