<?php

namespace App\Http\Controllers;

use App\Models\Filme;
use App\Models\Sessao;
use Carbon\Carbon;

class FilmeController extends Controller
{

    public function index()
    {
        $allFilmes = Filme::all();

        return view('layout')->with('filmes', $allFilmes);
    }

    public function mostrarFilmes()
    {
        $today = '2021-01-01 00:00:00.0';
        $tomorrow = '2021-01-02 00:00:00.0';

        $sessions = Sessao::whereDate('data', '>=', $today)
            ->whereDate('data', '<=', $tomorrow)
            ->get();

        $movies = Filme::whereIn('id', $sessions->pluck('filme_id'))
            ->get();

        return view('layout', ['filmes' => $movies]);
    }

    public function detalhes($id)
    {
        $filme = Filme::find($id);

        return view('detalhes', compact('filme'));
    }


}
