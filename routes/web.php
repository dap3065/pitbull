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
Route::get('/dogs', 'DogController@index')->name('dogs');
Route::get('/services', 'ServiceController@index')->name('services');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/create-dog', 'DogController@create')->name('create-dog')->middleware('auth');
Route::get('/send-message', 'MessageController@create')->name('send-message')->middleware('auth');
Route::get('/create-service', 'ServiceController@create')->name('create-service')->middleware('auth');
