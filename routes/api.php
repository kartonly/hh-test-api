<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::group(['prefix' => 'news'], function(){
    Route::get('/', 'App\Http\Controllers\NewsController@all')->middleware('cors');
    Route::get('/one/{id}', 'App\Http\Controllers\NewsController@getOne')->middleware('cors');
    Route::get('/byCats/{id}', 'App\Http\Controllers\NewsController@newsByCats')->middleware('cors');
    Route::get('/byTags/{id}', 'App\Http\Controllers\NewsController@newsByTags')->middleware('cors');
    Route::get('/popular', 'App\Http\Controllers\NewsController@popularTags')->middleware('cors');
    Route::get('/find/{news}', 'App\Http\Controllers\NewsController@find')->middleware('cors');
    Route::match(['post', 'options'], '/comment', 'App\Http\Controllers\NewsController@createComment')->middleware('cors');
});

Route::match(['post', 'options'], 'login', 'App\Http\Controllers\LoginController')->middleware('cors');
Route::match(['post', 'options'], 'logout', 'App\Http\Controllers\LogoutController')->middleware('cors');

Route::group(['prefix' => 'admin'], function(){
    Route::match(['post', 'options'], '/addNews', 'App\Http\Controllers\AdminController@addNews')->middleware('cors');
    Route::match(['post', 'options'], '/deleteNews/{id}', 'App\Http\Controllers\AdminController@deleteNews')->middleware('cors');
    Route::match(['post', 'options'], '/deleteComment/{id}', 'App\Http\Controllers\AdminController@deleteComment')->middleware('cors');
});
