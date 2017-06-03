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

//Route::get('/', function () {
//    return view('welcome');
//});

Route::get('/', 'DiaryController@index');
Route::resource('diaries', 'DiaryController');
Route::resource('comments', 'CommentController');
Route::resource('util', 'UtilController');

Route::get('/user/register', 'UsersController@register');
Route::get('/user/login', 'UsersController@login');
Route::post('/user/subregister', 'UsersController@store');
Route::post('/user/sublogin', 'UsersController@signin');
Route::get('/user/logout', 'UsersController@logout');
