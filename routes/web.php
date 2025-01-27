<?php

use App\Http\Controllers\admin\BookControler;
use App\Http\Controllers\admin\BorrowController;
use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\user\BookController;
use App\Http\Controllers\user\BorrowController as UserBorrowController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('guest')->group( function(){
    Route::get('/login', function(){
        return view('login.page');
    })->name('login');
    Route::get('/register', function(){
        return view('login.register_page');
    })->name('register');
});

Route::post('/login/submit', [LoginController::class, 'authenticate'])->name('login.submit');
Route::post('/register/submit', [LoginController::class, 'register'])->name('register.submit');
Route::post('/logout/submit', [LoginController::class, 'logout'])->name('logout.submit');




Route::middleware(['auth', 'role:admin'])->group(function (){
    Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    // Buku
    Route::get('/admin/buku', [BookControler::class, 'index'])->name('admin.book.index');
    Route::post('/admin/buku/submit', [BookControler::class, 'store_book'])->name('admin.book.store');
    Route::delete('/admin/buku/delete/{id}', [BookControler::class, 'destroy_book'])->name('admin.book.destroy');
    Route::put('/admin/buku/update/{id}', [BookControler::class, 'update_book'])->name('admin.book.update');

    // Kategori Buku
    Route::post('/admin/buku/submit/kategori', [BookControler::class, 'submit_kategori'])->name('admin.book.submit.kategori');
    Route::delete('/admin/buku/destroy/kategori/{id}', [BookControler::class, 'destroy_category'])->name('admin.book.destroy.kategori');
    Route::put('/admin/buku/update/kategori/{id}', [BookControler::class, 'update_category'])->name('admin.book.update.kategori');

    // Peminjaman
    Route::get('/admin/peminjaman', [BorrowController::class, 'index'])->name('admin.borrow.index');
});

Route::middleware(['auth', 'role:user'])->group(function(){
    Route::get('/user/buku', [BookController::class, 'index'])->name('user.book.index');
    Route::get('/user/peminjaman', [UserBorrowController::class, 'index'])->name('user.borrow.index');
    Route::get('/user/peminjaman/submit', [UserBorrowController::class, 'store'])->name('user.borrow.store');
    Route::put('/user/peminjaman/update/{id}', [UserBorrowController::class, 'update'])->name('user.borrow.update');
});
