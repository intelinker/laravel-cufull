<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::resource('diary', 'DiaryController');
Route::get('gethostpitalsdata', 'UtilController@getHostpitals');
Route::get('getmedicinesdata', 'UtilController@getMedicines');
Route::get('getdiseasesdata', 'UtilController@getDiseases');
Route::get('getsymptomsdata', 'UtilController@getSymptoms');
Route::get('getoperationsdata', 'UtilController@getOperations');
Route::get('getchecksdata', 'UtilController@getChecks');
Route::get('getdepartmentsdata', 'UtilController@getDepartments');
Route::get('getbodypartsdata', 'UtilController@getBodyParts');
Route::get('getfactoriesdata', 'UtilController@getFactories');
Route::get('getdrugstoresdata', 'UtilController@getDrugStores');
Route::get('getcitiesdata', 'UtilController@getCities');
Route::get('getrecipesdata', 'UtilController@getRecipes');
Route::get('getfoodsdata', 'UtilController@getFoods');
Route::get('getloresdata', 'UtilController@getLores');
Route::get('getasksdata', 'UtilController@getAsks');
Route::get('getbooksdata', 'UtilController@getBooks');
Route::get('downimages', 'UtilController@downImages');


