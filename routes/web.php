<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LogoutController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [HomeController::class, 'index']);

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::get('/redirect', [HomeController::class, 'redirect']);

Route::get('/logout', [LogoutController::class, 'logout']);

Route::get('/admin_dashboard', [AdminController::class, 'admin_dashboard']);

Route::get('/add_category', [AdminController::class, 'add_category']);

Route::post('/new_category', [AdminController::class, 'new_category']);

Route::get('/delete_category/{id}', [AdminController::class, 'delete_category']);

Route::get('/add_product', [AdminController::class, 'add_product']);

Route::post('/create_product', [AdminController::class, 'create_product']);

Route::get('/all_products', [AdminController::class, 'all_products']);

Route::get('/edit_product/{id}', [AdminController::class, 'edit_product']);
