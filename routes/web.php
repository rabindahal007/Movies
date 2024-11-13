<?php
use App\Http\Controllers\MovieController;

// Show signup form
Route::get('/signup', [MovieController::class, 'signup'])->name('signup');
// Handle signup form submission
Route::post('/register', [MovieController::class, 'register'])->name('register');

// Show login form
Route::get('/logins', [MovieController::class, 'login'])->name('logins');
// Handle login form submission
Route::post('/login', [MovieController::class, 'authenticate'])->name('authenticate');

// Home page after successful login
Route::get('/home', [MovieController::class, 'home'])->name('home');

//main page
Route::get('/main', [MovieController::class, 'main'])->name('main');

// Logout route
Route::get('/logout', [MovieController::class, 'logout'])->name('logout');

