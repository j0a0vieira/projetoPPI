@extends('./layouts/main-layout')
@section('main')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header">
                        <h4>Editar filme</h4>
                    </div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('filme-update', $filme->id) }}" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group">
                                <label for="titulo">Título</label>
                                <input type="text" class="form-control" id="titulo" name="titulo"
                                    value="{{ $filme->titulo }}">
                            </div>

                            <div class="form-group">
                                <label for="descricao">Descrição</label>
                                <textarea class="form-control" id="descricao" name="descricao" rows="4">{{ $filme->sumario }}</textarea>
                            </div>

                            <div class="form-group">
                                <label for="ano">Ano de lançamento</label>
                                <input type="number" class="form-control" id="ano" name="ano"
                                    value="{{ $filme->ano }}">
                            </div>

                            <div class="form-group">
                                <label for="genero">Gênero</label>
                                <select class="form-select" aria-label="Default select example" name="genero"
                                    id="genero">
                                    @foreach ($generos as $genero)
                                        <option value="{{ $genero }}"
                                            {{ $genero == $filme->genero_code ? 'selected' : '' }}>
                                            {{ $genero }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="trailer">Trailer</label>
                                <input type="text" class="form-control" id="trailer" name="trailer"
                                    value="{{ $filme->trailer_url }}">
                            </div>

                            <div class="form-group">
                                <label for="image">Cartaz</label>
                                @if ($filme->cartaz_url)
                                    <div class="mb-2">
                                        <img class="img-fluid" src="{{ url('storage/cartazes/' . $filme->cartaz_url) }}"
                                            alt="" />
                                    </div>
                                @else
                                    <div class="mb-2">
                                        <img class="img-fluid" src="{{ url('storage/cartazes/no-image.png') }}"
                                            alt="" />
                                    </div>
                                @endif
                                <input type="file" class="form-control-file" id="image" name="cartaz">
                            </div>

                            <div class="text-center mt-4">
                                <button type="submit" class="btn btn-primary">Atualizar Filme</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
