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

Route::prefix('admin')->group(function() {
    Route::group(['middleware' => ['role: super-admin']], function (){
        Route::resource('accounts', 'admin\AccountController');
    });
});
