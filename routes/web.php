<?php

use App\Http\Controllers\ImportController;
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

Route::prefix('excel')->middleware('auth.basicIn')->group(function ($route) {
    $route->post('upload', [ImportController::class, 'upload']);
    $route->get('getData', [ImportController::class, 'getImportedData']);
});
