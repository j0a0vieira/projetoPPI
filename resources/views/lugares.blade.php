<!DOCTYPE html>
<html>

<head>
    <title>Cinema Room Simulation</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <style>
        .seat {
            margin: 5px;
            width: 30px;
            height: 30px;
            background-color: #e9ecef;
            border-radius: 3px;
            cursor: pointer;
        }

        .seat.selected {
            background-color: #6c757d;
            cursor: default;
        }

        .row-label {
            display: inline-block;
            width: 40px;
            text-align: right;
            margin-right: 10px;
        }

        .center-square {
            display: flex;
            justify-content: center;
        }
    </style>
</head>

<body>
    <div class="container mt-5">
        <h2>Cinema Room Simulation</h2>
        <div class="row">
            <div class="col-md-12">
                <div id="cinema-room">
                    @foreach ($lugares as $lugar)
                        @if ($loop->first)
                            <div class="center-square">
                        @endif

                        @if ($lugar->row != $prevRow)
                </div>
                <div class="center-square">
                    <div class="row-label">{{ $lugar->row }}</div>
                    @endif

                    <div class="seat" data-row="{{ $lugar->row }}" data-number="{{ $lugar->number }}"></div>

                    @php
                        $prevRow = $lugar->row;
                    @endphp

                    @if ($loop->last)
                </div>
                @endif
                @endforeach
            </div>
        </div>
    </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>

</html>
