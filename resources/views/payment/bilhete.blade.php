<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Cinema Ticket</title>
    <style>
        .ticket {
            max-width: 400px;
            margin: 0 auto;
            background-color: #f8f9fa;
            padding: 20px;
            border: 1px solid #ced4da;
            border-radius: 5px;
        }

        .ticket-info {
            margin-bottom: 30px;
        }

        .ticket-info h4 {
            margin-bottom: 10px;
        }

        .ticket-id {
            font-weight: bold;
        }

        .ticket-status {
            font-weight: bold;
            text-transform: uppercase;
        }

        .ticket-details {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }

        .ticket-details img {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            margin-right: 10px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="ticket">
            <div class="ticket-info text-center">
                <h4>Bilhete #{{ $bilhete->id }}</h4>
                <p class="ticket-status">Estado: {{ $bilhete->estado }}</p>
            </div>
            <div class="ticket-details">
                <img class="card-img-top" src="{{ url('/storage/fotos/' . $bilhete->cliente->user->foto_url) }}"
                    alt="" />
                <div>
                    <h4>Cliente: {{ $bilhete->cliente->user->name }}</h4>
                    <p>Sala: {{ $bilhete->sessao->sala->nome }}</p>
                    <p>Lugar: {{ $bilhete->lugar->fila }}{{ $bilhete->lugar->posicao }}</p>
                </div>
            </div>
            <div class="text-center">
                <h4>Filme: {{ $bilhete->sessao->filme->titulo }}</h4>
                <p>Data: {{ $bilhete->sessao->data }} às {{ $bilhete->sessao->horario_inicio }}</p>
            </div>
        </div>
    </div>
</body>

</html>
