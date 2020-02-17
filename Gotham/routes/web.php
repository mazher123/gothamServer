<?php

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

use App\Http\Controllers\ArticleController;


Route::get('/', function () {
    return view('welcome');
});
Route::get('/home', 'HomeController@index')->name('home');

Route::get('/articles', 'ArticleController@create');

Route::get('/articles/{id}', 'ArticleController@show');

Route::put('/articles/{id}', 'ArticleController@update');

Route::get('/articlesData', 'ArticleController@index');
Route::post('/articles', 'Articlecontroller@store');
Route::delete('/articles/{id}', "ArticleController@destroy");
