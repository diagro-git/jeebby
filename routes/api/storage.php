<?php
use Illuminate\Support\Facades\Route;

Route::prefix('storage/team/{team}/flow/{flow}/field/{flowStorageField:name}')->controller(\App\Http\Controllers\StorageController::class)
    ->scopeBindings()
    ->group(function() {
        Route::post('/', 'store')->middleware('ability:storage:write');

        Route::middleware('ability:storage:read')->group(function() {
            Route::get('/last-value', 'lastValue');
            Route::get('/from/{from}/to/{to}/{aggregation?}', 'betweenDates');
            Route::get('/today/{aggregation?}', 'today');
            Route::get('/yesterday/{aggregation?}', 'yesterday');
            Route::get('/yesterday-today/{aggregation?}', 'yesterdayToday');
        });
    });
