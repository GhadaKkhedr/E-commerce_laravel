<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth as Authenticator;
use App\Http\Controllers\Controller;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\sellerController;
use App\Models\product;
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

//Route::get('/', function () {    return view('home');})->name("home");

Route::get('/Register', [RegisterController::class, 'Register_get'])->name('Register');
Route::post('/Register', [RegisterController::class, 'Register'])->name('Register_route');

Route::get('/Login', [LoginController::class, 'login_get'])->name('login');
Route::post('/Login', [LoginController::class, 'login'])->name('login');

FacadesAuth::routes();
app('router')->getRoutes()->refreshNameLookups();
app('router')->getRoutes()->refreshActionLookups();


Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/', [HomeController::class, 'index'])->name('home');

Route::name('home.addCategory')->post('/home/addCat', [CategoryController::class, 'store']);
Route::name('home.editCategory')->post('/home/editCat/{id}', [CategoryController::class, 'edit']);
Route::name('home.deleteCategory')->post('/home/deleteCat/{id}', [CategoryController::class, 'destroy']);



Route::name('seller.addProduct')->post('/seller/addProd', [ProductController::class, 'store']);
Route::name('seller.editProduct')->post('/seller/editProd/{id}', [ProductController::class, 'edit']);
Route::name('seller.deleteProduct')->post('/seller/deleteProd/{id}', [ProductController::class, 'destroy']);

Route::get('/search', [ProductController::class, 'filter'])->name('search');
