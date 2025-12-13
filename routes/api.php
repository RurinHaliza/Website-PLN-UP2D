<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\PenyulangApiController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('penyulang-detail', [PenyulangApiController::class, 'penyulangDetail']);
Route::get('penyulangs-by-gardu', [PenyulangApiController::class, 'penyulangsByGardu']);
Route::get('trafo-by-ulp', [PenyulangApiController::class, 'trafoByUlp']);