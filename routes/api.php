<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\v1\client;
use App\Http\Controllers\v1\main;
use \App\Http\Controllers\v1\admin;
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

Route::prefix('v1')->group(function () {


    Route::prefix('article')->group(function () {
        Route::get('/all', [client\articleController::class, 'getAllArticle']);
        Route::post('create', [client\articleController::class, 'createArticle']);
        Route::get('{id}', [client\articleController::class, 'getArticle']);
        Route::prefix('{article}')->group(function () {
            Route::post('edit', [client\articleController::class, 'editArticle']);
            Route::get('delete', [client\articleController::class, 'deleteArticle']);
            Route::post('changeStatus', [client\articleController::class, 'changeStatus']);
        });
    });


    Route::prefix('/category')->group(function () {
        Route::get('/all', [client\categoryController::class, 'getAllCategory']);
        Route::post('/create', [client\categoryController::class, 'createCategory']);
        Route::prefix('{category}')->group(function () {
            Route::post('/edit', [client\categoryController::class, 'editCategory']);
            Route::get('/delete', [client\categoryController::class, 'deleteCategory']);
        });
    });


    Route::prefix('auth')->group(function (){
        Route::middleware('authJwt')->group(function (){
            Route::get('/profile',[main\authController::class,'getProfile']);
        });

        Route::post('register',[main\authController::class,'register']);
        Route::post('forgetPassword');
        Route::prefix('/login')->group(function (){
            Route::post('userPass',[main\authController::class,'loginByUserPass']);
        });
    });

    Route::prefix('token')->group(function (){
        Route::get('/generate',[main\temporaryTokenController::class,'generateToken']);
    });

    Route::prefix('tag')->group(function (){
        Route::get('all',[client\tagController::class,'getAllTag']);
        Route::post('create',[client\tagController::class,'createTag']);
        Route::prefix('{tag}')->group(function (){
            Route::get('/delete',[client\tagController::class,'deleteTag']);
        });
    });



    Route::prefix('admin')->group(function() {
        Route::prefix('segment')->group(function () {
            Route::get('all', [admin\segmentController::class, 'getListSegments']);
            Route::post('create',[admin\segmentController::class,'createSegment']);
        });
    });

});


