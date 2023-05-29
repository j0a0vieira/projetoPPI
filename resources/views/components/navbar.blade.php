<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="{{ url('/') }}">Cineplace Poor</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav"
        aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item active">
                <a class="nav-link" href="{{ url('/') }}">Filmes</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Bilhetes</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Carrinho</a>
            </li>
        </ul>
    </div>
    <div class="float-left">
        @if (Auth::check())
            @if (Auth()->user()->tipo != 'F')
                <a href="{{ url('profile') }}" class="btn btn-info" role="button">Profile</a>
            @endif
            @if (Auth()->user()->tipo == 'A')
                <a href="{{ url('funcionarios') }}" class="btn btn-info" role="button">Funcionários</a>
                <a href="{{ url('users') }}" class="btn btn-info" role="button">Clientes</a>
                <a href="{{ url('administradores') }}" class="btn btn-info" role="button">Admins</a>
                <a href="{{ url('newUser') }}" class="btn btn-info" role="button">Nova Conta</a>
            @endif
            <a href="{{ url('logout') }}" class="btn btn-info" role="button">Logout</a>
        @else<a href="{{ url('/login') }}" class="btn btn-info" role="button">Login</a>
        @endif
    </div>
</nav>
