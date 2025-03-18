<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ExportController;
use App\Http\Controllers\ProductController;

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

Route::get('/', [PageController::class, 'getIndex']);
Route::get('/type/{id}', [PageController::class, 'getLoaiSp']);
Route::get('/contact', [PageController::class, 'showContact']);
Route::get('/aboutus', [PageController::class, 'showAbout']);
Route::get('/add_to_cart', [PageController::class, 'addCart'])->name('themgiohang');

Route::get('/detail/{id}', [PageController::class, 'productDetail'])->name('page.detail');
Route::get('/admin/products', [AdminController::class, 'showProducts'])->name('pageadmin.admin');
Route::get('/export', [ExportController::class, 'export'])->name('export');
Route::get('/admin/add-product', [AdminController::class, 'create'])->name('add-product');
Route::post('/admin-add-form', [AdminController::class, 'postAdd']);

Route::get('/admin-edit-form/{id}', [AdminController::class, 'getEdit'])->name('pageadmin.formEdit');
Route::post('/admin-edit', [AdminController::class, 'postEdit'])->name('admin-edit');

Route::post('/admin-delete/{id}', [AdminController::class, 'adminDelete']);
