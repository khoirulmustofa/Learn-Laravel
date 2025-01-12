<?php

use App\Http\Controllers\TelegramController;
use App\Livewire\Todo;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');

Route::get('/telegram/getMe', [TelegramController::class, 'getMe'])->name('telegram.getMe');
Route::get('/telegram/getUpdates', [TelegramController::class, 'getUpdates'])->name('telegram.getUpdates');

Route::get('/telegram/sendMessage', [TelegramController::class, 'sendMessage'])->name('telegram.sendMessage');

Route::post('/telegram/webhook', [TelegramController::class, 'webhook'])->name('telegram.webhook');


Route::get('/telegram/setWebhook', [TelegramController::class, 'setWebhook'])->name('telegram.setWebhook');
Route::get('/telegram/removeWebhook', [TelegramController::class, 'removeWebhook'])->name('telegram.removeWebhook');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');
Route::get('/todo', App\Livewire\Todo::class);

require __DIR__ . '/auth.php';
