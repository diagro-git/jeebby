<?php
use Illuminate\Support\Facades\Route;

Route::prefix('storage')->controller(\App\Http\Controllers\StorageController::class)
    ->group(function() {

        Route::get('fields/{flow}', 'fields')->middleware('ability:storage:read');

        Route::prefix('/team/{team}/flow/{flow}/field/{flowStorageField:name}')
            ->group(function() {
                Route::post('/', 'store')->middleware('ability:storage:write');

                Route::middleware('ability:storage-read')->group(function() {
                    Route::get('/last-value', 'lastValue');
                    Route::get('/from/{from}/to/{to}/{aggregation}', 'betweenDates');
                    Route::get('/today/{aggregation}', 'today');
                    Route::get('/yesterday/{aggregation}', 'yesterday');
                    Route::get('/today-yesterday/{aggregation}', 'todayYesterday');
                });
            });

    });
