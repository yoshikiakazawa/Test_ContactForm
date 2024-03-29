<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CsvDownloadController;

Route::get('/', [ContactController::class, 'index'])->name('contacts.main');
Route::post('/contacts/confirm', [ContactController::class, 'confirm'])->name('contacts.confirm');
Route::post('/contacts', [ContactController::class, 'store'])->name('contacts.store');
Route::get('/admin', [ContactController::class, 'admin'])->name('admin.main');
Route::delete('/admin/delete', [ContactController::class, 'destroy'])->name('admin.delete');
Route::get('/admin/search', [ContactController::class, 'search'])->name('admin.search');

// Route::get('/admin', [AuthController::class, 'admin']);
Route::middleware('auth')->group(function ()
{
    Route::get('/admin', [AuthController::class, 'admin'])->name('admin.main');
});

Route::get('/csv-download', [CsvDownloadController::class, 'downloadCsv'])->name('admin.csv');
Route::get('/register', [AuthController::class, 'register'])->name('admin.register');
