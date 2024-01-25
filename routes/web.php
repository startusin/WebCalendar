<?php

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

    Route::get('/calendar/{user}', [App\Http\Controllers\HomeController::class, 'index'])->name('index');
    Route::get('/calendar/slots/{user}', [App\Http\Controllers\HomeController::class, 'slots'])->name('slots');

    Route::get('/calendar/settings/edit', [App\Http\Controllers\CalendarSettingsController::class, 'edit'])->name('calendarSettings.edit');
    Route::put('/calendar/settings/update', [App\Http\Controllers\CalendarSettingsController::class, 'update'])->name('calendarSettings.update');

    Route::get('/checkprice', [\App\Http\Controllers\PurchaseController::class, 'checkprice'])->name('checkprice');
    Route::get('/purchase', [\App\Http\Controllers\PurchaseController::class, 'index'])->name('purchase');
    Route::post('/makeSlot', [\App\Http\Controllers\PurchaseController::class, 'makeSlot'])->name('makeSlot');

    Route::get('/checkPromocode', [\App\Http\Controllers\PromocodeController::class, 'checkPromocode'])->name('checkPromocode');

    Route::group(['middleware' => 'auth'], function (){
        Route::group(['prefix' => 'user', 'middleware' => 'admin'], function () {
            Route::get('/', [\App\Http\Controllers\UserController::class, 'index'])->name('admin.user.index');
            Route::get('create', [\App\Http\Controllers\UserController::class, 'create'])->name('admin.user.create');
            Route::post('store', [\App\Http\Controllers\UserController::class, 'store'])->name('admin.user.store');
            Route::get('show/{user}', [\App\Http\Controllers\UserController::class, 'show'])->name('admin.user.show');
            Route::get('edit/{user}', [\App\Http\Controllers\UserController::class, 'edit'])->name('admin.user.edit');
            Route::put('update', [\App\Http\Controllers\UserController::class, 'update'])->name('admin.user.update');
            Route::delete('delete/{user}', [\App\Http\Controllers\UserController::class, 'delete'])->name('admin.user.delete');
        });

        Route::group(['middleware' => 'customer'], function () {
            Route::group(['prefix' => 'slots'], function () {
                Route::get('', [\App\Http\Controllers\SlotController::class, 'index'])->name('customer.slot.index');
                Route::get('show/{id}', [\App\Http\Controllers\SlotController::class, 'show'])->name('customer.slot.show');
                Route::get('create', [\App\Http\Controllers\SlotController::class, 'create'])->name('customer.slot.create');
                Route::get('edit/{id}', [\App\Http\Controllers\SlotController::class, 'edit'])->name('customer.slot.edit');
                Route::post('store', [\App\Http\Controllers\SlotController::class, 'store'])->name('customer.slot.store');
                Route::put('update', [\App\Http\Controllers\SlotController::class, 'update'])->name('customer.slot.update');
                Route::delete('delete/{id}', [\App\Http\Controllers\SlotController::class, 'delete'])->name('customer.slot.delete');

            });

            Route::group(['prefix' => 'product'],function (){
                Route::get('/', [\App\Http\Controllers\ProductController::class, 'index'])->name('customer.product.index');
                Route::get('show/{id}', [\App\Http\Controllers\ProductController::class, 'show'])->name('customer.product.show');
                Route::get('create', [\App\Http\Controllers\ProductController::class, 'create'])->name('customer.product.create');
                Route::get('edit/{id}', [\App\Http\Controllers\ProductController::class, 'edit'])->name('customer.product.edit');
                Route::post('store', [\App\Http\Controllers\ProductController::class, 'store'])->name('customer.product.store');
                Route::put('update', [\App\Http\Controllers\ProductController::class, 'update'])->name('customer.product.update');
                Route::delete('delete/{id}', [\App\Http\Controllers\ProductController::class, 'delete'])->name('customer.product.delete');
            });

            Route::group(['prefix' => 'promocode'], function () {
                Route::get('/', [\App\Http\Controllers\PromocodeController::class, 'index'])->name('customer.promocode.index');
                Route::get('show/{id}', [\App\Http\Controllers\PromocodeController::class, 'show'])->name('customer.promocode.show');
                Route::get('create', [\App\Http\Controllers\PromocodeController::class, 'create'])->name('customer.promocode.create');
                Route::get('edit/{id}', [\App\Http\Controllers\PromocodeController::class, 'edit'])->name('customer.promocode.edit');
                Route::post('store', [\App\Http\Controllers\PromocodeController::class, 'store'])->name('customer.promocode.store');
                Route::put('update', [\App\Http\Controllers\PromocodeController::class, 'update'])->name('customer.promocode.update');
                Route::delete('delete/{id}', [\App\Http\Controllers\PromocodeController::class, 'delete'])->name('customer.promocode.delete');
            });

        });
    });

    Auth::routes();

