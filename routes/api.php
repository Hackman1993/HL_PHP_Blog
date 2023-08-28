<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/


Route::get('/frontend/menu', "App\\Http\\Controllers\\FrontendMenuController@view");
Route::post("/user/login", 'App\Http\Controllers\AuthController@login');
Route::get("/content/art_category", 'App\\Http\\Controllers\\ArticleCategoryController@view');
Route::get("/content/article/content/{target}", 'App\\Http\\Controllers\\ArticleController@content');
Route::get("/content/article", 'App\\Http\\Controllers\\ArticleController@list');

Route::get("/attachment/info/{target}", 'App\\Http\\Controllers\\AttachmentController@info');

Route::get('/visit/record', 'App\Http\Controllers\VisitRecordController@visit');
Route::get('/sign/record', 'App\Http\Controllers\SignRecordController@sign');
Route::middleware('auth:sanctum')->group(function (){
    // User
    Route::get('/user', 'App\Http\Controllers\UserController@list');
    Route::post('/user/create', 'App\Http\Controllers\UserController@create');
    Route::put('/user/update/{target}', 'App\Http\Controllers\UserController@update');
    Route::delete('/user/delete', 'App\Http\Controllers\UserController@delete');

    // Content
    Route::post("/content/article/create", 'App\\Http\\Controllers\\ArticleController@create');
    Route::post("/content/article/update/{target}", 'App\\Http\\Controllers\\ArticleController@update');
    Route::delete("/content/article/delete", 'App\\Http\\Controllers\\ArticleController@delete');
    Route::post("/attachment/upload", 'App\\Http\\Controllers\\AttachmentController@upload');

    // Question
    Route::post("/question/create", 'App\Http\Controllers\QuestionController@create');
    Route::post("/question/update/{target}", 'App\Http\Controllers\QuestionController@update');
    Route::delete("/question/delete", 'App\Http\Controllers\QuestionController@delete');
    Route::get("/question", 'App\Http\Controllers\QuestionController@list');

    Route::get("/backend/menu", 'App\\Http\\Controllers\\MenuController@view');
});
