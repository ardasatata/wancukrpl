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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/post/create', 'PostingController@createForm')->name('createPost')->middleware('auth'); //tambah post
Route::post('/post/posting', 'PostingController@create')->middleware('auth');

Route::get('/post/{post_id}', 'PostingController@viewPost')->name('viewPost'); //lihat post
Route::get('/editpost/{post_id}', 'PostingController@viewPost')->middleware('auth'); //edit post

Route::get('/mypost', 'PostingController@myPost')->middleware('auth')->name('myPost'); //edit post





Route::get('user/profile', 'UserController@showProfile')->name('myProfile');
