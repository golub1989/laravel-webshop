<html>
<head>
    <title>View Cart</title>
</head>
<body>
    <h1>Cart Items</h1>

    @if ($cart)
        <ul>
            @foreach ($cart->cartItems as $cartItem)
                <li>
                    Product Name: {{ $cartItem->product->name }}<br>
                    Quantity: {{ $cartItem->quantity }}
                </li>
            @endforeach
        </ul>
    @else
        <p>Your cart is empty.</p>
    @endif
</body>
</html>