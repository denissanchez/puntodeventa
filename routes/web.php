<?php

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home')->middleware('auth');

Route::resource('sucursales', 'BranchController');

Route::group(['middleware' => ['role:account-administrator']], function () {
    Route::get('sucursales', 'BranchController@index')->name('sucursales.index');
    Route::get('sucursales/registrar', 'BranchController@create');
    Route::post('sucursales/registrar', 'BranchController@store');
});


Route::resource('productos', 'ProductController');

Route::resource('compras', 'PurchaseController');
Route::resource('ventas', 'SaleController');
Route::resource('facturacion', 'BillingCodeController');
Route::resource('usuarios', 'UserController');
Route::get('generar-reporte', 'ReportController@generate')->name('generate.report');

Route::prefix('admin')->name('admin.')->middleware(['role:super-admin'])->group(function() {
    Route::resource('accounts', 'admin\AccountController');
});
