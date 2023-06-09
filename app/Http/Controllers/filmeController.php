<?php

namespace App\Http\Controllers;

use App\Models\Filme;
use App\Models\Sessao;
use Carbon\Carbon;
use Illuminate\Http\Request;

class FilmeController extends Controller
{
    public function detalhesFilme($id)
    {
        $filme = Filme::find($id);
        $generos = Filme::distinct('genero_code')->pluck('genero_code');

        return view('filme')
            ->with('filme', $filme)
            ->with('generos', $generos);
    }

    public function updateFilme(Filme $filme, Request $request)
    {

        $caminho = $filme->cartaz_url;

        if ($request->hasFile('cartaz')) {

            $imagem = $request->file('cartaz');
            $caminho = $filme->id . "_" . uniqid() . '.' . $imagem->extension();
            $imagem->storeAs('public/cartazes', $caminho);
        }

        $filme->update([
            'titulo' => $request->titulo,
            'genero_code' => $request->genero,
            'ano' => $request->ano,
            'updated_at' => now(),
            'sumario' => $request->descricao,
            'cartaz_url' => $caminho,
            'trailer_url' => $request->trailer,
        ]);

        return redirect()->back();
    }

    public function mostrarFilmes()
    {
        $today = Carbon::now();

        $sessions = Sessao::whereDate('data', '>=', $today)
            ->get();

        $movies = Filme::whereIn('id', $sessions->pluck('filme_id'))
            ->get();

        $generos = Filme::distinct('genero_code')->pluck('genero_code');

        return view('layout')
            ->with('filmes', $movies)
            ->with('sessoes', $sessions)
            ->with('generos', $generos);
    }

    public function novoFilme(Request $request)
    {
        $filme = new Filme();

        $filme->titulo = $request->titulo;
        $filme->genero_code = $request->titulo;
        $filme->ano = $request->ano;
        $filme->sumario = $request->descricao;
        $filme->cartaz_url = null;
        $filme->trailer_url = $request->trailer;
        $filme->save();

        $caminho = $filme->cartaz_url;

        if ($request->hasFile('cartaz')) {

            $imagem = $request->file('cartaz');
            $caminho = $filme->id . "_" . uniqid() . '.' . $imagem->extension();
            $imagem->storeAs('public/cartazes', $caminho);
        }

        $filme->update([
            'cartaz_url' => $caminho
        ]);

        return redirect()->back();
    }

    public function searchFilme(Request $request)
    {
        $today = Carbon::now();
        $sessions = Sessao::whereDate('data', '>=', $today)
            ->get();

        $searchQueryTitulo = $request->query('searchText');
        $searchQueryGenero = $request->query('searchGenero');
        if ($searchQueryTitulo) {
            $sessions = Sessao::whereDate('data', '>=', $today)
                ->get();

            $filmes = Filme::where('titulo', 'LIKE', "%$searchQueryTitulo%")->whereIn('id', $sessions->pluck('filme_id'))
                ->get();
        } else if ($searchQueryGenero) {
            $sessions = Sessao::whereDate('data', '>=', $today)
                ->get();

            $filmes = Filme::where('genero_code', 'LIKE', "%$searchQueryGenero%")->whereIn('id', $sessions->pluck('filme_id'))
                ->get();
        } else {
            return redirect()->route("home");
        }


        return view('layout')
            ->with('filmes', $filmes)
            ->with('sessoes', $sessions);
    }

    public function detalhes($id)
    {
        $filme = Filme::find($id);

        return view('detalhes', compact('filme'));
    }
}
