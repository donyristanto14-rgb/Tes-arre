<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Middleware\PreventAuthenticatedPageCaching;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->to(route('products.index', absolute: false));
})->name('home');

Route::middleware(['auth', PreventAuthenticatedPageCaching::class])->group(function () {
    Route::get('/dashboard', DashboardController::class)->name('dashboard');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('products', ProductController::class);
});

require __DIR__.'/auth.php';
