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
Route::group(array('prefix' => 'dashboard', 'middleware' => 'App\Http\Middleware\SentinelGuest'), function () {
    Route::group(array('middleware' => 'App\Http\Middleware\SentinelAdmin'), function () {
        Route::get('/', array('as' => 'dashboard', 'uses' => 'admin\AdminController@index'));
        Route::post('/detail/update', array('as' => 'user.detail.update', 'uses' => 'admin\AdminController@update_detail'));
        Route::get('/detail/delete/{id}', array('as' => 'user.detail.delete', 'uses' => 'admin\AdminController@delete_detail'));
    });
});
/**
 * Auth
 */
//Route::get('admin', function () {return redirect('admin/login');});
Route::get('/', array('as' => 'login', 'uses' => 'admin\UserController@index'));
Route::get('login', array('as' => 'login', 'uses' => 'admin\UserController@index'));
Route::post('login', array('as' => 'login', 'uses' => 'admin\UserController@loginAdmin'));
Route::get('logout', array('as' => 'logout', 'uses' => 'admin\UserController@getLogout'));
