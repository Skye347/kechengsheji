<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return Redirect::to('/home');
});

// 认证路由...
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');

// 注册路由...
Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');

Route::group(['prefix'=>'api','middleware'=>'token.check'],function(){
    Route::resource('permissions','Api\PermissionController',
    ['only'=>['show']]);
    //
    Route::get('basic/getlist','Api\BasicController@GetList');
    Route::post('basic/getlistwith','Api\BasicController@GetListWith');
    Route::post('basic/edit','Api\BasicController@Edit');
    Route::resource('basic','Api\BasicController',
    ['only'=>['getlistwith','getlist','edit']]);
});

Route::group(['prefix'=>'home','middleware'=>'auth.custom'],function(){
    Route::get('/','HomeController@showHome');
    Route::get('/init',function(){
        return view('init');
    });
});
