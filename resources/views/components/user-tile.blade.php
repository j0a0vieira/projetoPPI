<tr class="candidates-list">
    <td class="title">
        <div class="thumb">
            @if ($user->foto_url)
                <img class="img-fluid" src="{{ url('storage/fotos/' . $user->foto_url) }}" alt="" />
            @else
                <img class="img-fluid" src="{{ url('storage/fotos/user.png') }}" alt="" />
            @endif
        </div>
        <div class="candidate-list-details">
            <div class="candidate-list-info">
                <div class="candidate-list-title">
                    <h5 class="mb-0">{{ $user->name }}</h5>
                </div>
            </div>
        </div>
    </td>
    <td>
        <ul class="list-unstyled mb-0 d-flex justify-content-end">
            @if (Auth()->user()->tipo == 'A')
                <li><a href="{{ route('user-profile', ['id' => $user->id]) }} target="_blank" class="btn btn-primary">
                        Consultar
                    </a></li>
            @endif
            <li><a href="{{ route('block-profile', ['id' => $user->id]) }} target="_blank" class="btn btn-danger">
                    {{ $user->bloqueado ? 'Desbloquear' : 'Bloquear' }}
                </a></li>
            <li>
                <form action="{{ route('delete-profile', $user->id) }}">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger" type="submit">Eliminar</button>
                </form>
            </li>
        </ul>
    </td>
</tr>
