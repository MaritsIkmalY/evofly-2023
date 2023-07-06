<?php

use App\Http\Controllers\Education\ArticleController;
use App\Http\Controllers\Education\VideoController;
use App\Http\Controllers\Education\WebinarController;
use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::middleware('admin')->group(function () {
        Route::resource('/webinar', WebinarController::class)->only('store', 'update', 'destroy');
        Route::resource('/article', ArticleController::class)->only('store', 'update', 'destroy');
        Route::resource('/video', VideoController::class)->only('store', 'update', 'destroy');
    });
});

Route::resource('/webinar', WebinarController::class)->only('index', 'show');
Route::resource('/article', ArticleController::class)->only('index', 'show');
Route::resource('/video', VideoController::class)->only('index', 'show');

require __DIR__.'/auth.php';
