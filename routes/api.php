<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Products\ShowProductController;
use App\Http\Controllers\Api\Products\IndexProductController;
use App\Http\Controllers\Api\Products\StoreProductController;
use App\Http\Controllers\Api\Products\DeleteProductController;
use App\Http\Controllers\Api\Products\UpdateProductController;

Route::prefix('products')
    ->name('products.')
    ->group(function () : void {
        Route::get('/', IndexProductController::class)->name('index');
        Route::get('{product}', ShowProductController::class)->name('show');
        Route::post('/', StoreProductController::class)->name('store');
        Route::put('{product}', UpdateProductController::class)->name('update');
        Route::delete('{product}', DeleteProductController::class)->name('destroy');
    });
