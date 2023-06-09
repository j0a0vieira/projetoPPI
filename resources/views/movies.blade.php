@extends('./layouts/main-layout')
@section('main')
    <div class="container">
        <div class="search-bar">
            <div class="row">
                <div class="col-md-7">
                    <form action="{{ route('searchFilme') }}" method="GET" class="d-flex m-2">
                        <div class="input-group">
                            <input type="text" class="form-control" name="searchText" placeholder="Procurar por nome">
                        </div>
                        <div class="input-group ml-2">
                            <input type="text" class="form-control" name="searchGenero"
                                placeholder="Procurar por genero (inglês)">
                        </div>
                        <button class="btn btn-primary ml-2" type="submit">Search</button>
                    </form>
                </div>

            </div>
            @if (session('bilhetesSucesso'))
                <div class="alert alert-success">{{ session('bilhetesSucesso') }}</div>
            @endif
        </div>
        <div class="row">

            @foreach ($filmes as $filme)
                <x-filme-tile :sessoes="$sessoes" :filme="$filme" />
            @endforeach

        </div>
    </div>
@endsection
