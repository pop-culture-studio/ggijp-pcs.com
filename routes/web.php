<?php

use App\Http\Controllers\AuthorController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\Dashboard\ContactController;
use App\Http\Controllers\Dashboard\ContactPreviewController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\MaterialsController;
use App\Http\Controllers\MaterialController;
use Illuminate\Support\Facades\Route;

Route::view(uri: '/', view: 'home')->name('home');

Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {
    Route::get('/dashboard', DashboardController::class)->name('dashboard');

    Route::get('dashboard/materials', MaterialsController::class)
        ->name('dashboard.materials')
        ->can('pcs');

    Route::get('dashboard/contacts', ContactController::class)
        ->name('dashboard.contacts')
        ->can('admin');
});

Route::get('contact/preview/{contact}', ContactPreviewController::class)
    ->name('contact.preview')
    ->middleware('signed');

Route::get('author/{author}', AuthorController::class)->name('author');

Route::resource('material', MaterialController::class)
    ->only(['index', 'show']);

Route::resource('material', MaterialController::class)
    ->only(['edit', 'update', 'destroy'])
    ->middleware(['auth:sanctum']);

Route::get('category/{category}', CategoryController::class)->name('category.show');
Route::redirect('category', '/');

Route::feeds();
