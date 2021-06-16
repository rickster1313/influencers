<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Models\User;

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

Route::get('/',[HomeController::class, 'index']);
Auth::routes();
Route::get("/home", [UserController::class, 'dashboard'])->middleware('auth')->name("dashboard");
Route::get("/logout",[UserController::class, 'sair']);
Route::get("/locations",[UserController::class, 'locs']);
Route::get("/loadinsta/{user}",[UserController::class, 'buscaInsta']);
Route::post("/completeInfluencer",[UserController::class, 'completarInfluencer']);
Route::post("/)",[UserController::class, 'completarEmpresario']);
Route::post("/novaproposta",[UserController::class, 'newproposta']);
Route::get("/cadastro-usuario",[UserController::class, 'selectUser']);
Route::get("/select/{id?}",[UserController::class, 'select']);
Route::post('/altUser', [UserController::class, 'editarusuario']);
Route::post('/altEmp', [UserController::class, 'editarempresario']);