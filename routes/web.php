<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\EmpleadosController;
use App\Http\Controllers\HerramientaController;
use App\Http\Controllers\ProyectoController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

/*Route::get('/', function () {
    return view('welcome');
});*/

Route::resource('empleados', EmpleadosController::class)->middleware('auth');
Route::view('/', 'login.index')->name('login')->middleware('guest');
//Route::view('register.blade.php', 'login.register');
Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout']);

Route::resource('proyectos', ProyectoController::class)->middleware('auth');

Route::resource('herramientas', HerramientaController::class)->middleware('auth');

//Route::post('register', [LoginController::class, 'register']);



Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);
