@extends('welcome')
@section('content')
    <h1>Cart Items</h1>
    @php 
         $currency = '$';
    @endphp
    @php
        $totalPrice = 0;
    @endphp
    @if (count($cart->cartItems) > 0)
        <ul>
            @foreach ($cart->cartItems as $cartItem)
                {{ $cartItem->product->name }}<br>
                {{ $cartItem->product->description }}<br>
                {{ $cartItem->product->price }}{{ $currency }}<br>
                 Quantity: {{ $cartItem->quantity }}<br>
                <img src="{{ asset('storage/images/'.$cartItem->product->image) }}" style="height: 250px;width:250px;">
                Subtotal: {{ $subtotal = $cartItem->product->price * $cartItem->quantity }}{{ $currency }}<br>

                <a href="{{ route('cart.destroy', ['cartItemId' => $cartItem->id]) }}">Remove</a>
                @php
                $totalPrice += $subtotal;
            @endphp
            @endforeach
            <a href="{{ url('checkout') }}">Place your order</a>
            <a href="{{ route('cart.clear') }}">Clear Cart</a>
           
        
        Total Price: {{ $totalPrice }}{{ $currency }}
        </ul>
       

    @else
        <p>Your cart is empty.</p>
    @endif

@endsection