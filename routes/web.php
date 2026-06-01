<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SubscriberController;
use App\Http\Controllers\ThemeController;
use App\Http\Controllers\ContactController;
//pages
Route::controller(ThemeController::class)->name('theme.')->group(function () {
    Route::get('/', 'index')->name('index');
    Route::get('/category/{id}', 'category')->name('category');
    Route::get('/contact', 'contact')->name('contact');
   
    
});
//subscriber and contact
Route::post('/subscribe', [SubscriberController::class, 'subscribe'])->name('subscribe');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');
//blogs
Route::resource('blogs', \App\Http\Controllers\BlogController::class)->middleware('auth');
Route::get('/myblogs', [\App\Http\Controllers\BlogController::class, 'myblogs'])->middleware('auth');
//comments
Route::post('/comments/{blog}', [\App\Http\Controllers\CommentController::class, 'store'])->name('comments.store');
















require __DIR__ . '/auth.php';
