<?php

use App\Http\Controllers\Api\ApiProductController;
use App\Http\Controllers\Dashboard\TransactionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::get('products', [ApiProductController::class, 'index']);

Route::prefix('transactions')->group(function() {
    Route::get('{sale:uuid}', [TransactionController::class, 'getSaleDetail'])->name('api.transactions.get-sale-by-uuid');
    Route::post('{sale:uuid}/add-product', [TransactionController::class, 'addProduct'])->name('api.transactions.add-product');
    Route::put('{sale:uuid}/update-product', [TransactionController::class, 'updateProduct'])->name('api.transactions.update-product');
    Route::delete('{sale:uuid}/delete-product', [TransactionController::class, 'deleteProduct'])->name('api.transactions.delete-product');
    Route::put('{sale:uuid}/apply-discount', [TransactionController::class, 'applyDiscount'])->name('api.transactions.apply-discount');
    Route::put('{sale:uuid}/apply-cash', [TransactionController::class, 'applyCash'])->name('api.transactions.apply-cash');
    Route::put('{sale:uuid}/reset-transaction', [TransactionController::class, 'resetTransaction'])->name('api.transactions.reset-transaction');
});
