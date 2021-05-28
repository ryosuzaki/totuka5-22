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

//グループのユーザ一覧
Route::get('group/{group}/users', 'Group\GroupController@users');
//
Route::get('group/{group}/roles', 'Group\GroupController@roles');
//
Route::post('group/{group}/uploadImg', 'Group\UploadFileController@uploadImg')->name('group.uploadImg');
//
Route::post('group/{group}/deleteImg', 'Group\UploadFileController@deleteImg')->name('group.deleteImg');
//
Route::get('group/map', 'Group\GroupController@map')->name('group.map');
//
Route::get('group/{group}/location/edit', 'Group\GroupLocationController@edit')->name('group.location.edit');
Route::put('group/{group}/location', 'Group\GroupLocationController@update')->name('group.location.update');


//
Route::get('group/{group}/info_base/{info_base}/info/edit', 'Group\GroupInfoController@edit')->name('group.info_base.info.edit');
Route::put('group/{group}/info_base/{info_base}/info', 'Group\GroupInfoController@update')->name('group.info_base.info.update');
Route::delete('group/{group}/info_base/{info_base}/info', 'Group\GroupInfoController@destroy')->name('group.info_base.info.destroy');


//
Route::get('group/{group}/user/{user}/like', 'Group\GroupUserController@like')->name('group.user.like');
Route::get('group/{group}/user/{user}/unlike', 'Group\GroupUserController@unlike')->name('group.user.unlike');


//
Route::get('user/{user}/answers', 'UserController@answers');

Route::post('user/{user}/info_base/{info_base}/attach', 'UserInfoBaseController@attach')->name('user.info_base.attach');
Route::post('user/{user}/info_base/{info_base}/detach', 'UserInfoBaseController@detach')->name('user.info_base.detach');

Route::get('user/{user}/info_base/{info_base}/info/edit', 'UserInfoController@edit')->name('user.info_base.info.edit');
Route::put('user/{user}/info_base/{info_base}/info', 'UserInfoController@update')->name('user.info_base.info.update');
Route::delete('user/{user}/info_base/{info_base}/info', 'UserInfoController@destroy')->name('user.info_base.info.destroy');





//
Route::get('group/create/{type?}', 'Group\GroupController@create')->name('group.create');
Route::resource('group', 'Group\GroupController',['except' => [
    'create'
]]);
//
Route::resource('group_info_base','Group\GroupInfoBaseController',['except' => [
]]);
//
Route::resource('group.role', 'Group\GroupRoleController',['except' => [
]]);
//
Route::resource('group.user', 'Group\GroupUserController',['except' => [
]]);
    
Route::resource('user','UserController',['except' => [
]]);

Route::resource('user_info_base','UserInfoBaseController',['except' => [
]]);

//
Route::resource('user.group', 'UserGroupController',['only' => [
    'index','show','destroy'
]]);


Route::resource('user.question.answer','Questionnaire\AnswerController',['except' => [
]]);
//
Route::resource('question','Questionnaire\QuestionController',['except' => [
]]);




    

