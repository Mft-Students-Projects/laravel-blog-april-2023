<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\DashboardController;
use \App\Http\Controllers\DashboardCategoryController;
use \App\Http\Controllers\DashboardNewsController;
use \App\Http\Controllers\DashboardReporterController;
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
    Route::get("/",[DashboardController::class,'index']);

//    Route::get("/categories",[DashboardCategoryController::class,"index"]);
//    Route::get("/categories/create",[DashboardCategoryController::class,"create"]);

    Route::resource("categories",DashboardCategoryController::class);
    Route::resource("news",DashboardNewsController::class);
    Route::resource("reporters",DashboardReporterController::class);

});


Route::get("/","App\Http\Controllers\HomeController@index");
Route::get("/news/{id}","App\Http\Controllers\NewsController@show");
Route::get("/contact","App\Http\Controllers\HomeController@contact");

Auth::routes();
