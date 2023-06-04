<!DOCTYPE html>
<html>

<head>
    <title>Recibo</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .invoice-header {
            padding: 20px;
            background-color: #f8f9fa;
        }

        .invoice-body {
            padding: 20px;
        }

        .invoice-footer {
            padding: 20px;
            background-color: #f8f9fa;
        }

        .table th {
            background-color: #f8f9fa;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="invoice-header">
                    <h2>Recibo #{{ $recibo->id }}</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="invoice-footer">
                    <h3>TOTAL C/IVA: {{ $recibo->precoTotal }}€</h3>
                    <h4>TOTAL S/IVA: {{ $recibo->precoTotalSemIVA }}€</h4>
                    <h4>IVA: {{ $recibo->iva }}€</h4>
                    <p>Nome: {{ Auth()->user()->name }}</p>
                    <p>NIF: {{ Auth()->user()->nif ?? 'Não especificado' }}</p>
                    <p>Data de Compra: {{ $recibo->dataCompra }}</p>
                    <p>Método de Pagamento: {{ $recibo->tipoPagamento }}</p>
                    <p>Referência de Pagamento: {{ $recibo->refPagamento }}</p>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
