<?php

use App\Http\Controllers\LoggingController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('logging-demo');
});

Route::prefix('logging-demo')->group(function () {
    // Route::get('/', function () {
    //     return view('logging-demo');
    // });
    
    Route::get('/levels', [LoggingController::class, 'demonstrateLogLevels']);
    Route::get('/contextual', [LoggingController::class, 'demonstrateContextualLogging']);
    Route::get('/performance', [LoggingController::class, 'demonstratePerformanceLogging']);
    Route::get('/exceptions', [LoggingController::class, 'demonstrateExceptionLogging']);
    Route::get('/security', [LoggingController::class, 'demonstrateSecurityLogging']);
    Route::get('/channels', [LoggingController::class, 'demonstrateChannelLogging']);
    Route::get('/structured', [LoggingController::class, 'demonstrateStructuredLogging']);
});
