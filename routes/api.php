<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CardsController;

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

Route::get('/cards', [CardsController::class, 'getList']);
Route::get('/cards/{id}', [CardsController::class, 'getById']);
Route::get('/AG{revision_id}/cards', [CardsController::class, 'getListByRevision']);
Route::get('/AG{revision_id}/cards/{literal_id}', [CardsController::class, 'getByRevisionAndLiteralId']);
