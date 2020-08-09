<?php

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home')->middleware('auth');

Route::resource('sucursales', 'BranchController');
Route::resource('productos', 'ProductController');
Route::resource('compras', 'PurchaseController');
Route::resource('ventas', 'SaleController');
Route::resource('facturacion', 'BillingCodeController');
Route::resource('usuarios', 'UserController');
Route::get('generar-reporte', 'ReportController@generate')->name('generate.report');
