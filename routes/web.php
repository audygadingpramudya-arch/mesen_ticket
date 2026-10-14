<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventsController;
use App\Http\Controllers\DetailsController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProfileController;
use App\Models\Events;

// Halaman utama (katalog tiket untuk customer)
Route::get('/', function () {
    $events = Events::latest()->paginate(10);

    return view('welcome', compact('events'));
})->name('home');

// Checkout
Route::post('/checkout', [DetailsController::class, 'store'])
    ->name('customer.checkout');

// Dashboard
Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('/dashboard', [OrderController::class, 'index'])
        ->name('dashboard');

    // Kelola pesanan
    Route::patch('/orders/{order}/status', [OrderController::class, 'updateStatus'])
        ->name('orders.updateStatus');

    Route::delete('/orders/{order}', [OrderController::class, 'destroy'])
        ->name('orders.destroy');

    // CRUD Events
    Route::resource('events', EventsController::class);

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');
});

require __DIR__.'/auth.php';
