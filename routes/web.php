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

Route::get('/redirect', [HomeController::class, 'redirect'])->middleware('auth','verified');

Route::get('/logout', [LogoutController::class, 'logout']);

Route::get('/add_category', [AdminController::class, 'add_category']);

Route::post('/new_category', [AdminController::class, 'new_category']);

Route::get('/delete_category/{id}', [AdminController::class, 'delete_category']);

Route::get('/add_product', [AdminController::class, 'add_product']);

Route::post('/create_product', [AdminController::class, 'create_product']);

Route::get('/all_products', [AdminController::class, 'all_products']);

Route::get('/edit_product/{id}', [AdminController::class, 'edit_product']);

Route::post('/update_product/{id}', [AdminController::class, 'update_product']);

Route::get('/delete_product/{id}', [AdminController::class, 'delete_product']);

Route::get('/all_users', [AdminController::class, 'all_users']);

Route::get('/delete_user/{id}', [AdminController::class, 'delete_user']);

Route::get('/orders', [AdminController::class, 'orders']);

Route::get('/delivered/{id}', [AdminController::class, 'delivered']);

Route::get('/print_pdf/{id}', [AdminController::class, 'print_pdf']);

Route::get('/search', [AdminController::class, 'searchProduct']);

Route::get('/search_orders', [AdminController::class, 'searchOrders']);



Route::get('/product_details/{id}', [HomeController::class, 'product_details']);

Route::post('/add_cart/{id}', [HomeController::class, 'add_cart']);

Route::get('/show_cart', [HomeController::class, 'show_cart']);

Route::get('/remove_cart/{id}', [HomeController::class, 'remove_cart']);

Route::get('/cash_order', [HomeController::class, 'cash_order']);

Route::get('/stripe/{totalPrice}', [HomeController::class, 'stripe']);

Route::post('stripe/{totalPrice}', [HomeController::class, 'stripePost'])->name('stripe.post');

Route::get('/search_home', [HomeController::class, 'search_home']);

Route::get('/show_order', [HomeController::class, 'show_order']);

Route::get('/cancel_order/{id}', [HomeController::class, 'cancel_order']);

Route::get('/all_laptops', [HomeController::class, 'all_laptops']);

Route::get('/search_laptops', [HomeController::class, 'search_laptops']);

Route::get('/all_desktops', [HomeController::class, 'all_desktops']);

Route::get('/search_desktops', [HomeController::class, 'search_desktops']);

Route::get('/all_smartphones', [HomeController::class, 'all_smartphones']);

Route::get('/search_smartphones', [HomeController::class, 'search_smartphones']);

Route::get('/all_cameras', [HomeController::class, 'all_cameras']);

Route::get('/search_cameras', [HomeController::class, 'search_cameras']);

Route::get('/all_accessories', [HomeController::class, 'all_accessories']);

Route::get('/search_accessories', [HomeController::class, 'search_accessories']);

