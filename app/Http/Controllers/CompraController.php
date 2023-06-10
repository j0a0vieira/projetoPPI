<?php

namespace App\Http\Controllers;

use App\Models\Bilhete;
use App\Models\Lugar;
use App\Models\Recibo;
use App\Models\Sessao;
use Carbon\Carbon;
use Dompdf\Dompdf;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class CompraController extends Controller
{
    public function guardarBilhetes()
    {
        $itemsCarrinho = session()->get('itemsCarrinho', []);
        $user = Auth::user();
        $infoPagamento = session()->get('infoPagamento');
        $precoCarrinho = session()->get('totalPrice');
        $precoCarrinhoSemIVA = session()->get('totalPriceS/IVA');

        $recibo = new Recibo;
        $recibo->data = Carbon::now()->toDateTimeString();
        $recibo->tipo_pagamento = $infoPagamento['tipoPagamento'];
        $recibo->ref_pagamento = $infoPagamento['referenciaPagamento'];
        $recibo->preco_total_sem_iva = $precoCarrinhoSemIVA;
        $recibo->iva = $precoCarrinho - $precoCarrinhoSemIVA;
        $recibo->preco_total_com_iva = $precoCarrinho;
        $recibo->nif = $user->nif;
        $recibo->cliente_id = $user->id;
        $recibo->nome_cliente = $user->name;
        $recibo->save();

        foreach ($itemsCarrinho as $sessaoId => $lugares) {
            $sessao = Sessao::find($sessaoId);

            foreach ($lugares as $lugar) {

                //separar dados para fazer query na db para obter o id do lugar
                $lugarDados = explode('-', $lugar);
                $lugarPosicao = $lugarDados[0];
                $lugarFila = $lugarDados[1];

                $lugarId = Lugar::where('fila', $lugarFila)
                    ->where('posicao', $lugarPosicao)
                    ->first()->id;

                $bilhete = new Bilhete;
                $bilhete->cliente_id = $user->id;
                $bilhete->recibo_id = $recibo->id;
                $bilhete->sessao_id = $sessao->id;
                $bilhete->preco_sem_iva = 5;
                $bilhete->estado = 'não usado';
                $bilhete->lugar_id = $lugarId;
                $bilhete->save();
            }
        }


        session()->forget('itemsCarrinho');
        return redirect()->route('home')->with('bilhetesSucesso', 'Bilhetes comprados com sucesso!');
    }

    public function descarregarBilhetes($id)
    {
        $bilhete = Bilhete::where('id', $id)->first();
        $pdf = new Dompdf();
        $pdf->loadHtml(View::make('/payment/bilhete', compact('bilhete'))->render());
        $pdf->setPaper('A4', 'portrait');
        $pdf->render();

        $pdfContent = $pdf->output();
        $filename = 'bilhete_' . $id . '.pdf';
        $directory = storage_path('/bilhetes');
        File::makeDirectory($directory, 0777, true, true);
        $pdfPath = $directory . '/' . $filename;
        file_put_contents($pdfPath, $pdfContent);

        return response()->download($pdfPath, $filename);
    }

    public function descarregarRecibo($id)
    {
        $bilhete = Bilhete::where('id', $id)->first();
        $recibo = $bilhete->recibo;
        $bilhetes = Bilhete::where('recibo_id', $recibo->id)->get();

        $pdf = new Dompdf();
        $pdf->loadHtml(View::make('/payment/recibo', compact('recibo', 'bilhetes'))->render());
        $pdf->setPaper('A4', 'portrait');
        $pdf->render();

        $pdfContent = $pdf->output();
        $filename = 'recibo_' . $id . '.pdf';
        $directory = storage_path('/recibos');
        File::makeDirectory($directory, 0777, true, true);
        $pdfPath = $directory . '/' . $filename;
        file_put_contents($pdfPath, $pdfContent);

        return response()->download($pdfPath, $filename);
    }
}
