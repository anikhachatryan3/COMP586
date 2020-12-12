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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/login', 'App\Http\Controllers\Auth\LoginController@login')->name('login');
Route::get('/posts', 'App\Http\Controllers\PostController@allPosts')->name('posts');
Route::get('{user}/posts', 'App\Http\Controllers\PostController@myPosts')->name('my-posts');
Route::get('/posts/{post}', 'App\Http\Controllers\PostController@post')->name('post');
Route::post('/create-post', 'App\Http\Controllers\PostController@create')->name('create-post');
Route::delete('/posts/{post}', 'App\Http\Controllers\PostController@deletePost')->name('delete-post');
Route::put('/posts/{post}', 'App\Http\Controllers\PostController@editPost')->name('edit-post');
Route::post('/posts/{post}/comment', 'App\Http\Controllers\CommentController@create')->name('create-comment');
Route::delete('/comments/{comment}', 'App\Http\Controllers\CommentController@deleteComment')->name('delete-comment');
Route::put('/comments/{comment}', 'App\Http\Controllers\CommentController@editComment')->name('edit-comment');
