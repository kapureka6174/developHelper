<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Illuminate\Http\Request;


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

Route::get('/services',[App\Http\Controllers\ServiceController::class,'all'])->name('Services');
Route::get('/services/{id}',[App\Http\Controllers\ServiceController::class,'detail'])->name('Service');

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('/create', [App\Http\Controllers\ServiceController::class,'new'])->name('Create');
    Route::post('/create', [App\Http\Controllers\ServiceController::class,'create']);
    Route::post('/comment',[App\Http\Controllers\CommentController::class,'addComment'])->name('Comment');
    Route::post('/task',[App\Http\Controllers\TaskController::class,'addTask'])->name('Task');
    Route::get('/services/{id}/edit',[App\Http\Controllers\ServiceController::class,'edit'])->name('Edit');
    Route::post('/edit',[App\Http\Controllers\ServiceController::class,'update']);
    Route::post('/delete',[App\Http\Controllers\ServiceController::class,'delete'])->name('Delete');
});

Route::get('auth/github', [App\Http\Controllers\GitHubController::class, 'gitRedirect'])->name('Github_Login');
Route::get('auth/github/callback', [App\Http\Controllers\GitHubController::class, 'gitCallback']);

Route::get('auth/google', [App\Http\Controllers\GoogleController::class, 'googleRedirect'])->name('Google_Login');
Route::get('auth/google/callback', [App\Http\Controllers\GoogleController::class, 'googleCallback']);

Route::get('auth/guest', [App\Http\Controllers\GuestController::class, 'login'])->name('Guest_Login');
