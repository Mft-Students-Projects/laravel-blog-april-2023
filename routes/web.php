<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\DashboardController;
use \App\Http\Controllers\DashboardCategoryController;
use \App\Http\Controllers\DashboardNewsController;
use \App\Http\Controllers\DashboardReporterController;
use \App\Http\Controllers\DashboardCommentController;
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
//
//Route::get('/', function () {
//    return view('welcome');
//});



Route::group(["prefix"=>"dashboard","middleware"=>["auth"]],function(){

//    Route::get("/","App\Http\Controllers\DashboardController@index");
    Route::get("/",[DashboardController::class,'index'])->name("dashboard");

//    Route::get("/categories",[DashboardCategoryController::class,"index"]);
//    Route::get("/categories/create",[DashboardCategoryController::class,"create"]);

    Route::resource("categories",DashboardCategoryController::class);
    Route::resource("comments",DashboardCommentController::class);
    Route::get("comments/confirmed/{id}","App\Http\Controllers\DashboardCommentController@confirm")->name("comments.confirm");
    Route::get("comments/replies/{id}","App\Http\Controllers\DashboardCommentController@replies")->name("comments.replies");
    Route::resource("news",DashboardNewsController::class);
    Route::resource("reporters",DashboardReporterController::class);

});


Route::get("/","App\Http\Controllers\HomeController@index");
Route::post("/news/{id}","App\Http\Controllers\NewsController@saveComment")->name("client.comment");
Route::get("/news/{id}","App\Http\Controllers\NewsController@show")->name("client.news");
Route::get("/category/{id}","App\Http\Controllers\CategoryController@show")->name("client.category");
Route::get("/contact","App\Http\Controllers\HomeController@contact");
Route::get("/search","App\Http\Controllers\NewsController@search")->name("search");

Auth::routes();
