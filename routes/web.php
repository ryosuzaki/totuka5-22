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

Route::get('/home', 'HomeController@index')->name('home');

//
Route::post('group/{group}/uploadImg', 'Group\UploadController@uploadImg')->name('group.uploadImg');
Route::delete('group/{group}/deleteImg', 'Group\UploadController@deleteImg')->name('group.deleteImg');
//
Route::get('group/map', 'Group\MapController@map')->name('group.map');
//
Route::get('group/{group}/location/edit', 'Group\GroupLocationController@edit')->name('group.location.edit');
Route::put('group/{group}/location', 'Group\GroupLocationController@update')->name('group.location.update');

//
Route::get('group/{group}/like', 'Group\LikeController@like')->name('group.like');
Route::get('group/{group}/unlike', 'Group\LikeController@unlike')->name('group.unlike');
//
Route::get('group/{group}/watch', 'Group\WatchController@watch')->name('group.watch');
Route::get('group/{group}/unwatch', 'Group\WatchController@unwatch')->name('group.unwatch');





//
Route::get('group/create/{type}', 'Group\GroupController@create')->name('group.create');
Route::get('group/{group}/show/{index?}', 'Group\GroupController@show')->name('group.show');
Route::resource('group', 'Group\GroupController',['except' => [
    'create','show'
]]);

//
Route::resource('group.role', 'Group\RoleController',['except' => [
]]);
//
Route::get('group/{group}/permission/{role}/edit', 'Group\PermissionController@edit')->name('group.permission.edit');
Route::put('group/{group}/permission/{role}', 'Group\PermissionController@update')->name('group.permission.update');
//
Route::get('group/{group}/user/index/{index?}', 'Group\GroupUserController@index')->name('group.user.index');
Route::get('group/{group}/user/create/{index}', 'Group\GroupUserController@create')->name('group.user.create');
Route::get('group/{group}/user/{user}/show/{index}', 'Group\GroupUserController@show')->name('group.user.show');
Route::post('group/{group}/user/{index}', 'Group\GroupUserController@store')->name('group.user.store');
Route::delete('group/{group}/user/{user}/{index}', 'Group\GroupUserController@destroy')->name('group.user.destroy');


//
Route::get('group/{group}/info/{index}/edit', 'Group\GroupInfoController@edit')->name('group.info.edit');
Route::put('group/{group}/info/{index}', 'Group\GroupInfoController@update')->name('group.info.update');
    




//user
//ログインユーザのみのアクセスにするため
Route::get('user', 'UserController@show')->name('user.show');
Route::get('user/edit', 'UserController@edit')->name('user.edit');
Route::put('user', 'UserController@update')->name('user.update');

Route::get('user/setting', 'UserController@settingForm')->name('user.setting_form');
Route::post('user/setting', 'UserController@setting')->name('user.setting');

//info_base info
Route::get('info_base/{info_base}/info/edit', 'Info\InfoController@edit')->name('info_base.info.edit');
Route::put('info_base/{info_base}/info', 'Info\InfoController@update')->name('info_base.info.update');

//
Route::resource('group.info_base', 'Group\GroupInfoBaseController');

//
Route::resource('info_template', 'Info\InfoTemplateController');


//
Route::get('user/group', 'UserGroupController@index')->name('user.group.index');
Route::get('user/group/create', 'UserGroupController@create')->name('user.group.create');
Route::post('user/group', 'UserGroupController@store')->name('user.group.store');
Route::get('user/group/{group}/edit', 'UserGroupController@edit')->name('user.group.edit');
Route::put('user/group/{group}', 'UserGroupController@update')->name('user.group.update');
Route::delete('user/group/{group}', 'UserGroupController@destroy')->name('user.group.destroy');

Route::get('user/group/{group}/accept_join_request', 'UserGroupController@acceptJoinRequest')->name('user.group.accept_join_request');
Route::get('user/group/{group}/denied_join_request', 'UserGroupController@deniedJoinRequest')->name('user.group.denied_join_request');

//
Route::get('user/info_base', 'UserInfoBaseController@index')->name('user.info_base.index');
Route::get('user/info_base/create', 'UserInfoBaseController@create')->name('user.info_base.create');
Route::post('user/info_base', 'UserInfoBaseController@store')->name('user.info_base.store');
Route::get('user/info_base/{info_base}/edit', 'UserInfoBaseController@edit')->name('user.info_base.edit');
Route::put('user/info_base/{info_base}', 'UserInfoBaseController@update')->name('user.info_base.update');
Route::delete('user/info_base/{info_base}', 'UserInfoBaseController@destroy')->name('user.info_base.destroy');


Route::resource('user.answer','Questionnaire\AnswerController',['except' => [
]]);




    

