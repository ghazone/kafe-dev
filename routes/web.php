<?php

// use App\Http\Controllers\TodoController;

use App\Http\Controllers\MenuController;
use App\Http\Controllers\PesananController;
use App\Http\Controllers\TodoController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/todo', function () {
//     return view("todo.app");
// });

Route::get('/todo', [TodoController::class, 'index'])->name('todo');
Route::post('/todo', [TodoController::class, 'store'])->name('todo.post');
Route::put('/todo/{id}', [TodoController::class, 'update'])->name('todo.update');
Route::delete('/todo/{id}', [TodoController::class, 'destroy'])->name('todo.delete');

Route::get('/pesanan', [PesananController::class, 'index'])->name('pesanan');

Route::get('/menu', [MenuController::class, 'index'])->name('Menu');