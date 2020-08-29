<?php

Route::get('registar-producto', 'API\ProductController@create')->name('partial.create.product');
Route::get('modal-generar-reporte', 'API\ReportController@modal')->name('partial.modal.report');
Route::apiResource('productos', 'API\ProductController');
