<!-- payment/form.blade.php -->

<form action="{{ route('payment.process') }}" method="POST">
    @csrf

    <div class="form-group mt-5">
        <label for="payment-method">Selecione o método de pagamento:</label>
        <select class="form-control" id="payment-method" name="payment_method">
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
            <input type="email" class="form-control" id="paypal-email" name="paypal_email"
                placeholder="Enter your PayPal email">
        </div>
    </div>

    <div id="mbway-fields" class="payment-fields">
        <!-- MBWay fields here -->
        <div class="form-group">
            <label for="mbway-phone">Phone Number:</label>
            <input type="tel" class="form-control" id="mbway-phone" name="mbway_phone"
                placeholder="Enter your phone number">
        </div>
    </div>

    <div id="visa-fields" class="payment-fields">
        <!-- Visa Card fields here -->
        <div class="form-group">
            <label for="visa-card-number">Card Number:</label>
            <input type="text" class="form-control" id="visa-card-number" name="visa_card_number"
                placeholder="Enter your card number" maxlength="16">
        </div>
        <div class="form-group">
            <label for="visa-card-expiry">Expiry Date:</label>
            <input type="text" class="form-control" id="visa-card-expiry" name="visa_card_expiry" placeholder="MM/YY"
                maxlength="5">
        </div>
        <div class="form-group">
            <label for="visa-card-cvv">CVV:</label>
            <input type="text" class="form-control" id="visa-card-cvv" name="visa_card_cvv" placeholder="Enter CVV"
                maxlength="3">
        </div>
    </div>

    <button type="submit" class="btn btn-primary" id="checkout-button">Checkout</button>
</form>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        var paymentMethod = document.getElementById("payment-method");
        var paypalFields = document.getElementById("paypal-fields");
        var mbwayFields = document.getElementById("mbway-fields");
        var visaFields = document.getElementById("visa-fields");

        paymentMethod.addEventListener("change", function() {
            var selectedPaymentMethod = paymentMethod.value;

            paypalFields.style.display = "none";
            mbwayFields.style.display = "none";
            visaFields.style.display = "none";

            if (selectedPaymentMethod === "paypal") {
                paypalFields.style.display = "block";
            } else if (selectedPaymentMethod === "mbway") {
                mbwayFields.style.display = "block";
            } else if (selectedPaymentMethod === "visa") {
                visaFields.style.display = "block";
            }
        });
    });
</script>
