<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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
Route::get('/about', 'AboutController@index')->name('about');
Route::get('/contact-us', 'ContactController@index')->name('contact');
Route::post('/contact-us', 'ContactController@store')->name('contact-store');
Route::get('/pitbulls', 'DogController@index')->name('pitbulls');
Route::get('/pitbulls/{dog}', 'DogController@index')->name('show-pitbull');
Route::get('/services', 'ServiceController@index')->name('services');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/create-pitbull', 'DogController@create')->name('create-pitbull')->middleware('auth');
Route::get('/send-message', 'MessageController@create')->name('send-message')->middleware('auth');
Route::get('/create-service', 'ServiceController@create')->name('create-service')->middleware('auth');
