<?php

Route::get('owners', 'API\OwnersController@search')->name('owners.search');
Route::get('products', 'API\ProductController@search')->name('products.search');
