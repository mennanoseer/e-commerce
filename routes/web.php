<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ShopController;

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
// user home page
Route::get('/', [HomeController::class, 'index'])->name('home');

// admin dashboard
Route::get('/dashboard', [HomeController::class, 'dashboard'])->middleware('isAdmin')->name('admin.dashboard');


// login routes
Route::get('/login', [AuthController::class, 'login'])->name('auth.login');
Route::post('/login', [AuthController::class, 'authenticate'])->name('auth.authenticate');

// register routes
Route::get('/register', [AuthController::class, 'register'])->name('auth.register');
Route::post('/register', [AuthController::class, 'store'])->name('auth.store');

// logout route
Route::post('/logout', [AuthController::class, 'logout'])->name('auth.logout');

Route::prefix('admin')->middleware('isAdmin')->group(function () {
    Route::get('/categories', [CategoryController::class, 'index'])->name('admin.categories.index');
    Route::get('/categories/create', [CategoryController::class, 'create'])->name('admin.categories.create');
    Route::post('/categories', [CategoryController::class, 'store'])->name('admin.categories.store');
    Route::delete('/categories/{category}', [CategoryController::class, 'destroy'])->name('admin.categories.destroy');
    Route::get('/categories/{category}/edit', [CategoryController::class, 'edit'])->name('admin.categories.edit');
    Route::put('/categories/{category}', [CategoryController::class, 'update'])->name('admin.categories.update');
});

// User categories routes
Route::get('/categories', [ShopController::class, 'getCategories'])->name('user.categories.index');
Route::get('/categories/{category}/products', [ShopController::class, 'getProductsByCategory'])->name('user.categories.products');


// products routes
Route::resource('products', ProductController::class);

// user shop routes
Route::resource('shops', ShopController::class);

// search product by name
Route::get('/search', [ShopController::class, 'searchProductByName'])->name('products.search');