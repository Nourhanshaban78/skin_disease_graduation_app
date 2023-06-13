<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PhotoController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\TalkController;
use App\Http\Controllers\DeepController;
use App\Http\Controllers\AdminController;





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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::group(['middleware'=>'api'],function($routes){
    Route::post('/register',[UserController::class,'register']);
    Route::post('/login',[UserController::class,'login']);
    Route::post('/profile',[UserController::class,'profile']);
    Route::post('/refresh',[UserController::class,'refresh']);
    Route::post('/logout',[UserController::class,'logout']);
    Route::post('/store',[PhotoController::class,'store']);
    Route::get('/search/{name}',[SearchController::class,'search']);
    Route::post('/chat', [MessageController::class, 'store']);
    Route::get('/chat', [MessageController::class, 'index']);
    Route::post('/talk', [TalkController::class, 'store']);
    Route::get('/talk/{sender_id}/{receiver_id}', [TalkController::class, 'index']);
    Route::delete('talk/{talk}', [TalkController::class,'destroy']);
    Route::get('/get_photos/{id}',[PhotoController::class,'get_photos']);
    Route::post('/store_photos_all',[PhotoController::class,'store_photos_all']);
    Route::post('/runModel',[DeepController::class,'runModel']);
    Route::get('/showModelResults',[DeepController::class,'showModelResults']);
    Route::post('/update_profile',[UserController::class,'update_profile']);
    Route::delete('deleteaccount/{id}', [UserController::class,'deleteaccount']);
    Route::get('admin', [UserController::class,'admin']);
    Route::get('/user', [AdminController::class,'users']);
    Route::get('/approved/{id}',[AdminController::class,'approved']);
    Route::get('/canceled/{id}',[AdminController::class,'canceled']);
    Route::post('/doctor',[UserController::class,'doctors']);
    Route::get('/all_doctor',[AdminController::class,'all_doctors']);
    Route::get('/approved_doctor/{id}',[AdminController::class,'approved_doctor']);
    Route::get('/canceled_doctor/{id}',[AdminController::class,'canceled_doctor']);
    Route::delete('/deleted_doctor/{id}',[AdminController::class,'deleted_doctor']);
    Route::post('/add_search',[AdminController::class,'add_search']);
    Route::delete('/deleted_search/{id}',[AdminController::class,'deleted_search']);
    Route::get('/update_search/{id}',[AdminController::class,'update_search']);
    Route::post('/edit_search/{id}',[AdminController::class,'edit_search']);




 
});

Route::post('/forget_password',[UserController::class,'forget_password']);



