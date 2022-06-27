<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\ModulosController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\MarcasController;

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

// Route::group(['middleware' => 'auth'], function () {
//     //apis roles
    
// });