<?php

use App\Http\Controllers\TodoController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\PesananController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/dashboard', [HomeController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/admin/product', [ProductController::class, 'index'])->name('admin.product');
    Route::get('/admin/products/create', [ProductController::class, 'create'])->name('admin.product.create');
    Route::post('/admin/products/save', [ProductController::class, 'save'])->name('admin.product.save');

    Route::get('/admin/menu', [MenuController::class, 'index'])->name('admin.menu');
    Route::post('/admin/menu', [MenuController::class, 'store'])->name('admin.menu.post');
    Route::put('/admin/menu/{id}', [MenuController::class, 'update'])->name('admin.menu.update');
    Route::delete('/admin/menu/{id}', [MenuController::class, 'destroy'])->name('admin.menu.delete');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/todo', [TodoController::class, 'index'])->name('todo');
    Route::post('/todo', [TodoController::class, 'store'])->name('todo.post');
    Route::put('/todo/{id}', [TodoController::class, 'update'])->name('todo.update');
    Route::delete('/todo/{id}', [TodoController::class, 'destroy'])->name('todo.delete');

    Route::get('/pesanan', [PesananController::class, 'index'])->name('pesanan');
    Route::get('/menu', [MenuController::class, 'index'])->name('menu');

});

Route::middleware(['auth', 'user'])->group(function () {
    Route::get('/user/homepage',[HomeController::class,'homepage'])->name('user.homepage');

});

require __DIR__ . '/auth.php';
