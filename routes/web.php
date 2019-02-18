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

Route::group(['middleware' => ['guest']], function() {

    Route::get('/register', 'RegisterController@create')
    ->name('show-register');

    Route::post('/register', 'RegisterController@store')
    ->name('register')
    ->middleware('age');

    Route::get('/login', 'LoginController@create')
    ->name('show-login');

    Route::post('/login', 'LoginController@store')
    ->name('login');

});


Route::get('/logout', 'LoginController@logout')->name('logout');


Route::group(
    ['middleware' => ['auth'] ],
    function() {
        Route::get('/my-posts', 'UserPostsController@index')
        ->name('my-posts');
    }
);


Route::get('/', function () {
    return view('welcome');
})->name('home');


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