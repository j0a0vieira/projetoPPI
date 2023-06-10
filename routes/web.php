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

//pagina inicial
Route::get('/', [App\Http\Controllers\FilmeController::class, 'mostrarFilmes'])->name('home');

//adicionar, remover e atualizar itens do carrinho
Route::get('/cart', [App\Http\Controllers\CarrinhoController::class, 'mostrarCarrinho'])->name('carrinho');
Route::post('/cart/add', [App\Http\Controllers\CarrinhoController::class, 'adicionarItem'])->name('addCarrinho');
Route::post('/cart/remove/{sessaoId}', [App\Http\Controllers\CarrinhoController::class, 'removerItem'])->name('removeCarrinho');
Route::post('/cart/update/{index}', [App\Http\Controllers\CarrinhoController::class, 'atualizarQuantidade'])->name('updateCarrinho');
Route::post('/limparCarrinho', [App\Http\Controllers\CarrinhoController::class, 'limparCarrinho'])->name('limparCarrinho');

//rota para seleção de lugares
Route::get('/selectSeat', [App\Http\Controllers\LugarController::class, 'selectSeat'])->name("selecionarLugares");

//rota para fazer logout (improvisada)
Route::get('logout', function () {
    auth()->logout();
    Session()->flush();

    return Redirect::to('/');
})->name('logout');

//rotas que o admin chama para criar novo user
Route::get("/newUser", function () {
    return view('newUser');
})->name("newUser");
Route::post('/users', [App\Http\Controllers\ProfileController::class, 'store'])->name("storeUser")->withoutMiddleware(['auth']);


//pesquisa de filmes
Route::get('/searchFilme', [App\Http\Controllers\FilmeController::class, 'searchFilme'])->name('searchFilme');


Route::middleware(['auth', 'user-block'])->group(function () {

    //perfis de utilizador
    Route::get("/profile", [App\Http\Controllers\ProfileController::class, 'index'])->name('profile');
    Route::post('profile/{user}', [App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');
    Route::get('/user-profile/{id}', [App\Http\Controllers\ProfileController::class, 'userProfile'])->name("user-profile");
    Route::get('/delete-profile/{id}', [App\Http\Controllers\ProfileController::class, 'deleteProfile'])->name("delete-profile");
    Route::get('/block-profile/{id}', [App\Http\Controllers\ProfileController::class, 'bloquearProfile'])->name("block-profile");

    //filmes
    Route::get('/filme/{id}', [App\Http\Controllers\FilmeController::class, 'detalhesFilme'])->name("filme-detalhes");
    Route::post('/filme/{filme}', [App\Http\Controllers\FilmeController::class, 'updateFilme'])->name("filme-update");
    Route::post('/novoFilme', [App\Http\Controllers\FilmeController::class, 'novoFilme'])->name("novoFilme");
    Route::get('/delete-filme/{id}', [App\Http\Controllers\FilmeController::class, 'deleteFilme'])->name("delete-filme");
    Route::get('/novoFilme', function () {
        return view('newFilme');
    })->name("newFilmeLayout");

    //salas
    Route::get('/sala/{id}', [App\Http\Controllers\SalaController::class, 'detalhesSala'])->name("sala-detalhes");
    Route::post('/sala/{sala}', [App\Http\Controllers\SalaController::class, 'updateSala'])->name("sala-update");
    Route::get('/delete-sala/{id}', [App\Http\Controllers\SalaController::class, 'deleteSala'])->name("delete-sala");
    Route::post('/novaSala', [App\Http\Controllers\SalaController::class, 'novaSala'])->name("novaSala");
    Route::get('/novaSala', function () {
        return view('newSala');
    })->name("newSalaLayout");

    //listagem de utilizadores
    Route::get('/funcionarios', [App\Http\Controllers\ProfileController::class, 'listAllFuncionarios'])->name('funcionarios');
    Route::get('/users', [App\Http\Controllers\ProfileController::class, 'listAll'])->name('users');
    Route::get('/administradores', [App\Http\Controllers\ProfileController::class, 'listAllAdmins'])->name('administradores');

    //pesquisa de utilizadores
    Route::get('/searchAdmins', [App\Http\Controllers\ProfileController::class, 'searchAdmins'])->name('searchAdmins');
    Route::get('/searchUsers', [App\Http\Controllers\ProfileController::class, 'searchUsers'])->name('searchUsers');
    Route::get('/searchFuncionarios', [App\Http\Controllers\ProfileController::class, 'searchFuncionarios'])->name('searchFuncionarios');

    //pagamento, download e geramento de recibo e bilhete,
    Route::post('/pagamento', [App\Http\Controllers\CarrinhoController::class, 'processPayment'])->name('payment.process');
    Route::get('/finalizacaoCompra', [App\Http\Controllers\CompraController::class, 'guardarBilhetes'])->name('finalizacaoCompra');
    Route::get('/bilhetes', [App\Http\Controllers\ProfileController::class, 'bilhetes'])->name('bilhetes');
    Route::get("/descarregarBilhete/{id}", [App\Http\Controllers\CompraController::class, 'descarregarBilhetes'])->name("descarregarBilhete");
    Route::get("/descarregarRecibo/{id}", [App\Http\Controllers\CompraController::class, 'descarregarRecibo'])->name("descarregarRecibo");
});
