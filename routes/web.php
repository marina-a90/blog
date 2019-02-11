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

// Route::get('posts', function() {
//     return view('posts.index');
// });

// Route::get('posts/{id}', function() {
//     return view('posts.show');
// });

Route::resource('posts', 'PostsController');

// Route::get('posts', 'PostsController@index');
// Route::get('posts/{id}', 'PostsController@show');

//nova ruta za komentare
Route::post('posts/{id}/comments', 'PostsController@addComment')->name('posts.comment');