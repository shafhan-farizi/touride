<?php

use App\Http\Controllers\CarsController;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\UsersController;
use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use App\Models\Reviews;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Route::get('settings/profile', Profile::class)->name('settings.profile');
    Route::get('settings/password', Password::class)->name('settings.password');
    Route::get('settings/appearance', Appearance::class)->name('settings.appearance');
});

Route::get('/', function () {
    $reviews = Reviews::all();

    return view('index', compact('reviews'));
})->name('home');

Route::get('/contact', function () {
    return view('portal.contact');
})->name('contact');

Route::controller(CarsController::class)->middleware(['auth'])->group(function () {
    Route::get('/cars', 'index')->name('cars');

    Route::get('/cars/{id}', 'show')->name('cars.show');

    Route::get('/cars/{id}/booking', 'booking')->name('cars.booking');
    Route::post('/cars/booking', 'store')->name('cars.booking.create');

    Route::get('/cars/{id}/confirm-booking', 'confirm')->name('cars.confirm');
    Route::post('/cars/{id}/confirm-booking', 'confirmed')->name('cars.confirmed');
});

Route::controller(UsersController::class)->group(function () {
    Route::get('/history', 'booking_history')->name('user.history');

    Route::get('/payment-method', 'payment_method')->name('user.payment-method');
    Route::post('/payment-method/{id}/add', 'payment_method_add')->name('user.payment-method.add');
    Route::delete('/payment-method/delete', 'payment_delete')->name('user.payment-method.delete');

    Route::get('/history/{id}', 'booking_history_detail')->name('user.history.detail');
    Route::post('/history/{id}', 'send_review')->name('user.history.review');

    Route::get('/profile', 'profile')->name('user.profile');
});

require __DIR__ . '/auth.php';
