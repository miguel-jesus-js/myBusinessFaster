<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\ModulosController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\MarcasController;
use App\Http\Controllers\MaterialesController;
use App\Http\Controllers\CategoriasController;
use App\Http\Controllers\TipoClientesController;
use App\Http\Controllers\ProveedoresController;

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
Route::get('/dashboard', function () {
    return view('dashboard');
});
Route::get('/usuarios', function () {
    return view('usuarios');
});
Route::get('/marcas', function () {
    return view('marcas');
});
Route::get('/materiales', function () {
    return view('materiales');
});
Route::get('/categorias', function () {
    return view('categorias');
});
Route::get('/tipo_clientes', function () {
    return view('tipo_clientes');
});
Route::get('/proveedores', function () {
    return view('proveedores');
});

//
Route::get('api/getRoles', [RolesController::class, 'index']);
Route::get('api/getModulos', [ModulosController::class, 'index']);

//apis usuarios
Route::get('api/getUsuarios/{filtro}', [UsersController::class, 'index']);
Route::post('api/addUsuarios', [UsersController::class, 'create']);
Route::put('api/updateUsuarios', [UsersController::class, 'update']);
Route::delete('api/deleteUsuarios/{id}', [UsersController::class, 'delete']);
//apis marcas
Route::get('api/getMarcas/{filtro}', [MarcasController::class, 'index']);
Route::post('api/addMarcas', [MarcasController::class, 'create']);
Route::put('api/updateMarcas', [MarcasController::class, 'update']);
Route::delete('api/deleteMarcas/{id}', [MarcasController::class, 'delete']);
//apis materiales
Route::get('api/getMateriales/{filtro}', [MaterialesController::class, 'index']);
Route::post('api/addMateriales', [MaterialesController::class, 'create']);
Route::put('api/updateMateriales', [MaterialesController::class, 'update']);
Route::delete('api/deleteMateriales/{id}', [MaterialesController::class, 'delete']);
//apis categorias
Route::get('api/getCategorias/{filtro}', [CategoriasController::class, 'index']);
Route::post('api/addCategorias', [CategoriasController::class, 'create']);
Route::put('api/updateCategorias', [CategoriasController::class, 'update']);
Route::delete('api/deleteCategorias/{id}', [CategoriasController::class, 'delete']);
//apis tipo de clientes
Route::get('api/getTipoClientes/{filtro}', [TipoClientesController::class, 'index']);
Route::post('api/addTipoClientes', [TipoClientesController::class, 'create']);
Route::put('api/updateTipoClientes', [TipoClientesController::class, 'update']);
Route::delete('api/deleteTipoClientes/{id}', [TipoClientesController::class, 'delete']);
//apis proveedores
Route::get('api/getProveedores/{filtro}', [ProveedoresController::class, 'index']);
Route::post('api/addProveedores', [ProveedoresController::class, 'create']);
Route::put('api/updateProveedores', [ProveedoresController::class, 'update']);
Route::delete('api/deleteProveedores/{id}', [ProveedoresController::class, 'delete']);
// Route::group(['middleware' => 'auth'], function () {
//     //apis roles
    
// });