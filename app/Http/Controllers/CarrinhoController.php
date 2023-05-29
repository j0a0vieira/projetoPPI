<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CarrinhoController extends Controller
{
    public function mostrarCarrinho()
    {
        $itemsCarrinho = session()->get('itemsCarrinho', []);

        return view('cart', compact('itemsCarrinho'));
    }

    public function adicionarItem(Request $request)
    {
        $filmeNome = $request->input('filme');

        // Retrieve the current cart items from the session or create an empty array
        $itemsCarrinho = session()->get('itemsCarrinho', []);

        // Add the ticket to the cart
        $itemsCarrinho[] = [
            'nome' => $filmeNome,
        ];

        // Store the updated cart items back to the session
        session()->put('itemsCarrinho', $itemsCarrinho);

        return redirect()->back();
    }

    public function removerItem($index)
    {
        $itemsCarrinho = session()->get('itemsCarrinho', []);

        if (isset($itemsCarrinho[$index])) {
            unset($itemsCarrinho[$index]);
            session()->put('itemsCarrinho', $itemsCarrinho);
        }

        return redirect()->back();
    }
}
