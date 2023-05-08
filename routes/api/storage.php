<?php
use Illuminate\Support\Facades\Route;

Route::prefix('storage')->controller(\App\Http\Controllers\StorageController::class)
    ->group(function() {

        Route::get('fields/{flow}', 'fields')
            ->can('view', 'flow'); //iets met storage in access token rechten geburiken

        Route::post('/team/{team}/flow/{flow}/field/{flowStorageField:name}', 'store')
            ->can('view', 'flow')
            ->can('view', 'team')
            ->can('view', 'flowStorageField')
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
