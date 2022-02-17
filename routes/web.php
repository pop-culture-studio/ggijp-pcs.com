<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CreatorController;
use App\Http\Controllers\Dashboard\ContactController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\MaterialsController;
use App\Http\Controllers\DownloadController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MaterialController;
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

Route::get('/', HomeController::class)->name('home');

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('/dashboard', DashboardController::class)->name('dashboard');

    Route::get('dashboard/materials', MaterialsController::class)->name('dashboard.materials');

    Route::get('dashboard/contacts', ContactController::class)->name('dashboard.contacts')->can('admin');
});

Route::get('creator/{user}', CreatorController::class)->name('creator');

Route::resource('material', MaterialController::class);

Route::get('download/{material}', DownloadController::class)->name('download')->middleware('signed');

Route::resource('category', CategoryController::class)->only(['index', 'show']);

Route::view('contact', 'contact')->name('contact');
Route::view('license', 'license')->name('license');
