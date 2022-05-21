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
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\PerfilController;

use App\User;


use App\Http\Controllers\LocalController;
use App\Http\Controllers\AreaController;

use App\Http\Controllers\ArchivoController;
use App\Http\Controllers\DocumentoController;
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

Route::group(['middleware' => 'auth'], function () {

    Route::get('/usuarios',[UsuarioController::class,'index1']);
    Route::resource('/usu',UsuarioController::class);
    
    Route::get('/home',[HomeController::class,'index'])->name('home.index');
    
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


    Route::get('/locales',[LocalController::class,'index1']);
    Route::resource('local',LocalController::class);

    Route::get('/areas',[AreaController::class,'index1']);
    Route::resource('area',AreaController::class);

    Route::get('/archivos',[ArchivoController::class,'index1']);
    Route::resource('archivo',ArchivoController::class);

    
    Route::get('/regdocumento',[DocumentoController::class,'index1']);
    Route::resource('documento',DocumentoController::class);

});
Route::get('/login',[SessionController::class,'create'])->name('login.index');
Route::post('/login',[SessionController::class,'store'])->name('login.store');
Route::get('/logout',[SessionController::class,'destroy'])->name('login.destroy');

//Route::get('/perfil',[PerfilController::class,'index1']);
Route::resource('perfils',PerfilController::class);
Route::put('/perfilss/{id}',[PerfilController::class,'store'])->name('perfilss.store');









