@extends('./layouts/main-layout')
@section('main')
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
                    <th class="w-20">Lugar</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody class="items-cart">
                @if (empty($info))
                    <tr>
                        <td>
                            <h5>O seu carrinho está vazio! Adicione alguns bilhetes.</h5>
                        </td>
                    </tr>
                @else
                    @foreach ($info as $index => $item)
                        <tr>
                            <td class="w-25">{{ $item['filme'] }}</td>
                            <td class="w-30">{{ $item['data'] }} - {{ $item['horario'] }}</td>
                            <td class="w-30">{{ implode(', ', $item['lugares']) }}</td>
                            <td>
                                <form action="{{ route('removeCarrinho', ['sessaoId' => $item['id']]) }}" method="POST">
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
        @if (session('carrinhoVazio'))
            <div class="alert alert-danger">{{ session('carrinhoVazio') }}</div>
        @endif
        @include('payment.form')
        <form action="{{ route('limparCarrinho') }}" method="POST">
            @csrf
            <button class="btn btn-danger mt-1" type="submit">Esvaziar Carrinho</button>
        </form>
    </div>
@endsection
