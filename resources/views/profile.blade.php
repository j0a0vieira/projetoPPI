@extends('./layouts/main-layout')

@section('main')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <!-- Page title -->
                <div class="my-5">
                    <h3>Perfil</h3>
                    <hr>
                </div>
                <!-- Form START -->
                <form class="file-upload" id="formAccountSettings" method="POST"
                    action="{{ route('profile.update', $user->id) }}" enctype="multipart/form-data" class="needs-validation"
                    role="form" novalidate>
                    @csrf
                    <div class="row mb-5">
                        <div class="col-8 mb-5 mb-0">
                            <div class="bg-secondary-soft px-4 py-5 rounded">
                                <div class="row">
                                    <h4 class="mb-4 mt-0 col-12">Detalhes da conta</h4>
                                    <div class="col-md-6">
                                        <label class="form-label">Nome *</label>
                                        <input type="text" class="form-control" placeholder="" aria-label="First name"
                                            value="{{ $user->name }}" name="name"
                                            @if (optional(Auth()->user())->tipo == 'A' && $user->tipo == 'C') disabled @endif>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">NIF (opcional)</label>
                                        <input type="number" class="form-control" placeholder="" aria-label="NIF"
                                            value="{{ optional($user->cliente)->nif ?? '' }}" name="nif"
                                            @if (optional(Auth()->user())->tipo == 'A' && $user->tipo == 'C') disabled @endif>

                                    </div>
                                    <div class="col-md-6 mt-2">
                                        <label class="form-label">Email *</label>
                                        <input type="email" class="form-control" placeholder="" aria-label="Email"
                                            value="{{ $user->email }}" name="email"
                                            @if (optional(Auth()->user())->tipo == 'A' && $user->tipo == 'C') disabled @endif>
                                    </div>
                                    @if ($user->tipo == 'C')
                                        <div class="col-md-4">
                                            <label class="form-label">Tipo de pagamento</label>
                                            <select class="form-select" aria-label="Default select example"
                                                name="tipo_pagamento" @if (optional(Auth()->user())->tipo == 'A' && $user->tipo == 'C') disabled @endif>
                                                <option @if (optional($user->cliente)->tipo_pagamento == 'MBWAY') selected @endif value="MBWAY">
                                                    MBWAY
                                                </option>
                                                <option @if (optional($user->cliente)->tipo_pagamento == 'VISA') selected @endif value="VISA">
                                                    VISA</option>
                                                <option @if (optional($user->cliente)->tipo_pagamento == 'PAYPAL') selected @endif value="PAYPAL">
                                                    PAYPAL</option>
                                            </select>
                                        </div>
                                    @endif

                                    @if (auth()->user() && $user->id == auth()->user()->id && $user->email_verified_at == null)
                                        <div class="alert alert-warning alert-dismissible fade show mt-5" role="alert">
                                            <strong>Aviso!</strong> O seu email ainda não foi verificado! Verifique o seu
                                            email!
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <!-- Upload profile -->
                        <div class="col-4">
                            <div class="bg-secondary-soft px-4 py-5 rounded">
                                <div class="row">
                                    <h4 class="mb-4 mt-0 col-12">Foto de perfil</h4>
                                    <div class="text-center">
                                        <div class="picture-container">
                                            <div class="picture">
                                                <img class="card-img-top"
                                                    src="{{ url('storage/fotos/' . $user->foto_url) }}" alt="" />
                                                <input type="file" class="mt-2" name="foto"
                                                    @if (optional(Auth()->user())->tipo == 'A' && $user->tipo == 'C') disabled @endif>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Row END -->
                    <div class="gap-3 d-md-flex justify-content-md-end text-center">
                        <button type="submit" class="btn btn-primary"
                            @if (optional(Auth()->user())->tipo == 'A' && $user->tipo == 'C') disabled @endif>Submeter alterações</button>
                    </div>
                </form>
                <!-- Form END -->
            </div>
        </div>
    </div>
@endsection
