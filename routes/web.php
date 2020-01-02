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

Route::get('/','HomeController@index')->name('home');

Auth::routes();

Route::get('posts','PostController@index')->name('posts.index');
Route::get('post/{slug}','PostController@details')->name('post.details');
Route::get('category/{slug}','PostController@postByCategory')->name('category.posts');
Route::get('tag/{slug}','PostController@postByTag')->name('tag.posts');

Route::get('profile/{username}','AuthorController@profile')->name('author.profile');

Route::post('/subscriber/add','SubscriberController@subscriber')->name('subscriber.add');

Route::get('search','SearchController@search')->name('search');

Route::group(['middleware' => ['auth']],function(){
    Route::post('favourite/{post}/add','FavouriteController@add')->name('post.favourite');
    Route::post('comment/{id}','CommentController@store')->name('comment.store');
});



Route::group(['as' => 'admin.','prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => ['auth','admin']],
function(){
    Route::get('dashboard','DashboardController@index')->name('dashboard');

    Route::get('profile','SettingsController@index')->name('profile.setting');
    Route::put('profile/update','SettingsController@update')->name('profile.update');
    Route::put('password/update','SettingsController@updatePassword')->name('password.update');

    Route::resource('tag','TagController');
    Route::resource('category','CategoryController');
    Route::resource('post','PostController');

    Route::get('pending','PostController@pending')->name('post.pending');
    Route::put('post/{id}/approve','PostController@approve')->name('post.approve');

    Route::get('favourite','FavouriteController@index')->name('favourite.post');

    Route::get('authors','AuthorController@index')->name('author.index');
    Route::delete('authors/{id}','AuthorController@destroy')->name('author.destroy');

    Route::get('subscriber','SubscriberController@subscriber')->name('subscriber');
    Route::delete('subscriber/{id}','SubscriberController@destroy')->name('subscriber.destroy');

    Route::get('comments','CommentController@index')->name('comment.index');
    Route::delete('comments/{id}','CommentController@destroy')->name('comment.destroy');

});


Route::group(['as' => 'author.','prefix' => 'author', 'namespace' => 'Author', 'middleware' => ['auth','author']],
    function(){
        Route::get('dashboard','DashboardController@index')->name('dashboard');

        Route::get('profile','SettingsController@index')->name('profile.setting');
        Route::put('profile/update','SettingsController@update')->name('profile.update');
        Route::put('password/update','SettingsController@updatePassword')->name('password.update');

        Route::get('favourite','FavouriteController@index')->name('favourite.post');

        Route::resource('post','PostController');

        Route::get('comments','CommentController@index')->name('comment.index');
        Route::delete('comments/{id}','CommentController@destroy')->name('comment.destroy');

    });


 View::composer('layouts.frontend.partials.footer', function ($view) {

               $categories = App\Category::all();
               $view->with('categories',$categories);

        });
