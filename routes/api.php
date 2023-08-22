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
Route::get("/content/article.blade.php/content/{target}", 'App\\Http\\Controllers\\ArticleController@content');
Route::get("/content/article.blade.php", 'App\\Http\\Controllers\\ArticleController@list');
Route::any("/backend/menu", 'App\\Http\\Controllers\\MenuController@view');
Route::post("/content/article.blade.php/create", 'App\\Http\\Controllers\\ArticleController@create');
Route::post("/content/article.blade.php/update/{target}", 'App\\Http\\Controllers\\ArticleController@update');
Route::delete("/content/article.blade.php/delete", 'App\\Http\\Controllers\\ArticleController@delete');
Route::post("/attachment/upload", 'App\\Http\\Controllers\\AttachmentController@upload');
Route::get("/attachment/info/{target}", 'App\\Http\\Controllers\\AttachmentController@info');
Route::middleware('auth:sanctum')->group(function (){

});
