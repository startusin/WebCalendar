<!DOCTYPE html>
<html>
<head>
    <title>Buy cool new product</title>
    <script src="https://js.stripe.com/v3/"></script>
</head>
<body>
<section>
    <form action="/create-checkout-session" method="POST">@csrf
        <button type="submit" id="checkout-button">Checkout</button>
    </form>
</section>
</body>
</html>
