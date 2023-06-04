<?php

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

Route::get('/', [App\Http\Controllers\FilmeController::class, 'mostrarFilmes'])->name('home');

Route::get('/cart', [App\Http\Controllers\CarrinhoController::class, 'mostrarCarrinho'])->name('carrinho');
Route::post('/cart/add', [App\Http\Controllers\CarrinhoController::class, 'adicionarItem'])->name('addCarrinho');
Route::post('/cart/remove/{index}', [App\Http\Controllers\CarrinhoController::class, 'removerItem'])->name('removeCarrinho');
Route::post('/cart/update/{index}', [App\Http\Controllers\CarrinhoController::class, 'atualizarQuantidade'])->name('updateCarrinho');


Route::get('logout', function () {
    auth()->logout();
    Session()->flush();

    return Redirect::to('/');
})->name('logout');


Route::get("/newUser", function () {
    return view('newUser');
})->name("newUser");

Route::get("/seats", function () {
    return view('seats');
});

Route::post('/users', [App\Http\Controllers\ProfileController::class, 'store'])->name("storeUser")->withoutMiddleware(['auth']);

Route::middleware(['auth', 'user-block'])->group(function () {
    Route::get("/profile", [App\Http\Controllers\ProfileController::class, 'index'])->name('profile');
    Route::post('profile/{user}', [App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');
    Route::get('/user-profile/{id}', [App\Http\Controllers\ProfileController::class, 'userProfile'])->name("user-profile");
    Route::get('/delete-profile/{id}', [App\Http\Controllers\ProfileController::class, 'deleteProfile'])->name("delete-profile");
    Route::get('/block-profile/{id}', [App\Http\Controllers\ProfileController::class, 'bloquearProfile'])->name("block-profile");
    Route::get('/funcionarios', [App\Http\Controllers\ProfileController::class, 'listAllFuncionarios'])->name('funcionarios');
    Route::get('/users', [App\Http\Controllers\ProfileController::class, 'listAll'])->name('users');
    Route::get('/administradores', [App\Http\Controllers\ProfileController::class, 'listAllAdmins'])->name('administradores');
    Route::get('/searchAdmins', [App\Http\Controllers\ProfileController::class, 'searchAdmins'])->name('searchAdmins');
    Route::get('/searchUsers', [App\Http\Controllers\ProfileController::class, 'searchUsers'])->name('searchUsers');
    Route::get('/searchFuncionarios', [App\Http\Controllers\ProfileController::class, 'searchFuncionarios'])->name('searchFuncionarios');
    Route::get('/pagamento', [App\Http\Controllers\CarrinhoController::class, 'showPaymentForm'])->name('payment.form');
    Route::post('/pagamento', [App\Http\Controllers\CarrinhoController::class, 'processPayment'])->name('payment.process');
    Route::post('/limparCarrinho', [App\Http\Controllers\CarrinhoController::class, 'limparCarrinho'])->name('limparCarrinho');
    Route::get('/finalizacaoCompra', [App\Http\Controllers\CompraController::class, 'guardarRecibo'])->name('finalizacaoCompra');
    Route::post('/lugares', [App\Http\Controllers\CompraController::class, 'lugares'])->name('lugares');
});
