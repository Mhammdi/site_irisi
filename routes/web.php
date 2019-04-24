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

Route::get('/', function () {
    return view('welcome');
});

Route::resource('forum', 'TypeSujetController');
Route::resource('sujet', 'SujetController');
Route::resource('reponse', 'ReponseController');


Route::resource('reaction', 'ReactionController');
Route::get('teest', 'ReactionController@Store');




Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/getTypes', 'TypeSujetController@getTypes');
Route::get('/getSujets', 'SujetController@getSujets');
Route::get('/getType{id}', 'TypeSujetController@getType');
Route::get('/Type{id}', 'TypeSujetController@Type');
Route::get('/sujet{id}', 'SujetController@getSujetsByType');
Route::get('/getSujet{id}', 'SujetController@getSujet');
Route::get('/Sujet{id}', function ($id) {
    return view('forum.sujet', ['id' => $id]);
});
Route::get('/Loading', function () {
    return view('loading');
});
