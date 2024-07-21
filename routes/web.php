<?php

use App\Http\Controllers\ManyToManyController;
use App\Http\Controllers\OneToManyController;
use App\Http\Controllers\OneToOneController;
use App\Http\Controllers\PresensiController;
use App\Models\Asrama;
use App\Models\User;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
        $asramas = Asrama::all();
        return $userIds = User::limit($asramas->count())->orderBy('id')->pluck('id')->toArray();
});

Route::get('/one-to-one', [OneToOneController::class, 'index']);
Route::get('/one-to-many', [OneToManyController::class, 'index']);


Route::get('/many-to-many', [ManyToManyController::class, 'index']);
Route::get('/presensi', [PresensiController::class, 'index']);

