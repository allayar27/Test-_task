<?php

use App\Http\Controllers\CategoryController;
use App\Http\Livewire\CategorySection;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', CategorySection::class)->name('home');

Route::get('/create_category', [CategoryController::class, 'index'])->name('category.create');

Route::post('/category_store', [CategoryController::class, 'store'])->name('category.store');
Route::get('/category_edit/{category}', [CategoryController::class, 'edit'])->name('category.edit');
Route::patch('/category_update/{category}', [CategoryController::class, 'update'])->name('category.update');