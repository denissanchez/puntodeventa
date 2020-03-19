<?php

Route::get('registar-producto', 'API\ProductController@create')->name('partial.create.product');
Route::get('generar-reporte', 'API\ReportController@modal')->name('partial.modal.report');
Route::post('generar-reporte', 'API\ReportController@generate')->name('generate.report');
Route::apiResource('productos', 'API\ProductController');
