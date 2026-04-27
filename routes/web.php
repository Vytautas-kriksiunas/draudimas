<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;
use App\Http\Controllers\OwnerController;
use App\Http\Controllers\CarController;

Route::resource('cars', CarController::class)->middleware('auth');

Route::middleware('admin')->group(function () {
    Route::resource('cars', CarController::class)
        ->only(['create', 'store', 'edit', 'update', 'destroy']);
});

Route::get('/lang/{locale}', function ($locale) {
    session(['locale' => $locale]);
    return redirect('/');
});

Route::resource('owners', OwnerController::class);

Route::get('/', function () {
    return redirect()->route('owners.index');
})->name('home');

Route::get('/dashboard', function() {
    return redirect()->route('owners.index');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
});

require __DIR__.'/auth.php';
