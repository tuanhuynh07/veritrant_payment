<?php

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

Route::get('/',function (){
    return view('welcome');
})->name('index');
Route::get('/home', 'HomeController@index')->name('home');
/**
 * card
 */
Route::get('/card', 'HomeController@card')->name('card');
Route::post('/card_payment', 'HomeController@cardPayment')->name('card_payment');
/**
 * Convenience Store
 */
Route::get('/cvs', 'ConvenienceController@cvsAuthorize')->name('cvs');
Route::post('/cvs_payment', 'ConvenienceController@cvsPayment')->name('cvs_payment');
/**
 * Bank - pay-easy
 */
Route::get('/bank', 'BankController@bankAuthorize')->name('bank');
Route::post('/bank_payment', 'BankController@bankPayment')->name('bank_payment');
