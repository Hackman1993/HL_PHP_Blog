<?php

use App\Models\FrontendMenu;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//Route::get("/", function (Request $request){
//    return view('index');
//});
Route::get("/", function (){
    $data = FrontendMenu::all()->toTree();
    return view('index'.env("TEMPLATE_PRE", ""))->with('menus', $data);
});

Route::get("/article/{target}", function (\Illuminate\Http\Request $request, \App\Models\Article $target){
    $data = FrontendMenu::all()->toTree();
    return view('article')->with('article', $target)->with('menus', $data);
});

Route::get("/search", function (\Illuminate\Http\Request $request){
    $data = FrontendMenu::all()->toTree();
    $query = \App\Models\Article::query();
    if($request->has('search')){
        $query->whereFullText(['content', 'title', 'keywords'], $request['search']);
    }
    return view('search')->with('menus', $data)->with('articles', $query->paginate($request['limit']? $request['limit']:10))->with('search', $request['search']);
});

Route::fallback(function (){
   return view("backend_common");
});
