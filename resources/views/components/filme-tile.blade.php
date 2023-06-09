<div class="col-md-4 mt-2">
    <div class="card h-100 d-flex flex-column">
        @if ($filme->cartaz_url)
            <img class="card-img-top" src="{{ url('storage/cartazes/' . $filme->cartaz_url) }}" alt="" />
        @else
            <img class="card-img-top" src="{{ url('storage/cartazes/no-image.png') }}" alt="" />
        @endif
        <div class="card-body d-flex flex-column">
            <h5 class="card-title">{{ $filme->titulo }}&ThickSpace;<span
                    class="font-weight-light">{{ $filme->genero_code }}</span></h5>
            <p class="card-text flex-grow-1">{{ $filme->sumario }}</p>
            <form action="{{ route('selecionarLugares') }}" method="get">
                @csrf
                <input type="hidden" name="id" value="{{ $filme->id }}">
                <input type="hidden" name="filme" value="{{ $filme->titulo }}">
                <ul class="list-group list-group-flush" style="max-height: 200px; overflow-y: auto;">
                    @foreach ($sessoes as $sessao)
                        @if ($sessao->filme_id == $filme->id)
                            <li class="list-group-item">
                                <input type="radio" name="sessao_id" value="{{ $sessao->id }}" required>
                                <span class="session-details" data-date="{{ $sessao->data }}"
                                    data-start-time="{{ $sessao->horario_inicio }}"
                                    data-end-time="{{ $sessao->horario_fim }}">
                                    {{ $sessao->data }} - {{ $sessao->horario_inicio }}
                                </span>
                            </li>
                        @endif
                    @endforeach
                </ul>
                <div class="card-body">
                    @if (Auth::user() && Auth()->user()->tipo == 'A')
                        <a href="{{ route('filme-detalhes', ['id' => $filme->id]) }}"
                            class="btn btn-primary">Consultar</a>
                    @endif
                    <button id="modalButton" class="mt-1 btn btn-primary" type="button" style="display: none;">View
                        Seats</button>
                    <button class="mt-1 btn btn-primary" type="submit">Adicionar ao carrinho</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
