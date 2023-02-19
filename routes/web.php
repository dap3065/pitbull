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
})->name('welcome');
Route::get('/about', 'AboutController@index')->name('about');
Route::get('/contact-us', 'ContactController@index')->name('contact');
Route::post('/contact-us', 'ContactController@store')->name('contact-store');
Route::get('/pitbulls', 'DogController@index')->name('pitbulls');
Route::get('/pitbulls/{dog}', 'DogController@show')->name('show-pitbull');
Route::get('/services', 'ServiceController@index')->name('services');
Route::get('/services/{service}', 'ServiceController@show')->name('show-service');
Route::get('/test-php-info', function () {
    phpinfo();
})->name('phpmyinfo');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/create-pitbull', 'DogController@create')->name('create-pitbull')->middleware('auth');
Route::post('/pitbulls', 'DogController@store')->name('save-pitbull')->middleware('auth');
Route::get('/pitbulls/{dog}/edit', 'DogController@edit')->name('edit-pitbull')->middleware('auth');
Route::put('/pitbulls/{dog}', 'DogController@update')->name('update-pitbull')->middleware('auth');
Route::delete('/pitbull/{dog}', 'DogController@destroy')->name('delete-pitbull')->middleware('auth');
Route::get('/create-message', 'MessageController@create')->name('create-message')->middleware('auth');
Route::post('/send-message', 'MessageController@store')->name('send-message')->middleware('auth');
Route::get('/create-service', 'ServiceController@create')->name('create-service')->middleware('auth');
Route::post('/services', 'ServiceController@store')->name('save-service')->middleware('auth');
Route::get('/services/{service}/edit', 'ServiceController@edit')->name('edit-service')->middleware('auth');
Route::put('/services/{service}', 'ServiceController@update')->name('update-service')->middleware('auth');
Route::delete('/services/{service}', 'ServiceController@destroy')->name('delete-service')->middleware('auth');
Route::get('/handle-payment', 'PayPalPaymentController@handlePayment')->name('make.payment')->middleware('auth');
Route::get('/cancel-payment', 'PayPalPaymentController@paymentCancel')->name('cancel.payment')->middleware('auth');
Route::get('/payment-success', 'PayPalPaymentController@paymentSuccess')->name('success.payment')->middleware('auth');
