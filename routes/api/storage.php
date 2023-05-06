<?php
use Illuminate\Support\Facades\Route;

Route::prefix('storage')->controller(\App\Http\Controllers\StorageController::class)
    ->group(function() {

        Route::get('fields/{flow}', 'fields')
            ->can('flow', 'read');

        Route::post('/installation/{installation}/field/{flowStorageField}', 'store')
            ->can('read', 'installation')
            ->can('read', 'flowStorageField')
            ->can('store', \App\Models\StorageValue::class);

        Route::get('/installation/{installation}/field/{flowStorageField}', 'getValue')
            ->can('read', 'installation')
            ->can('read', 'flowStorageField')
            ->can('read', \App\Models\StorageValue::class);

    });
