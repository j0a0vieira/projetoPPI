<!DOCTYPE html>
<html>

<head>
    <title>Recibo</title>
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

        .table {
            /* Add your table styles here */
            /* For example: */
            border-collapse: collapse;
            width: 100%;
        }

        .table th,
        .table td {
            /* Add your cell styles here */
            /* For example: */
            border: 1px solid #ddd;
            padding: 8px;
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
                    <h3>TOTAL C/IVA: {{ $recibo->preco_total_com_iva }}€</h3>
                    <h4>TOTAL S/IVA: {{ $recibo->preco_total_sem_iva }}€</h4>
                    <h4>IVA: {{ $recibo->iva }}€</h4>
                    <p>Nome: {{ $recibo->nome_cliente }}</p>
                    <p>NIF: {{ $recibo->nif ?? 'Não especificado' }}</p>
                    <p>Data de Compra: {{ $recibo->data }}</p>
                    <p>Método de Pagamento: {{ $recibo->tipo_pagamento }}</p>
                    <p>Referência de Pagamento: {{ $recibo->ref_pagamento }}</p>

                    <h4>Bilhetes:</h4>
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Filme</th>
                                <th scope="col">Sala</th>
                                <th scope="col">Data</th>
                                <th scope="col">Horario</th>
                                <th scope="col">Lugar</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($bilhetes as $bilhete)
                                <tr>
                                    <td scope="row">{{ $bilhete->id }}</td>
                                    <td>{{ $bilhete->sessao->filme->titulo }}</td>
                                    <td>{{ $bilhete->sessao->sala->nome }}</td>
                                    <td>{{ $bilhete->sessao->data }} </td>
                                    <td>{{ $bilhete->sessao->horario_inicio }} </td>
                                    <td>{{ $bilhete->lugar->fila }} - {{ $bilhete->lugar->posicao }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</body>

</html>
