<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;
use App\Http\Controllers\OwnerController;
use App\Http\Controllers\CarController;

// Nuotraukos ištrynimo maršrutas
Route::get('/photos/{photo}/destroy', [CarController::class, 'destroyPhoto'])->name('photos.destroy');

// Jūsų standartinis automobilių resource maršrutas (jei dar nėra)
Route::resource('cars', CarController::class);


Route::resource('cars', CarController::class)->middleware('auth');

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

Route::resource('owners', OwnerController::class)->middleware('auth');

require __DIR__.'/auth.php';
