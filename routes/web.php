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
    return redirect()->route('home');
});

Auth::routes();

//ホーム
Route::get('home', 'HomeController@index')->name('home');
//
Route::get('home/group_type/{group_type}', 'HomeController@groupType')->name('home.group_type');

//info_base info
Route::get('info_base/{info_base}/info/edit', 'Info\InfoController@edit')->name('info_base.info.edit');
Route::put('info_base/{info_base}/info', 'Info\InfoController@update')->name('info_base.info.update');

//
Route::resource('info_template', 'Info\InfoTemplateController');
    
