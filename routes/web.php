<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\LoanController;

Route::redirect('/', '/books');

Route::patch('loans/{id}/kembalikan', [LoanController::class, 'kembalikan'])->name('loans.kembalikan');
Route::resource('books', BookController::class);
Route::resource('categories', CategoryController::class)->except(['show']);
Route::resource('members', MemberController::class);
Route::resource('loans', LoanController::class);