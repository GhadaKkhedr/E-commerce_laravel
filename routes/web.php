<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth as Authenticator;
use App\Http\Controllers\Controller;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Auth as FacadesAuth;

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

Route::get('/', function () {
    return view('home');
})->name("home");

Route::get('/Register', [RegisterController::class, 'Register_get'])->name('Register');
Route::post('/Register', [RegisterController::class, 'Register'])->name('Register_route');

Route::get('/Login', [LoginController::class, 'login_get'])->name('login');
Route::post('/Login', [LoginController::class, 'login'])->name('login');

FacadesAuth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');


Route::post('/home', [CategoryController::class, 'store'])->name('home.addCategory');
Route::post('/home', [CategoryController::class, 'update'])->name('home.editCategory');
Route::post('/home', [CategoryController::class, 'destroy'])->name('home.deleteCategory');
