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

Route::get('/feed', 'HomeController@homeFeed')->name('feed');

Route::get('/post/create', 'PostingController@createForm')->name('createPost')->middleware('auth'); //tambah post
Route::post('/post/posting', 'PostingController@create')->middleware('auth');

Route::get('/post/{post_id}', 'PostingController@viewPost')->name('viewPost'); //lihat post

Route::get('/editpost/{post_id}', 'PostingController@editForm')->middleware('auth')->name('editPost'); //edit post
Route::post('/post/{id}/edit', 'PostingController@edit')->middleware('auth');

Route::get('/post/{post_id}/delete', 'PostingController@deletePost')->middleware('auth')->name('deletePost'); //edit post

Route::get('/mypost', 'PostingController@myPost')->middleware('auth')->name('myPost'); //lihat semua my post

Route::get('/like/{post_id}', 'PostingController@likePost')->middleware('auth')->name('like'); //like post
Route::get('/unlike/{post_id}', 'PostingController@unlikePost')->middleware('auth')->name('unlike'); //unlike post


Route::get('user/profile', 'ProfileController@myProfile')->name('myProfile'); //lihat profile sendiri
Route::get('user/{id}', 'ProfileController@viewProfile')->name('viewProfile'); //lihat profile orang

Route::get('edit/profile', 'ProfileController@editProfile')->name('editProfile'); //edit profile sendiri
Route::post('/edit', 'ProfileController@edit')->middleware('auth');//post edit profile


Route::get('/follow/{user_id}', 'FollowController@follow')->middleware('auth')->name('follow'); //Follow User
Route::get('/unfollow/{user_id}', 'FollowController@unfollow')->middleware('auth')->name('unfollow'); //Unfollow User


Route::post('/comment/post/', 'CommentController@postComment')->middleware('auth')->name('postComment'); //Post Comment
Route::get('/comment/delete/{$id_comment}', 'CommentController@deleteComment')->middleware('auth')->name('deleteComment'); //Delete Comment


Route::get('/likelist/{user_id}', 'PostingController@likeList')->middleware('auth')->name('likeList'); //Follow User
//Route::get('/unfollow/{user_id}', 'FollowController@unfollow')->middleware('auth')->name('unfollow'); //Unfollow User

Route::get('/topten', 'PostingController@top10')->middleware('auth')->name('topten'); //Follow User