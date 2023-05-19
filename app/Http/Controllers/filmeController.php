<?php

namespace App\Http\Controllers;

use App\Models\filmes;
use Illuminate\Http\Request;
use Illuminate\View\View;

class filmeController extends Controller
{
    public function index(): View
    {
        $allFilmes = filmes::all();

        return view('layout')->with('filmes', $allFilmes);
    }
}
