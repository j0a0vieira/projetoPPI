<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalhes do filme</title>
</head>
<body>
<div class="container" style="width: 15rem;">

@if ($filme->cartaz_url)
    <img class="card-image" src="{{ url('storage/cartazes/' . $filme->cartaz_url) }}" alt="" />
@else
    <img class="card-image" src="{{ url('storage/cartazes/no-image.jpg') }}" alt="" />
@endif
<div class="contaienr">
    <div class="card">
    <h5 class="card-content h2">{{ $filme->titulo }}</h5>
    <p class="card-content p">{{ $filme->sumario }}</p>
    <div class="card-buttons mt-auto">
        <a href="{{ $filme->trailer_url }}" target="_blank" class="btn btn-primary">Ver trailer</a>
        <a href="#" class="btn btn-primary">Reservar bilhete</a>
        <form action="{{ route('addCarrinho') }}" method="POST">
            @csrf
            <input type="hidden" name="id" value="{{ $filme->id }}">
            <input type="hidden" name="filme" value="{{ $filme->titulo }}">
            <button type="submit">Add to Cart</button>
        </form>
        
    </div>
</div></div>


</div>
</body>
</html>