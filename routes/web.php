<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SpaController;
use App\Http\Controllers\SpaApiController;

Route::get('/', [SpaController::class, 'index'])->name('app');

Route::post('/auth/login', [AuthController::class, 'login'])->name('auth.login');
Route::post('/auth/logout', [AuthController::class, 'logout'])->name('auth.logout');

Route::middleware('auth')->prefix('api')->group(function () {
    Route::get('/bootstrap', [SpaApiController::class, 'bootstrap'])->name('api.bootstrap');

    Route::post('/products', [SpaApiController::class, 'storeProduct'])->name('api.products.store');
    Route::put('/products/{product}', [SpaApiController::class, 'updateProduct'])->name('api.products.update');
    Route::delete('/products/{product}', [SpaApiController::class, 'deleteProduct'])->name('api.products.delete');

    Route::post('/stock/in', [SpaApiController::class, 'stockIn'])->name('api.stock.in');
    Route::post('/stock/out', [SpaApiController::class, 'stockOut'])->name('api.stock.out');

    Route::post('/invoices', [SpaApiController::class, 'storeInvoice'])->name('api.invoices.store');
    Route::patch('/invoices/{invoice}/status', [SpaApiController::class, 'updateInvoiceStatus'])->name('api.invoices.status');
    Route::delete('/invoices/{invoice}', [SpaApiController::class, 'deleteInvoice'])->name('api.invoices.delete');
});
