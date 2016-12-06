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

Route::get('/', function () {
    return redirect('/post');
});

Route::auth();


//PostController routes

Route::get('/home', 'PostController@index');

Route::get('/post', 'PostController@index');

Route::get('/post/create', 'PostController@create');

Route::post('/post', 'PostController@store');

Route::get('/post/{id}', 'PostController@details');

Route::get('/post/{id}/edit', 'PostController@edit');

Route::put('/post/{id}', 'PostController@update');

Route::delete('/post/{id}', 'PostController@delete');


//CommentController routes

Route::post('/comment', 'CommentController@store');

Route::put('/comment/{id}', 'CommentController@update');

Route::delete('/comment/{id}', 'CommentController@delete');
