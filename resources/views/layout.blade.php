<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{ URL::asset('css/estilos.css') }} " rel="stylesheet">
    <title>Filmes</title>
</head>

<body>
    <x-navbar />
    <div class="container">
        <div class="search-bar">
            <div class="row">
                <div class="col-md-7">
                    <form action="{{ route('searchFilme') }}" method="GET" class="d-flex m-2">
                        <div class="input-group">
                            <input type="text" class="form-control" name="searchText"
                                placeholder="Procurar por nome">
                        </div>
                        <div class="input-group ml-2">
                            <input type="text" class="form-control" name="searchGenero"
                                placeholder="Procurar por genero (inglês)">
                        </div>
                        <button class="btn btn-primary ml-2" type="submit">Search</button>
                    </form>
                </div>

            </div>
        </div>
        <div class="row">
            @foreach ($filmes as $filme)
                <x-filme-tile :sessoes="$sessoes" :filme="$filme" />
            @endforeach

        </div>
    </div>

    </script>
</body>

</html>
