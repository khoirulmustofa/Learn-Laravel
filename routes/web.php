<?php

use App\Livewire\Clicker;
use App\Livewire\DataBinding;
use App\Http\Controllers\GuardianStudentController;
use App\Http\Controllers\ManyToManyController;
use App\Http\Controllers\OneToManyController;
use App\Http\Controllers\OneToOneController;
use App\Http\Controllers\PresensiController;
use App\Livewire\Todo;
use App\Http\Controllers\StudentsController;
use App\Models\Asrama;
use App\Models\User;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

    Route::get('/clicker', Clicker::class);


    Route::get('/databinding', DataBinding::class);

    
require __DIR__.'/auth.php';
Route::get('/presensi', [PresensiController::class, 'index']);


Route::get('/todo', Todo::class);


Route::get('/guardian-student', [GuardianStudentController::class, 'index']);

// Route::get('/students', [StudentsController::class, 'index'])->name('students.index');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
