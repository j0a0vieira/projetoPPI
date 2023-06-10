<?php

namespace App\Http\Controllers;

use App\Models\Sala;
use Illuminate\Http\Request;

class SalaController extends Controller
{
    public function detalhes($id)
    {
        $filme = Filme::find($id);

        return view('detalhes', compact('filme'));
    }

    public function novaSala(Request $request)
    {
        $sala = new Sala();
        $nCadeiras = $request->input('cadeiras');

        $sala->nome = $request->nome;
        $sala->save();

        // Create seats for the room
        $totalRows = ceil($nCadeiras / 10); // Calculate the number of rows needed
        $rowLetters = range('A', 'Z'); // Generate an array of row letters

        for ($row = 0; $row < $totalRows; $row++) {
            $rowLetter = $rowLetters[$row]; // Get the row letter

            for ($seat = 1; $seat <= 10; $seat++) {
                $sala->cadeiras()->create([
                    'row' => $rowLetter,
                    'number' => $seat
                ]);
            }
        }

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

        return view('movies')
            ->with('filmes', $movies)
            ->with('sessoes', $sessions)
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
}
