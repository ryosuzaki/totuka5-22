<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

Route::get('/', function () {
    return view('home');
});

Auth::routes();

//ホーム
Route::get('/home', 'HomeController@index')->name('home');
//
Route::get('home/group_type/{group_type}', 'HomeController@groupType')->name('home.group_type');
//
Route::get('/setting', 'SettingController@index')->name('setting');

//
Route::get('announcement/markAsReadAll', 'User\Components\AnnouncementController@markAsReadAll')->name('announcement.markAsReadAll');
Route::resource('announcement', 'User\Components\AnnouncementController',['only' => [
    'index','show','destroy'
]]);



//info_base info
Route::get('info_base/{info_base}/info/edit', 'Info\InfoController@edit')->name('info_base.info.edit');
Route::put('info_base/{info_base}/info', 'Info\InfoController@update')->name('info_base.info.update');

//
Route::resource('info_template', 'Info\InfoTemplateController');


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





    

