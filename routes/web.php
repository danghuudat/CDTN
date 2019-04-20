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
    Route::group(['prefix'=>'profile'],function (){
        Route::get('/','Admin\UserController@show');
        Route::post('editimage','Admin\UserController@editImage');
        Route::post('editinfo','Admin\UserController@editInfo');

    });
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
    Route::group(['prefix'=>'naptien'],function (){
        Route::post('/add','Admin\VitienController@store');
        Route::get('/lichsu','Admin\VitienController@history');
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
        Route::group(['prefix'=>'tacgia'],function (){
            Route::get('/','Admin\TacGiaController@index');
            Route::get('/data','Admin\TacGiaController@getData');
            Route::get('/edit','Admin\TacGiaController@edit');
            Route::get('/delete','Admin\TacGiaController@destroy');
            Route::post('/update','Admin\TacGiaController@update');
            Route::post('/add','Admin\TacGiaController@store');
        });

    });
    Route::group(['prefix'=>'menu'],function (){
       Route::get('/','Admin\MenuController@index');
    });
    Route::group(['prefix'=>'theloai_douong'],function (){
        Route::get('/','Admin\Theloai_DouongController@index');
        Route::get('/data','Admin\Theloai_DouongController@getData');
        Route::post('/add','Admin\Theloai_DouongController@store');
        Route::get('/edit','Admin\Theloai_DouongController@edit');
    });
//
});
