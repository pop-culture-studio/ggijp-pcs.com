<?php

use App\Http\Controllers\AuthorController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CreatorController;
use App\Http\Controllers\Dashboard\ContactController;
use App\Http\Controllers\Dashboard\ContactPreviewController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\MaterialsController;
use App\Http\Controllers\DownloadController;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\SitemapController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::view(uri: '/', view: 'home')->name('home');

Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {
    Route::get('/dashboard', DashboardController::class)->name('dashboard');

    Route::get('dashboard/materials', MaterialsController::class)->name('dashboard.materials');

    Route::get('dashboard/contacts', ContactController::class)->name('dashboard.contacts')->can('admin');
});

Route::get('contact/preview/{contact}', ContactPreviewController::class)
    ->name('contact.preview')
    ->middleware('signed');

Route::get('author/{author}', AuthorController::class)->name('author');

Route::resource('material', MaterialController::class);

Route::get('download/{material}', DownloadController::class)->name('download')->middleware('signed');

Route::get('category/{category}', CategoryController::class)->name('category.show');
Route::redirect('category', '/');

Route::feeds();
