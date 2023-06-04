<!DOCTYPE html>
<html>

<head>
    <title>Bilhete</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .ticket {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
            margin: 20px auto;
            max-width: 400px;
            padding: 20px;
            text-align: center;
        }

        .ticket .logo {
            margin-bottom: 20px;
        }

        .ticket .movie-name {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .ticket .session-info {
            color: #777;
            font-size: 14px;
            margin-bottom: 20px;
        }

        .ticket .seat-info {
            font-size: 18px;
            margin-bottom: 10px;
        }

        .ticket .client-info {
            margin-bottom: 20px;
        }

        .ticket .client-info img {
            border-radius: 50%;
            height: 80px;
            width: 80px;
        }

        .ticket .client-info h4 {
            margin-top: 10px;
        }

        .ticket .status-info {
            font-size: 18px;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="ticket">
            <img src="path/to/logo.png" alt="Logo" class="logo">
            <h2 class="movie-name">The Movie</h2>
            <p class="session-info">Session Room: <span id="session-room">{{ $bilhete->sessao_id }}</span> | Date: <span
                    id="session-date">22222222</span>
                | Time: <span id="session-time">222222</span></p>
            <p class="seat-info">Seat: <span id="seat">{{ $bilhete->lugar_id }}</span></p>
            <div class="client-info">
                <img class="card-img-top" src="{{ url('storage/fotos/' . Auth()->user()->foto_url) }}" alt="" />
                <h4 id="client-name">{{ Auth()->user()->name }}</h4>
            </div>
            <p class="status-info">Ticket Status: <span id="ticket-status">{{ $bilhete->estado }}</span></p>
        </div>
    </div>
</body>

</html>
