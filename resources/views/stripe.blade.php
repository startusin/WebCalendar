<link rel="stylesheet" href="{{ asset('/assets/css/stripe.css') }}" />
<script src="https://js.stripe.com/v3/"></script>
<form action="" method="post" id="payment-form">
    <div class="form-row">
        <p><input type="text" name="amount" placeholder="Enter Amount" /></p>
        <p><input type="email" name="email" placeholder="Enter Email" /></p>
        <label for="card-element">
            Credit or debit card
        </label>
        <div id="card-element">
            <!-- A Stripe Element will be inserted here. -->
        </div>

        <!-- Used to display form errors. -->
        <div id="card-errors" role="alert"></div>
    </div>
    <button>Submit Payment</button>

    {{ csrf_field() }}
</form>
<script>
    var publishable_key = '{{ env('STRIPE_KEY') }}';
</script>
<script src="{{ asset('/assets/js/card.js') }}"></script>
