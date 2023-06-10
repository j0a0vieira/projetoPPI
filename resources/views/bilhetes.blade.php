@extends('./layouts/main-layout')

@section('main')
    <div class="container mt-3 mb-4">
        <div class="row">
            <div class="col-md-12">
                <h1>Lista de bilhetes comprados</h1>
                <ul class="list-group mt-5">
                    @if (empty($bilhetes))
                        <li class="list-group-item">Você ainda não comprou nenhum bilhete :(</li>
                    @else
                        @foreach ($bilhetes as $bilhete)
                            <li class="list-group-item p-5 my-2">
                                @if ($bilhete->estado == 'usado')
                                    <span class="badge badge-danger">Usado</span>
                                @else
                                    <span class="badge badge-success">Não usado</span>
                                @endif
                                <span class="font-weight-bold">Filme:
                                </span>{{ $bilhete->sessao->filme->titulo }}
                                <span class="font-weight-bold ml-3">
                                    Data: </span>{{ $bilhete->sessao->data }} às {{ $bilhete->sessao->horario_inicio }}
                                <span class="font-weight-bold ml-3">ID: </span>{{ $bilhete->id }}
                                <span class="font-weight-bold ml-3">Sala: </span>{{ $bilhete->sessao->sala->nome }}
                                <form action="{{ route('descarregarBilhete', ['id' => $bilhete->id]) }}" method="GET"
                                    class="float-right mx-2">
                                    <button type="submit" class="btn btn-primary">Bilhete</button>
                                </form>
                                <form action="{{ route('descarregarRecibo', ['id' => $bilhete->id]) }}" method="GET"
                                    class="float-right">
                                    <button type="submit" class="btn btn-primary">Recibo</button>
                                </form>
                            </li>
                        @endforeach
                    @endif
                </ul>
            </div>
        </div>
    </div>
@endsection
