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
Route::resource('group.user', 'Group\GroupUserController',['except' => [
]]);
    




//user
//ログインユーザのみのアクセスにするため
Route::get('user', 'UserController@show')->name('user.show');
Route::get('user/edit', 'UserController@edit')->name('user.edit');
Route::put('user', 'UserController@update')->name('user.update');
Route::delete('user', 'UserController@destroy')->name('user.destroy');

//info_base info
Route::get('info_base/{info_base}/info/edit', 'Info\InfoController@edit')->name('info_base.info.edit');
Route::put('info_base/{info_base}/info', 'Info\InfoController@update')->name('info_base.info.update');
Route::delete('info_base/{info_base}/info', 'Info\InfoController@destroy')->name('info_base.info.destroy');

//
Route::resource('model.info_base', 'Info\InfoBaseController',['except' => [
]]);


//
Route::get('user/group', 'UserGroupController@index')->name('user.group.index');
Route::get('user/group/create', 'UserGroupController@create')->name('user.group.create');
Route::post('user/group', 'UserGroupController@store')->name('user.group.store');
Route::get('user/group/{group}/edit', 'UserGroupController@edit')->name('user.group.edit');
Route::put('user/group/{group}', 'UserGroupController@update')->name('user.group.update');
Route::delete('user/group/{group}', 'UserGroupController@destroy')->name('user.group.destroy');

Route::get('user/group/{group}/accept_join_request', 'UserGroupController@acceptJoinRequest')->name('user.group.accept_join_request');
Route::get('user/group/{group}/denied_join_request', 'UserGroupController@deniedJoinRequest')->name('user.group.denied_join_request');




Route::resource('user.answer','Questionnaire\AnswerController',['except' => [
]]);




    

