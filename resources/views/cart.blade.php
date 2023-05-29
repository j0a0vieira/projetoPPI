<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <title>Carrinho</title>
    <style>
        .payment-fields {
            display: none;
        }
    </style>
</head>

<body>
    <x-navbar />
    <div class="container mt-5">
        <h1>Carrinho</h1>
        <table class="table">
            <thead>
                <tr>
                    <th class="w-50">Filme</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody class="items-cart">
                @foreach ($itemsCarrinho as $index => $item)
                    <tr>
                        <td class="w-50">{{ $item['nome'] }}</td>
                        <td>
                            <form action="{{ route('removeCarrinho', ['index' => $index]) }}" method="POST">
                                @csrf
                                <button class="btn btn:primary" type="submit">Remover</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="form-group mt-5">
            <label for="payment-method">Selecione o método de pagamento:</label>
            <select class="form-control" id="payment-method" onchange="showPaymentFields(this.value)">
                <option value="">-- Selecione o método de pagamento --</option>
                <option value="paypal">PayPal</option>
                <option value="mbway">MBWay</option>
                <option value="visa">Visa Card</option>
            </select>
        </div>

        <div id="paypal-fields" class="payment-fields">
            <!-- PayPal fields here -->
            <div class="form-group">
                <label for="paypal-email">PayPal Email:</label>
                <input type="email" class="form-control" id="paypal-email" placeholder="Enter your PayPal email">
            </div>
        </div>

        <div id="mbway-fields" class="payment-fields">
            <!-- MBWay fields here -->
            <div class="form-group">
                <label for="mbway-phone">Phone Number:</label>
                <input type="tel" class="form-control" id="mbway-phone" placeholder="Enter your phone number">
            </div>
        </div>

        <div id="visa-fields" class="payment-fields">
            <!-- Visa Card fields here -->
            <div class="form-group">
                <label for="visa-card-number">Card Number:</label>
                <input type="text" class="form-control" id="visa-card-number" placeholder="Enter your card number">
            </div>
            <div class="form-group">
                <label for="visa-card-expiry">Expiry Date:</label>
                <input type="text" class="form-control" id="visa-card-expiry" placeholder="MM/YY">
            </div>
            <div class="form-group">
                <label for="visa-card-cvv">CVV:</label>
                <input type="text" class="form-control" id="visa-card-cvv" placeholder="Enter CVV">
            </div>
        </div>

        <button type="submit" class="btn btn-primary" id="checkout-button" disabled>Checkout</button>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        function showPaymentFields(paymentMethod) {
            // Hide all payment fields
            $(".payment-fields").hide();

            // Show the selected payment fields
            $("#" + paymentMethod + "-fields").show();

            // Enable or disable the checkout button based on the selected payment method
            if (paymentMethod !== "") {
                $("#checkout-button").prop("disabled", false);
            } else {
                $("#checkout-button").prop("disabled", true);
            }
        }
    </script>
</body>

</html>
