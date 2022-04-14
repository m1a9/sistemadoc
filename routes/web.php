<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\CargoController;
use App\Http\Controllers\TipodocideController;
use App\Http\Controllers\TipodocumentoController;
use App\Http\Controllers\TiposolicitanteController;
use App\Http\Controllers\TipousuarioController;
use App\Http\Controllers\PaiseController;
use App\Http\Controllers\DepartamentoController;
use App\Http\Controllers\ProvinciaController;
use App\Http\Controllers\DistritoController;

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

Route::get('/', function () {
    return view('welcome');
 });


Route::get('/paises',[PaiseController::class,'index1']);
Route::resource('/pais',PaiseController::class);

Route::get('/departamentos',[DepartamentoController::class,'index1']);
Route::resource('/departamento',DepartamentoController::class);

Route::get('/provincias',[ProvinciaController::class,'index1']);
Route::resource('/provi',ProvinciaController::class);

Route::get('/distritos',[DistritoController::class,'index1']);
Route::resource('/distri',DistritoController::class);

Route::get('/categorias',[CategoriaController::class,'index1']);
Route::resource('categoria',CategoriaController::class);

Route::get('/cargos',[CargoController::class,'index1']);
Route::resource('cargo',CargoController::class);

Route::get('/documentoidentidad',[TipodocideController::class,'index1']);
Route::resource('documentoiden',TipodocideController::class);

Route::get('/tipodocumento',[TipodocumentoController::class,'index1']);
Route::resource('tipodoc',TipodocumentoController::class);

Route::get('/tiposolicitante',[TiposolicitanteController::class,'index1']);
Route::resource('tiposol',TiposolicitanteController::class);    

Route::get('/tipousuario',[TipousuarioController::class,'index1']);
Route::resource('tipousu',TipousuarioController::class);
