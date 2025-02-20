<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ListingController;

Route::resource('listings', ListingController::class)
    ->middleware('auth'); 
Route::get('/listings/{id}', [ListingController::class, 'show']);

    
Route::resource('comments', CommentController::class)->middleware('auth');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::post('/comments', [CommentController::class, 'store'])
    ->name('comments.store')
    ->middleware('auth');

   
       

    Route::middleware('auth')->group(function () {
        // Profile Routes
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    
    });
Route::get('/listings/{listing}/found', [ListingController::class, 'found'])
    ->name('listings.found');
Route::get('/listings/{listing}/lost', [ListingController::class, 'lost'])
    ->name('listings.lost');
Route::resource('categories', CategoryController::class);
Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');


Route::get('/profile', [ProfileController::class, 'show'])->name('profile');

require __DIR__.'/auth.php';
