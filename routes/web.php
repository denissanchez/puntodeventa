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
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home')->middleware('auth');
Route::post('/home', 'HomeController@post')->name('store.session')->middleware('auth');
Route::post('/sucursal', 'HomeController@remove')->name('remove.session')->middleware('auth');


Route::middleware(['auth'])->group(function() {
    Route::resource('usuarios', 'UserController');
    Route::resource('productos', 'ProductController');
    Route::resource('compras', 'PurchaseController');
    Route::resource('ventas', 'SaleController');
    Route::resource('facturacion', 'BillingCodeController');
});
