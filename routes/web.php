<?php

use App\Http\Controllers\HistoryController;
use App\Http\Controllers\TodoController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\PesananController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\CartController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('admin.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Define the home route here

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/dashboard', [HomeController::class, 'dashboard'])->name('admin.dashboard');
    Route::get(
        '/admin/product',
        [ProductController::class, 'index']
    )->name('admin.product');
    Route::get('/user', [UserController::class, 'index'])->name('admin.user');
    Route::delete('/admin/user/{id}', [UserController::class, 'destroy'])->name('user.delete');
    Route::put('/admin/user/{id}', [UserController::class, 'update'])->name('user.update');
    Route::post('/menu', [MenuController::class, 'store'])->name('menu.post');
    Route::put('/menu/{id}', [MenuController::class, 'update'])->name('menu.update');
    Route::delete('/menu/{id}', [MenuController::class, 'destroy'])->name('menu.delete');
    //Route::get('/menu', [MenuController::class, 'index'])->name('admin.menu');
    // Route::get('/pesanan', [PesananController::class, 'index'])->name('admin.pesanan');

    Route::get('/menu', [MenuController::class, 'index'])->name('menu');
    // Route::post('/menu', [MenuController::class, 'store'])->name('menu.post');




    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/todo', [TodoController::class, 'index'])->name('todo');
    Route::post('/todo', [TodoController::class, 'store'])->name('todo.post');
    Route::put('/todo/{id}', [TodoController::class, 'update'])->name('todo.update');
    Route::delete('/todo/{id}', [TodoController::class, 'destroy'])->name('todo.delete');

    Route::get('/pesanan', [PesananController::class, 'index'])->name('pesanan');
});

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/dashboard', [HomeController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/admin/product', [ProductController::class, 'index'])->name('admin.product');
    Route::get('/user', [UserController::class, 'index'])->name('admin.user');
    Route::delete('/admin/user/{id}', [UserController::class, 'destroy'])->name('user.delete');
    Route::put('/admin/user/{id}', [UserController::class, 'update'])->name('user.update');
    Route::post('/menu', [MenuController::class, 'store'])->name('menu.post');
    Route::put('/menu/{id}', [MenuController::class, 'update'])->name('menu.update');
    Route::delete('/menu/{id}', [MenuController::class, 'destroy'])->name('menu.delete');
    //Route::get('/menu', [MenuController::class, 'index'])->name('admin.menu');
    // Route::get('/pesanan', [PesananController::class, 'index'])->name('admin.pesanan');

});

Route::get('admin/transaksi', [TransactionController::class, 'index'])->name('admin.transaction.index');
Route::post('/transaksi', [TransactionController::class, 'store'])->name('transaction.store');
Route::post('transaction/add-to-cart', [TransactionController::class, 'addToCart'])->name('transaction.addToCart');
Route::delete('/transaction/remove-from-cart', [TransactionController::class, 'removeFromCart'])->name('transaction.removeFromCart');
Route::get('transaction/cart', [TransactionController::class, 'showCart'])->name('admin.transaction.cart');
Route::middleware('auth')->group(function () {

    Route::get('/menu', [MenuController::class, 'index'])->name('menu');
    Route::get('/history', [HistoryController::class, 'index'])->name('history');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/pesanan', [PesananController::class, 'index'])->name('pesanan');
    Route::get('/user', [UserController::class, 'index'])->name('admin.user');
    Route::post('/update-cart', [CartController::class, 'updateCart'])->name('cart.update');
});



require __DIR__ . '/auth.php';
