<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\DepartamentoController;
use App\Http\Controllers\ProvinciaController;
use App\Http\Controllers\AreaController;
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

Route::get('/paises/{id}/departamentos',[DepartamentoController::class,'byidpaises']);

Route::get('/departamentos/{id}/provincias',[ProvinciaController::class,'byiddepa']);

Route::get('/locales/{id}/areas',[AreaController::class,'getarea']);
