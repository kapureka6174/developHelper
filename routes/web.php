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

Route::get('/users', function () {
    return Inertia::render('Users');
})->name('Users');

Route::get('/Services', function () {
    return Inertia::render('Services');
})->name('Services');

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('/create', function () {
        return Inertia::render('Create');
    })->name('Create');
});
