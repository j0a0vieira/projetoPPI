<?php

namespace App\Http\Controllers;

use App\Models\Sessao;
use Illuminate\Http\Request;

class LugarController extends Controller
{
    public function selectSeat(Request $request)
    {
        $sessao = Sessao::find($request->input('sessao_id'));
        $lugares = $sessao->sala->lugares;
        $lugaresOcupados = $sessao->bilhete->pluck('lugar_id')->toArray();
        $numeroLugares = 0;
        $numeroFilas = 0;
        $filas = [];

        foreach ($lugares as $lugar) {
            if ($lugar->posicao > $numeroLugares) {
                $numeroLugares = $lugar->posicao;
            }

            $filas[$lugar->fila] = true;
        }

        $numeroFilas = count($filas);

        return view('lugares')
            ->with('sessao', $sessao)
            ->with('numeroLugares', $numeroLugares)
            ->with('numeroFilas', $numeroFilas)
            ->with('lugaresOcupados', $lugaresOcupados);
    }
}
