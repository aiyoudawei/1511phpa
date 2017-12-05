<?php 

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'WelcomeController@index');

Route::post('ww2', 'WelcomeController@ww2');

Route::get('show', 'WelcomeController@show');

Route::get('del', 'WelcomeController@del');

Route::get('update', 'WelcomeController@update');

Route::get('add', 'WelcomeController@add');

Route::post('adddo', 'WelcomeController@adddo');

Route::post('update_do', 'WelcomeController@update_do');

Route::get('liuyan', 'WelcomeController@liuyan');

Route::get('richeng', 'WelcomeController@richeng');

Route::post('rcdl', 'WelcomeController@rcdl');

Route::get('rcshow', 'WelcomeController@rcshow');

Route::post('rcadd', 'WelcomeController@rcadd');