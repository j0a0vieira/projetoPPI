@extends('./layouts/main-layout')
@section('main')
    <h1 class="text-center mt-4">Sala: {{ $sessao->sala->nome }}</h1>
    <div>
        @php
            $rows = $numeroFilas;
            $columns = $numeroLugares;
        @endphp

        <div>
            <form action="{{ route('addCarrinho') }}" method="POST">
                @csrf
                <input type="hidden" name="sessao" value="{{ $sessao->id }}">

                @for ($row = 1; $row <= $rows; $row++)
                    <div class="d-flex justify-content-center">
                        @for ($column = 1; $column <= $columns; $column++)
                            <?php
                            $seat = $sessao->sala->lugares
                                ->where('fila', chr(64 + $row))
                                ->where('posicao', $column)
                                ->first();
                            $rowLetter = chr(64 + $row);
                            $seatId = $column . '-' . $rowLetter;
                            ?>

                            <div class="seat" style="margin-left: 20px;" id="{{ $seatId }}"
                                onclick="toggleSeat('{{ $seatId }}')">
                                <p>{{ $seatId }}</p>
                                <input type="checkbox" name="seatId[]" value="{{ $seatId }}">
                            </div>
                        @endfor
                    </div>
                @endfor

                <div class="col-md-12 text-center">
                    <button type="submit" class="btn btn-primary mt-4">Selecionar lugar e adicionar ao
                        carrinho</button>
                </div>
            </form>

        </div>
    </div>

    <script>
        function toggleSeat(seatId) {
            var seat = document.getElementById(seatId);

            if (seat.classList.contains('selected')) {
                seat.classList.remove('selected');
            } else {
                seat.classList.add('selected');
            }
        }
    </script>
@endsection
