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

Route::get('/funcionarios', [App\Http\Controllers\FuncionariosController::class, 'index'])->name('funcionarios');

Route::get('/users', [App\Http\Controllers\ProfileController::class, 'listAll'])->name('users');

Route::get('/admins', [App\Http\Controllers\ProfileController::class, 'listAllAdmins'])->name('admins');

Route::get('/user-profile/{id}', [App\Http\Controllers\ProfileController::class, 'userProfile'])->name("user-profile");

Route::get('logout', function () {
    auth()->logout();
    Session()->flush();

    return Redirect::to('/');
})->name('logout');

Route::middleware(['auth'])->group(function () {
    Route::get("/profile", [App\Http\Controllers\ProfileController::class, 'index'])->name('profile');
    Route::post('profile/{user}', [App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');
});
