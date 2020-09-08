<?php

use App\Http\Middleware\CheckAccount;

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home')->middleware('auth');

Route::prefix('admin')->name('admin.')->middleware(['role:super-admin'])->group(function() {
    Route::resource('accounts', 'admin\AccountController');
    Route::post('accounts/enable/{account}', 'admin\AccountController@enable')->name('accounts.enable');
});


Route::middleware([CheckAccount::class])->group(function () {
    Route::group(['middleware' => ['role:account-administrator']], function () {
        Route::get('sucursales', 'BranchController@index')->name('sucursales.index');
        Route::get('sucursales/registrar', 'BranchController@create');
        Route::post('sucursales/registrar', 'BranchController@store');
    });


    Route::resource('productos', 'ProductController');
    Route::resource('sucursales', 'BranchController');
    Route::resource('compras', 'PurchaseController');
    Route::resource('ventas', 'SaleController');
    Route::resource('facturacion', 'BillingCodeController');
    Route::resource('usuarios', 'UserController');
    Route::get('generar-reporte', 'ReportController@generate')->name('generate.report');



    Route::get('registar-producto', 'API\ProductController@create')->name('partial.create.product');
    Route::get('modal-generar-reporte', 'API\ReportController@modal')->name('partial.modal.report');

    Route::resource('v1/productos', 'API\ProductController');
});

