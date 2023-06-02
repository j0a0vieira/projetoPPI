<?php

namespace App\Http\Controllers;

use App\Models\Recibo;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class CompraController extends Controller
{
    public function guardarRecibo()
    {
        $user = Auth::user();
        $infoPagamento = session()->get('infoPagamento');
        $precoCarrinho = session()->get('totalPrice');
        $precoCarrinhoSemIVA = session()->get('totalPriceS/IVA');
        $dataCompra = date('Y-m-d');
        $iva = $precoCarrinho - $precoCarrinhoSemIVA;

        $recibo = new Recibo;
        $recibo->cliente_id = $user->id;
        $recibo->data = $dataCompra;
        $recibo->preco_total_sem_iva = $precoCarrinhoSemIVA;
        $recibo->iva = $iva;
        $recibo->preco_total_com_iva = $precoCarrinho;
        $recibo->nif = $user->nif;
        $recibo->nome_cliente = $user->name;
        $recibo->tipo_pagamento = $infoPagamento['tipoPagamento'];
        $recibo->ref_pagamento = $infoPagamento['referenciaPagamento'];

        if ($recibo->save()) {
            return redirect()->route('home');
        }
    }

    public function lugares(Request $request)
    {
        $selectedSeats = json_decode($request->input('selectedSeats'));

        dd($selectedSeats);
    }
}
