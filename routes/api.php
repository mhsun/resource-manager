<?php

use App\Http\Controllers\API\AttachmentController;
use App\Http\Controllers\API\LinkController;
use App\Http\Controllers\API\SnippetController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::prefix('v1')->group(function () {
    Route::apiResource('/attachments', AttachmentController::class);
    Route::apiResource('/snippets', SnippetController::class)->except('show');
    Route::apiResource('/links', LinkController::class)->except('show');
});
