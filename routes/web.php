<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

Route::middleware('auth')->group(function () {

    // My Dashboard
    //Route::view('dash', 'dash')->name('dash');

    // Dash
    Route::get('/dashboard', \App\Livewire\App\Dashboard\Dash::class)->name('dashboard');

    // MyTodo
    Route::get('/todo', \App\Livewire\App\Todo\Todo::class)->name('todo');

    // MyWorkout
    Route::get('/workout', \App\Livewire\App\Workout\Workout::class)->name('workout');

    // MyFoods
    Route::get('/food', \App\Livewire\App\Food\Food::class)->name('food');

    // MyEco
    Route::get('/eco', \App\Livewire\App\Economy\Ecoonomy::class)->name('eco');

    // Links
    Route::get('/link', \App\Livewire\App\Link\Link\Link::class)->name('link');

    // Notes
    Route::get('/notes', \App\Livewire\App\Note\SmallNotes::class)->name('note');

    // Planing
    Route::get('/plan', \App\Livewire\App\Planing\Planing::class)->name('plan');

});

require __DIR__.'/auth.php';
