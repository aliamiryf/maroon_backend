<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\v1;
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

Route::prefix('v1')->group(function (){
    Route::prefix('article')->group(function (){
        Route::get('/all',[v1\articleController::class,'getAllArticle']);
        Route::post('create',[v1\articleController::class,'createArticle']);
        Route::get('{id}',[v1\articleController::class,'getArticle']);
        Route::prefix('{article}')->group(function (){
            Route::post('edit',[v1\articleController::class,'editArticle']);
            Route::get('delete',[v1\articleController::class,'deleteArticle']);
            Route::post('changeStatus',[v1\articleController::class,'changeStatus']);
        });
    });
});
