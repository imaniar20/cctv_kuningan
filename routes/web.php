<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CameraController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('layouts/app');
// });

Route::resource('/', CameraController::class);


Route::get('/cameras', [\App\Http\Controllers\CameraController::class, 'index'])->name('cameras.index');
Route::get('/cameras/{camera:slug}', [\App\Http\Controllers\CameraController::class, 'show'])->name('cameras.show');