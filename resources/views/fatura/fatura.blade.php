<!DOCTYPE html>
<html>

<head>
    <title>Invoice Template</title>
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
                    <h2>Recibo #99999</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="invoice-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Filme</th>
                                <th>Quantidade</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($itemsCarrinho as $index => $item)
                                <tr>
                                    <td>{{ $item['nome'] }}</td>
                                    <td>{{ $item['quantidade'] }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="invoice-footer">
                    <h3>TOTAL C/IVA: {{ $info['precoTotal'] }}€</h3>
                    <h4>TOTAL S/IVA: {{ $info['precoTotalSemIVA'] }}€</h4>
                    <h4>IVA: {{ $info['iva'] }}€</h4>
                    <p>Nome: {{ $info['user']->name }}</p>
                    <p>NIF: {{ $info['user']->nif ?? 'Não especificado' }}</p>
                    <p>Data de Compra: {{ $info['dataCompra'] }}</p>
                    <p>Método de Pagamento: {{ $info['tipoPagamento'] }}</p>
                    <p>Referência de Pagamento: {{ $info['refPagamento'] }}</p>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
