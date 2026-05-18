<?php

use App\Http\Controllers\InvoiceController;
use Illuminate\Support\Facades\Route;

Route::get('/', [InvoiceController::class, 'index']);
Route::get('invoice', [InvoiceController::class, 'invoice'])->name('invoice');
