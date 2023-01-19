<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemsController;
use App\Http\Controllers\OrdersController;



//Item Routes
Route::get('/items', [ItemsController::class, 'index']);
Route::post('/items', [ItemsController::class, 'store']);
Route::put('/item/update/{item}', [ItemsController::class, 'update']);
Route::delete('/item/delete/{item}', [ItemsController::class, 'destroy']);

//Order Routes
Route::get('/orders', [OrdersController::class, 'index']);
Route::get('/orders/{order}', [OrdersController::class, 'show']);
Route::post('/orders', [OrdersController::class, 'store']);
Route::put('/order/update/{order}', [OrdersController::class, 'update']);
Route::delete('/order/delete/{order}', [OrdersController::class, 'destroy']);