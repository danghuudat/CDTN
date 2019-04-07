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
Route::get('/register','Admin\LogController@getRegister');
Route::post('/postregister','Admin\LogController@postRegister');

Route::get('login','Admin\LogController@getLogin')->middleware('LoggedOut');
Route::post('postlogin','Admin\LogController@postLogin');

Route::get('logout','Admin\LogController@logout');

Route::group(['prefix'=>'admin','middleware'=>['LoggedIn','AuthOrigin']],function (){
    route::get('/',function (){
        return view('backend.dashboard');
    });//
    Route::group(['prefix'=>'user'],function (){
        Route::get('/','Admin\UserController@index');
        Route::get('/data','Admin\UserController@getData');
        Route::get('/edit','Admin\UserController@edit');
        Route::get('/delete','Admin\UserController@destroy');
        Route::post('update','Admin\UserController@update');
        Route::post('/add','Admin\UserController@store');
        Route::post('/active','Admin\UserController@active');
        Route::post('/resetpass','Admin\UserController@resetpass');
    });
    Route::group(['prefix'=>'book'],function (){
        Route::group(['prefix'=>'theloai'],function (){
            Route::get('/','Admin\TheLoaiSachController@index');
            Route::get('/data','Admin\TheLoaiSachController@getData');
            Route::get('/edit','Admin\TheLoaiSachController@edit');
            Route::get('/delete','Admin\TheLoaiSachController@destroy');
            Route::post('/update','Admin\TheLoaiSachController@update');
            Route::post('/add','Admin\TheLoaiSachController@store');
        });
        Route::group(['prefix'=>'nxb'],function (){
            Route::get('/','Admin\NXBController@index');
            Route::get('/data','Admin\NXBController@getData');
            Route::get('/edit','Admin\NXBController@edit');
            Route::get('/delete','Admin\NXBController@destroy');
            Route::post('/update','Admin\NXBController@update');
            Route::post('/add','Admin\NXBController@store');
        });

    });
//
});
