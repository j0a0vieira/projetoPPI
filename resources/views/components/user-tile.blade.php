<div class="card m-2" style="width: 19rem;">

    @if ($user->foto_url)
        <img class="card-img-top" src="{{ url('storage/fotos/' . $user->foto_url) }}" alt="" />
    @else
        <img class="card-img-top" src="{{ url('storage/fotos/no-image.jpg') }}" alt="" />
    @endif

    <div class="card-body d-flex flex-column">
        <h5 class="card-title">{{ $user->name }}</h5>
        <div class="card-buttons mt-auto">
            <a href="{{ route('user-profile', ['id' => $user->id]) }} target="_blank" class="btn btn-primary">Ver
                perfil</a>
        </div>
    </div>
</div>
