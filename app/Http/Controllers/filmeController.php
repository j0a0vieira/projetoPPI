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
        // Get today's date and tomorrow's date
        $today = '2021-01-01 00:00:00.0';
        $tomorrow = '2021-01-02 00:00:00.0';

        // Retrieve sessions on display today and tomorrow
        $sessions = Sessao::whereDate('data', '>=', $today)
            ->whereDate('data', '<=', $tomorrow)
            ->get();

        // Retrieve the movies related to the sessions
        $movies = Filme::whereIn('id', $sessions->pluck('filme_id'))
            ->get();

        return view('layout', ['filmes' => $movies]);
    }
}
