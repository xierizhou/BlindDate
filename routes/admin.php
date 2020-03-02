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

Route::group(['prefix' => 'admin','namespace' => 'Admin'],function ()
{
    Route::get('login', 'LoginController@showLoginForm')->name('admin.login');
    Route::post('login', 'LoginController@login');
    Route::any('logout', 'LoginController@logout');


    Route::group(['middleware' => 'auth.admin:admin'], function () {
        Route::get('/', 'IndexController@index');

        Route::get('/welcome', 'IndexController@welcome');
        Route::resource('means', 'MeansController',['except' => ['show']]);
        /*Route::resource('channel', 'ChannelController',['except' => ['show']]);
        Route::resource('user', 'UserController',['except' => ['show']]);
        Route::resource('user_material', 'UserMaterialController',['except' => ['show']]);
        Route::resource('material_price', 'MaterialPriceController',['except' => ['show']]);

        Route::resource('agent', 'AgentController',['except' => ['show']]);
        Route::resource('grade', 'GradeController',['except' => ['show']]);
        Route::resource('channel_account', 'ChannelAccountController',['except' => ['show']]);*/
    });
});
