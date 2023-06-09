@extends('./layouts/main-layout')
@section('main')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header">
                        <h4>Novo filme</h4>
                    </div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('novoFilme') }}" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group">
                                <label for="titulo">Título</label>
                                <input type="text" class="form-control" id="titulo" name="titulo">
                            </div>

                            <div class="form-group">
                                <label for="descricao">Descrição</label>
                                <textarea class="form-control" id="descricao" name="descricao" rows="4"></textarea>
                            </div>

                            <div class="form-group">
                                <label for="ano">Ano de lançamento</label>
                                <input type="number" class="form-control" id="ano" name="ano">
                            </div>

                            <div class="form-group">
                                <label for="trailer">Trailer</label>
                                <input type="text" class="form-control" id="trailer" name="trailer">
                            </div>

                            <div class="form-group">
                                <label for="image">Cartaz</label>
                                <input type="file" class="form-control-file" id="image" name="cartaz">
                            </div>

                            <div class="text-center mt-4">
                                <button type="submit" class="btn btn-primary">Criar filme</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
