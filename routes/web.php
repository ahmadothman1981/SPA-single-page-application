<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\ListingController;
use App\Http\Controllers\UserAccountController;
use App\Http\Controllers\RealtorListingController;

Route::get('/', [IndexController::class, 'index']);
Route::get('/show', [IndexController::class, 'show']);
Route::resource('/listings', ListingController::class)->only(['create', 'store', 'edit', 'update'])->middleware('auth');
Route::resource('/listings', ListingController::class)->only(['index' , 'show']);
Route::get('/login', [AuthController::class, 'create'])->name('login');
Route::post('/login', [AuthController::class, 'store'])->name('login.store');
Route::post('/logout', [AuthController::class, 'destroy'])->name('logout');

Route::get('/register' ,[UserAccountController::class , 'create'])->name('register');
Route::post('/register' ,[UserAccountController::class , 'store'])->name('register.store');

Route::prefix('realtor')->name('realtor.')->middleware('auth')->group(
    function(){
        Route::resource('listings', RealtorListingController::class)->only(['index','destroy']);

    }
);