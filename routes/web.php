<?php

use App\Http\Controllers\YarnPurchaseController;
use App\Http\Controllers\YarnInventoryController;
use App\Http\Controllers\DyeingBatchController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\YarnController;
use App\Http\Controllers\SupplierController;

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/yarn', [YarnController::class, 'index'])->name('yarn.index');
Route::get('/yarn/create', [YarnController::class, 'create'])->name('yarn.create');
Route::post('/yarn', [YarnController::class, 'store'])->name('yarn.store');


Route::prefix('yarn')->group(function () {
    Route::prefix('purchase')->group(function () {
        Route::get('/', [YarnPurchaseController::class, 'index'])->name('yarn.purchase.index');
        Route::get('/create', [YarnPurchaseController::class, 'create'])->name('yarn.purchase.create');
        Route::post('/', [YarnPurchaseController::class, 'store'])->name('yarn.purchase.store');
    });

    Route::prefix('inventory')->group(function () {
        Route::get('/', [YarnInventoryController::class, 'index'])->name('yarn.inventory.index');
        Route::post('/movement', [YarnInventoryController::class, 'movement'])->name('yarn.inventory.movement');
        Route::get('/{id}/history', [YarnInventoryController::class, 'history'])->name('yarn.inventory.history');
    });
});

Route::prefix('dyeing')->group(function () {
    Route::get('/', [DyeingBatchController::class, 'index'])->name('dyeing.index');
    Route::get('/create', [DyeingBatchController::class, 'create'])->name('dyeing.create');
    Route::post('/', [DyeingBatchController::class, 'store'])->name('dyeing.store');
    Route::patch('/{batch}/status', [DyeingBatchController::class, 'updateStatus'])->name('dyeing.update-status');
});

Route::get('/department', [DepartmentController::class, 'index'])->name('department.index');
Route::post('/department', [DepartmentController::class, 'store'])->name('department.stor');
Route::resource('suppliers', SupplierController::class);

