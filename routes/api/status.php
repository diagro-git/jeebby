<?php
use Illuminate\Support\Facades\Route;

Route::prefix('status/team/{team}/flow/{flow}')
    ->scopeBindings()
    ->controller(\App\Http\Controllers\StatusController::class)
    ->group(function() {
        Route::post('/', 'store')->middleware('ability:monitor:write');
    });
