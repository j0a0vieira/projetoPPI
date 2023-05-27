<?php

use App\Http\Controllers\filmeController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;

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

Auth::routes();
Auth::routes(['verify' => true]);
Route::get('/', [App\Http\Controllers\FilmeController::class, 'index'])->name('home');
Route::get('logout', function () {
    auth()->logout();
    Session()->flush();

    return Redirect::to('/');
})->name('logout');

Route::middleware(['auth'])->group(function () {
    Route::get("/profile", [App\Http\Controllers\ProfileController::class, 'index']);
    Route::post('profile/{user}', [App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');
});
