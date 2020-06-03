<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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
/* 
Route::get('/', function () {
    return view('welcome');
}); */

Route::namespace('Frontend')->group(function(){
    Route::get('/','DefaultController@index')->name('home.Index');
    //BLOG
    Route::get('/blog','BlogController@index')->name('blog.Index');
    Route::get('/blog/{slug}','BlogController@detail')->name('blog.Detail');
    //PAGE
    Route::get('/page/{slug}','PageController@detail')->name('page.Detail');
    //CONTACT
    Route::get('/contact','DefaultController@contact')->name('contact.Index');
    Route::post('/contact','DefaultController@sendMail');

});


Route::namespace('Backend')->group(function () {
    Route::prefix('manage')->group(function () {
        Route::get('/dashboard', 'DefaultController@index')->name('manage.index')->middleware('admin');
        Route::get('/', 'DefaultController@login')->name('manage.login');
        Route::get('/logout', 'DefaultController@logout')->name('manage.logout');
        Route::get('/login', 'DefaultController@login');
        Route::post('/login', 'DefaultController@authenticate')->name('manage.authenticate');
    });

    Route::middleware(['admin'])->group(function () {
        Route::prefix('manage/settings')->group(function () {
            Route::get('/', 'SettingsController@index')->name('settings.index');
            Route::post('', 'SettingsController@sortable')->name('settings.sortable');
            Route::get('/delete/{id}', 'SettingsController@destroy');
            Route::get('/edit/{id}', 'SettingsController@edit')->name('settings.edit');
            Route::post('/{id}', 'SettingsController@update')->name('settings.update');
        });
    });
});

Route::namespace('Backend')->group(function () {
    Route::prefix('manage')->group(function () {
        Route::middleware(['admin'])->group(function () {
            //BLOG
            Route::post('/blog/sortable', 'BlogController@sortable')->name('blog.sortable');
            Route::resource('blog', 'BlogController');
            //PAGE
            Route::post('/page/sortable', 'PageController@sortable')->name('page.sortable');
            Route::resource('page', 'PageController');
            //Slider
            Route::post('/slider/sortable', 'SliderController@sortable')->name('slider.sortable');
            Route::resource('slider', 'SliderController');
            //User
            Route::post('/user/sortable', 'UserController@sortable')->name('user.sortable');
            Route::resource('user', 'UserController');
        });
    });
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
