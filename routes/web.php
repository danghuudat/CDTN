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

Route::get('/', function () {
    return view('welcome');
});
Route::get('login','Admin\LogController@getLogin');
Route::group(['prefix'=>'admin'],function (){
    route::get('/',function (){
        return view('backend.dashboard');
    });//
    Route::group(['prefix'=>'user'],function (){
        Route::get('/','Admin\UserController@index');
        Route::get('/data','Admin\UserController@getData');

    });
//
});
