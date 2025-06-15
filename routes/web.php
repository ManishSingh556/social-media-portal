<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FriendController;
Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


     Route::get('/users/index', [UserController::class, 'index'])->name('users.index');
Route::get('/users/edit', [UserController::class, 'edit'])->name('users.edit');

    Route::post('/users', [UserController::class, 'update'])->name('users.update');
   


    Route::get('/friends/search', [FriendController::class, 'search'])->name('friends.search');
    Route::post('/friends/send/{id}', [FriendController::class, 'send'])->name('friends.send');
    Route::get('/friends/incoming', [FriendController::class, 'incoming'])->name('friends.incoming');
    Route::post('/friends/respond/{id}', [FriendController::class, 'respond'])->name('friends.respond');
    Route::get('/friends/list', [FriendController::class, 'list'])->name('friends.list');
    Route::delete('/friends/remove/{id}', [FriendController::class, 'remove'])->name('friends.remove');
});






require __DIR__.'/auth.php';
