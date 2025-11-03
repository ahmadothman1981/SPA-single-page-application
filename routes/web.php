<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\ListingController;
use App\Http\Controllers\UserAccountController;
use App\Http\Controllers\RealtorListingController;
use App\Http\Controllers\RealtorListingImageController;
    


Route::get('/', [IndexController::class, 'index']);
Route::get('/show', [IndexController::class, 'show']);
Route::resource('/listings', ListingController::class)->only(['index' , 'show']);
Route::get('/login', [AuthController::class, 'create'])->name('login');
Route::post('/login', [AuthController::class, 'store'])->name('login.store');
Route::post('/logout', [AuthController::class, 'destroy'])->name('logout');

Route::get('/register' ,[UserAccountController::class , 'create'])->name('register');
Route::post('/register' ,[UserAccountController::class , 'store'])->name('register.store');

Route::prefix('realtor')->name('realtor.')->middleware('auth')
    ->group(function()
    {
        Route::put('listings/{listing}/restore', [RealtorListingController::class, 'restore'])
            ->name('listings.restore')->withTrashed();
        ; 
        Route::resource('listings', RealtorListingController::class)
        ->only(['index','edit','update','create','store','destroy'])
        ->withTrashed();

       Route::get('listings/{listing}/images/create', [RealtorListingImageController::class, 'create'])
    ->name('listings.images.create');
    Route::post('listings/{listing}/images', [RealtorListingImageController::class, 'store'])
    ->name('listings.images.store');

    }
);