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

//pages

Route::get('contact', 'PagesController@getContact');

Route::get('about', 'PagesController@getAbout');

Route::get('/', 'PagesController@getWelcome');

//posts

Route::resource('posts', 'PostsController');


//Auth

Auth::routes();

// Comments

Route::post('comments/{post_id}', ['uses' => 'CommentsController@store', 'as' => 'comments.store']);
