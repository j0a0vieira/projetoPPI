<?php

namespace App\Http\Controllers;

use App\Models\Filmes;

class FilmeController extends Controller
{

    public function index()
    {
        $allFilmes = Filmes::all();

        return view('layout')->with('filmes', $allFilmes);
    }
}
