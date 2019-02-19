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
    return view('pages.index');
});


Route::get('/user/update', 'HomeController@update');
Route::post('/user/edit', 'HomeController@edit');

Route::get('/comment/{id}', 'CommentsController@index');
Route::get('/{q_id}/comment/{id}/delete', 'CommentsController@delete');
Route::post('/question/update/{id}', 'QuestionController@update');
Route::post('/question/destroy/{id}', 'QuestionController@destroy');
Route::resource('/question', 'QuestionController');

Route::get('/chatroom', 'GroupchatController@index');
Route::post('/sent', 'GroupchatController@send');
Route::get('/rqst-msgs', 'GroupchatController@refresh');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
