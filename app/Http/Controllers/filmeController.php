<?php

namespace App\Http\Controllers;

use App\Models\filmes;

class FilmeController extends Controller
{

    public function index()
    {
        $allFilmes = filmes::all();

        return view('layout')->with('filmes', $allFilmes);
    }
}
