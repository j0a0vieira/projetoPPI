@extends('./layouts/main-layout')
@section('main')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header">
                        <h4>Nova Sala</h4>
                    </div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('novaSala') }}" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group">
                                <label for="titulo">Nome</label>
                                <input type="text" class="form-control" id="titulo" name="nome">
                            </div>

                            <div class="form-group">
                                <label for="titulo">Quantidade de cadeiras</label>
                                <input type="number" class="form-control" id="titulo" name="cadeiras">
                            </div>
                            <button type="submit" class="btn btn-primary">Nova sala</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
