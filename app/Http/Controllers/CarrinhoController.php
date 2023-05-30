<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\Payment;

class CarrinhoController extends Controller
{
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

    public function atualizarQuantidade(Request $request, $index)
    {
        $quantidade = $request->input('quantidade');

        $itemsCarrinho = session()->get('itemsCarrinho', []);

        if (isset($itemsCarrinho[$index])) {
            $itemsCarrinho[$index]['quantidade'] = $quantidade;
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
            $totalPrice += $item['quantidade'] * 5; // Each ticket costs 5 euros
        }

        $totalPrice *= 1.23; // Apply 23% tax

        return $totalPrice;
    }

    public function showPaymentForm()
    {
        return view('payment.form');
    }

    public function processPayment(Request $request)
    {
        // Handle the payment processing logic based on the selected payment method
        $paymentMethod = $request->input('payment_method');

        if ($paymentMethod === 'paypal') {
            $paypalEmail = $request->input('paypal_email');

            // Process PayPal payment
        } elseif ($paymentMethod === 'mbway') {
            $mbwayPhone = $request->input('mbway_phone');

            // Process MBWay payment
        } elseif ($paymentMethod === 'visa') {
            $cardNumber = $request->input('visa_card_number');
            $expiryDate = $request->input('visa_card_expiry');
            $cvv = $request->input('visa_card_cvv');

            // Process Visa Card payment
        }

        // Return the response or redirect as per your requirement
    }
}
