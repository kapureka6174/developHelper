<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Home');
})->name('Home');;

Route::get('/services', function () {
    return Inertia::render('Services');
})->name('Services');

Route::get('/users',[App\Http\Controllers\UserController::class,'all'])->name('Users');
Route::get('/users/{id}',[App\Http\Controllers\UserController::class,'detail']) ->name('User');

Route::get('/Services',[App\Http\Controllers\ServiceController::class,'all'])->name('Services');
Route::get('/Services/{id}',[App\Http\Controllers\ServiceController::class,'detail'])->name('Service');

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('/create', [App\Http\Controllers\ServiceController::class,'new'])->name('Create');
    Route::post('/create', [App\Http\Controllers\ServiceController::class,'create']);
    Route::post('/Services/{id}',[App\Http\Controllers\ServiceController::class,'add'])->name('Service');
});
