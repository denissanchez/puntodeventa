<?php
//
//Route::get('registar-producto', 'API\ProductController@create')->name('partial.create.product');
//Route::apiResource('productos', 'API\ProductController');

Route::get('owners', 'API\OwnersController@search')->name('owners.search');
