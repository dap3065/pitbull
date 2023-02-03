<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Dog;

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
    return view('welcome', ['pitbulls' => Dog::all()]);
});
Route::get('/about', 'AboutController@index')->name('about');
Route::get('/contact-us', 'ContactController@index')->name('contact');
Route::post('/contact-us', 'ContactController@store')->name('contact-store');
Route::get('/pitbulls', 'DogController@index')->name('pitbulls');
Route::get('/pitbulls/{dog}', 'DogController@show')->name('show-pitbull');
Route::get('/services', 'ServiceController@index')->name('services');
Route::get('/services/{service}', 'ServiceController@show')->name('show-service');
Route::get('/phpmyinfo', function () {
    phpinfo();
})->name('phpmyinfo');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/create-pitbull', 'DogController@create')->name('create-pitbull')->middleware('auth');
Route::post('/pitbulls', 'DogController@store')->name('save-pitbull')->middleware('auth');
Route::put('/pitbulls/{dog}', 'DogController@edit')->name('update-pitbull')->middleware('auth');
Route::get('/create-message', 'MessageController@create')->name('create-message')->middleware('auth');
Route::post('/send-message', 'MessageController@store')->name('send-message')->middleware('auth');
Route::get('/create-service', 'ServiceController@create')->name('create-service')->middleware('auth');
Route::post('/services', 'ServiceController@store')->name('save-service')->middleware('auth');
Route::put('/services/{service}', 'ServiceController@edit')->name('update-service')->middleware('auth');
