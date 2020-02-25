<?php

Route::get('productos/registrar', 'API\ProductController@create')->name('partial.create.product');
Route::apiResource('productos', 'API\ProductController');
