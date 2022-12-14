<?php

use App\Http\Controllers\FeedController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TweetController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
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

Route::get('/', function () {
    return view('welcome');
});




Route::get("/test",function (){
    return "test";
});

Route::get("/test",function (){
    return "test2";
});


Route::get('/{var}', function () {
    return view('welcome');
});
