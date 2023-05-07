<?php
use Illuminate\Support\Facades\Route;

Route::prefix('storage')->controller(\App\Http\Controllers\StorageController::class)
    ->group(function() {

        Route::get('fields/{flow}', 'fields')
            ->can('flow', 'read');

        Route::post('/installation/{installation}/field/{flowStorageField:name}', 'store')
            ->can('read', 'installation')
            ->can('read', 'flowStorageField')
            ->can('store', \App\Models\StorageValue::class);

        Route::prefix('installation/{installation}/field/{flowStorageField:name}')
            ->group(function() {

                Route::get('/last-value', 'lastValue');
                Route::get('/from/{from}/to/{to}');
                Route::get('/today');
                Route::get('/yesterday');
                Route::get('/today-yesterday');

            });

    });
