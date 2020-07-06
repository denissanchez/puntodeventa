<?php

// Route::middleware(['auth'])->group(function() {
Route::get('owners', 'API\OwnersController@search')->name('api.owners.search');
Route::get('products', 'API\ProductController@search')->name('api.products.search');
Route::post('purchases', 'API\PurchaseController@store')->name('api.purchases.store');
Route::post('sales', 'API\SaleController@store')->name('api.sales.store');
// });
