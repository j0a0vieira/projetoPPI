<?php

namespace App\Http\Controllers;

use App\Models\Sessao;
use Illuminate\Http\Request;
use App\Services\Payment;

class CarrinhoController extends Controller
{

    protected $_paymentService;

    public function __construct(Payment $payment)
    {
        $this->_paymentService = $payment;
    }

    public function mostrarCarrinho()
    {
        $itemsCarrinho = session()->get('itemsCarrinho', []);
        $totalPrice = $this->calculateTotalPrice($itemsCarrinho);

        return view('cart', compact('itemsCarrinho', 'totalPrice'));
    }

    public function adicionarItem(Request $request)
    {
        $filmeNome = $request->input('filme');

        $quantidade = $request->input('quantidade', 1);
        $id = $request->input('id');
        $sessao = Sessao::find($request->input('sessao_id'));

        $itemsCarrinho = session()->get('itemsCarrinho', []);

        $existingItem = collect($itemsCarrinho)->first(function ($item) use ($id) {
            return $item['id'] == $id;
        });

        if ($existingItem) {
            return redirect()->back();
        } else {
            $itemsCarrinho[] = [
                'id' => $id,
                'nome' => $filmeNome,
                'sessao' => $sessao,
                'quantidade' => $quantidade,
            ];
        }

        session()->put('itemsCarrinho', $itemsCarrinho);

        $totalPrice = $this->calculateTotalPrice($itemsCarrinho);

        session()->put('totalPrice', $totalPrice);

        return redirect()->back();
    }


    public function removerItem($index)
    {
        $itemsCarrinho = session()->get('itemsCarrinho', []);

        if (isset($itemsCarrinho[$index])) {
            unset($itemsCarrinho[$index]);
            session()->put('itemsCarrinho', $itemsCarrinho);
        }

        $totalPrice = $this->calculateTotalPrice($itemsCarrinho);

        session()->put('totalPrice', $totalPrice);

        return redirect()->back();
    }

    private function calculateTotalPrice($itemsCarrinho)
    {
        $totalPrice = 0;

        foreach ($itemsCarrinho as $item) {
            $totalPrice += $item['quantidade'] * 5; //cada bilhete custa 5€ 
        }

        session()->put('totalPriceS/IVA', $totalPrice);

        $totalPrice *= 1.23; //taxa de 1.23€

        return $totalPrice;
    }

    public function showPaymentForm()
    {
        return view('payment.form');
    }

    public function processPayment(Request $request)
    {
        $paymentMethod = $request->input('payment_method');

        if ($request->input('paypal_email') != "" || $request->input('mbway_phone') != "" || $request->input('visa_card_number') != "" || $request->input('visa_card_expiry') != "" || $request->input('visa_card_cvv') != "") {
            $paypal_valido = true;
            $mbway_valido = true;
            $visa_valido = true;
            $ref_pagamento = true;
        } else {
            return back()->withError("Dados de pagamento inválidos! Insira os dados corretamente, por favor.")->withInput();
        }


        if ($paymentMethod === 'paypal') {
            $paypalEmail = $request->input('paypal_email');
            $paypal_valido = $this->_paymentService->payWithPaypal($paypalEmail);
            $ref_pagamento = $paypalEmail;
        } elseif ($paymentMethod === 'mbway') {
            $mbway = $request->input('mbway_phone');
            $mbway_valido = $this->_paymentService->payWithMBway($mbway);
            $ref_pagamento = $mbway;
        } elseif ($paymentMethod === 'visa') {
            $cardNumber = $request->input('visa_card_number');
            $cvv = $request->input('visa_card_cvv');
            $ref_pagamento = $cardNumber;

            $visa_valido = $this->_paymentService->payWithVisa($cardNumber, $cvv);
        }

        if (!$paypal_valido || !$mbway_valido || !$visa_valido) {
            return back()->withError("Dados de pagamento inválidos! Insira os dados corretamente, por favor.")->withInput();
        }

        $pagamento = [
            'tipoPagamento' => $paymentMethod,
            'referenciaPagamento' => $ref_pagamento,
        ];

        session()->put('infoPagamento', $pagamento);
        return redirect()->route("finalizacaoCompra");
    }

    public function limparCarrinho()
    {
        session()->forget('itemsCarrinho');

        return back()->with('success', 'Todos os items foram removidos do carrinho!');
    }

    public function escolherLugares()
    {
    }
}
