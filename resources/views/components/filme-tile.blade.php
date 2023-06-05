<div class="row">
    <div class="col-md-12">
        <div class="card mb-3">
            <div class="row g-0">
                <div class="col-md-3">
                    @if ($filme->cartaz_url)
                        <img class="img-fluid rounded-start" src="{{ url('storage/cartazes/' . $filme->cartaz_url) }}"
                            alt="" />
                    @else
                        <img class="img-fluid rounded-start" src="{{ url('storage/cartazes/no-image.png') }}"
                            alt="" />
                    @endif
                </div>
                <div class="col-md-8">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title text-center">{{ $filme->titulo }}</h5>
                        <p class="card-text text-center">{{ $filme->sumario }}</p>
                        <div class="d-flex flex-column align-items-center">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="session" id="session1"
                                    value="Session 1" checked>
                                <label class="form-check-label" for="session1">Session 1</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="session" id="session2"
                                    value="Session 2">
                                <label class="form-check-label" for="session2">Session 2</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="session" id="session3"
                                    value="Session 3">
                                <label class="form-check-label" for="session3">Session 3</label>
                            </div>
                            <div>
                            <a href="{{ route('lugares') }}" class="btn btn-primary">Lugares</a>

                            </div>
                          
                        </div>
                        <div class="mt-auto text-end">
                            <a href="#" class="btn btn-primary">Button 1</a>
                            <a href="#" class="btn btn-secondary">Button 2</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
