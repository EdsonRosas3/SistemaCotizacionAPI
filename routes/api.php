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
Route::post('login', 'UserController@login');
Route::post('register', 'UserController@register');

Route::post('quotitation', 'RequestQuotitationController@store');
Route::get('quotitations', 'RequestQuotitationController@index');
Route::get('quotitation/{id}', 'RequestQuotitationController@show');
Route::post('report/{id}', 'ReportController@store');
Route::post('upload', 'RequestQuotitationController@uploadFile');
Route::get('dowloadFile', 'RequestQuotitationController@fileDowload');
Route::group(['middleware' => 'auth:api'], function(){
    Route::post('details', 'UserController@details');
});
