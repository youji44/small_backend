<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DetailController;
use App\Http\Controllers\NotificationController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//Login Routes start here
//register
Route::post('/register', [LoginController::class, 'register']);
//login
Route::post('/login', [LoginController::class, 'login']);
//logout
Route::middleware('auth:api')->get('/logout',[LoginController::class,'logout']);
//loginCheck
Route::get('/loginCheck', [LoginController::class, 'loginCheck']);
//Login Routes start end here

//StoreDetail Routes Start here
//StoreDetail
Route::post('/StoreDetail',[DetailController::class,'StoreDetail']);
//ViewAllUserDetails
Route::get('/ViewAllUserDetails',[DetailController::class,'ViewAllUserDetails']);
//updateStatus
Route::post('/updateStatus',[DetailController::class,'updateStatus']);
//deleteUserDetail
Route::delete('/deleteUserDetail/{id}',[DetailController::class,'deleteUserDetail']);
//CheckApi
Route::get('/CheckApi',[DetailController::class,'CheckApi']);



//pusher
Route::get('/pusher',[DetailController::class,'pusher']);

//getNotification
Route::get('/getNotification',[LoginController::class,'getNotification']);
//getNotificationCount
Route::get('/getNotificationCount',[NotificationController::class,'getNotificationCount']);
//deleteGetNotification
Route::delete('/deleteGetNotification/{id}',[LoginController::class,'deleteGetNotification']);
//unreadNotification
Route::get('/unreadNotification',[LoginController::class,'unreadNotification']);
//ViewNotification
Route::get('/ViewNotification',[LoginController::class,'ViewNotification']);
//deleteNotification
Route::delete('/deleteNotification/{id}',[LoginController::class,'deleteNotification']);



