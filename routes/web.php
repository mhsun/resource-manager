<?php

use App\Http\Controllers\ManagementController;
use App\Http\Controllers\VisitorController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::redirect('/', '/attachments');

Route::get('/attachments', [VisitorController::class, 'attachments']);
Route::get('/attachments/{attachment}/download', [VisitorController::class, 'downloadAttachment'])
    ->name('attachment.download');
Route::get('/snippets', [VisitorController::class, 'snippets']);
Route::get('/links', [VisitorController::class, 'links']);

Route::prefix('administrator')->group(function () {
    Route::get('/attachments', [ManagementController::class, 'attachments']);
    Route::get('/snippets', [ManagementController::class, 'snippets']);
    Route::get('/links', [ManagementController::class, 'links']);
});

Route::fallback(function () {
    return redirect()->to('/attachments');
});
