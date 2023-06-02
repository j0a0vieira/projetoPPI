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
                    <th>Ações</th>
                    <th>Quantidade</th>
                    <th>
                        <form action="{{ route('limparCarrinho') }}" method="POST">
                            @csrf
                            <button class="btn btn-danger" type="submit">Esvaziar Carrinho</button>
                        </form>
                    </th>
                </tr>
            </thead>
            <tbody class="items-cart">
                @foreach ($itemsCarrinho as $index => $item)
                    <tr>
                        <td class="w-50">{{ $item['nome'] }}</td>
                        <td>
                            <form action="{{ route('removeCarrinho', ['index' => $index]) }}" method="POST">
                                @csrf
                                <button class="btn btn:primary" type="submit">Remover</button>
                            </form>
                        </td>
                        <td>
                            <form action="{{ route('updateCarrinho', ['index' => $index]) }}" method="POST">
                                @csrf
                                <select name="quantidade" class="form-control" onchange="this.form.submit()">
                                    @for ($i = 1; $i <= 10; $i++)
                                        <option value="{{ $i }}"
                                            {{ $item['quantidade'] == $i ? 'selected' : '' }}>
                                            {{ $i }} {{ $i > 1 ? 'tickets' : 'ticket' }}
                                        </option>
                                    @endfor
                                </select>
                            </form>
                        </td>
                    </tr>
                @endforeach
                <tr>
                    <td>
                        <h3>Preço Total C/IVA: €{{ number_format($totalPrice, 2) }}</h3>
                    </td>
                </tr>
            </tbody>
        </table>
        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif
        @include('payment.form')
</body>

</html>
