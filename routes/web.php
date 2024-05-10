<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthManager;

// Route::get('/', function () {
//     return view('index');
// })->name('home');
Route::get('/', [AuthManager::class, 'index'])->name('index');
Route::get('/login', [AuthManager::class, 'login'])->name('login');
Route::post('/login', [AuthManager::class, 'loginPost'])->name('login.post');
Route::get('/logout', [AuthManager::class, 'logout'])->name('logout');
