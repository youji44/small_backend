<?php

use App\Http\Controllers\DetailController;
use Illuminate\Support\Facades\Route;

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

//justTest
Route::post('/justTest',[DetailController::class,'justTest']);

Route::get('/', array('as' => 'user.home', 'uses' => 'HomeController@index'));
Route::get('/login', array('as' => 'user.login', 'uses' => 'HomeController@login'));
Route::post('/login/store', array('as' => 'user.store', 'uses' => 'HomeController@store'));
Route::get('/approve', array('as' => 'user.approve', 'uses' => 'HomeController@approve'));
Route::get('/check', array('as' => 'check.approve', 'uses' => 'HomeController@check'));
Route::post('/visit', array('as' => 'user.visit', 'uses' => 'HomeController@visit'));

Route::group(array('prefix' => 'admin', 'middleware' => 'App\Http\Middleware\SentinelGuest'), function () {
    Route::group(array('middleware' => 'App\Http\Middleware\SentinelAdmin'), function () {
        Route::get('/', array('as' => 'dashboard', 'uses' => 'admin\AdminController@index'));
        Route::post('/detail/update', array('as' => 'user.detail.update', 'uses' => 'admin\AdminController@update_detail'));
        Route::get('/detail/delete/{id}', array('as' => 'user.detail.delete', 'uses' => 'admin\AdminController@delete_detail'));
        Route::post('/check', array('as' => 'user.check', 'uses' => 'admin\AdminController@check'));
    });
});

/**
 * Auth
 */
//Route::get('/', function () {return redirect('/login');});
Route::get('/admin/login', array('as' => 'login', 'uses' => 'admin\UserController@index'));
Route::post('/admin/login', array('as' => 'login', 'uses' => 'admin\UserController@loginAdmin'));
Route::get('/admin/logout', array('as' => 'logout', 'uses' => 'admin\UserController@getLogout'));
