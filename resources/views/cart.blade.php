<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <title>Carrinho</title>
    <style>
        .payment-fields {
            display: none;
        }
    </style>
</head>

<body>
    <x-navbar />
    <div class="container mt-5">
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        <h1>Carrinho</h1>
        <table class="table">
            <thead>
                <tr>
                    <th class="w-50">Filme</th>
                    <th class="w-20">Sessão</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody class="items-cart">
                @if (!$itemsCarrinho)
                    <tr>
                        <td>
                            <h5>O seu carrinho está vazio! Adicione alguns bilhetes.</h5>
                        </td>
                    </tr>
                @else
                    @foreach ($itemsCarrinho as $index => $item)
                        <tr>
                            <td class="w-25">{{ $item['nome'] }}</td>
                            <td class="w-30">{{ $item['sessao']->data }} - {{ $item['sessao']->horario_inicio }}</td>
                            <td>
                                <form action="{{ route('removeCarrinho', ['index' => $index]) }}" method="POST">
                                    @csrf
                                    <button class="btn btn:primary" type="submit">Remover</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                @endif

            </tbody>
        </table>
        <h3>Preço Total C/IVA: €{{ number_format($totalPrice, 2) }}</h3>
        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif
        @include('payment.form')
        <form action="{{ route('limparCarrinho') }}" method="POST">
            @csrf
            <button class="btn btn-danger mt-1" type="submit">Esvaziar Carrinho</button>
        </form>
</body>

</html>
