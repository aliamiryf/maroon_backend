<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\v1\client;

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
});
