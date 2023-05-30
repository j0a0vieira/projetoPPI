<div class="card m-2" style="width: 15rem;">

    @if ($filme->cartaz_url)
        <img class="card-img-top" src="{{ url('storage/cartazes/' . $filme->cartaz_url) }}" alt="" />
    @else
        <img class="card-img-top" src="{{ url('storage/cartazes/no-image.jpg') }}" alt="" />
    @endif

    <div class="card-body d-flex flex-column">
        <h5 class="card-title">{{ $filme->titulo }}</h5>
        <p class="card-text">{{ $filme->sumario }}</p>
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
    </div>
</div>
