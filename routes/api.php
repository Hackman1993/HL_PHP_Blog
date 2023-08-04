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
Route::post("/user/login", 'App\Http\Controllers\AuthController@login');
Route::get("/content/art_category", 'App\\Http\\Controllers\\ArticleCategoryController@view');
Route::post("/editor/upload", 'App\\Http\\Controllers\\AttachmentController@editorUpload');
Route::get("/backend/menu", 'App\\Http\\Controllers\\MenuController@view');
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
