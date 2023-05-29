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
        <div class="row">
            @foreach ($filmes as $filme)
                <x-filme-tile :filme="$filme" />
            @endforeach
        </div>
    </div>

    </script>
</body>

</html>
