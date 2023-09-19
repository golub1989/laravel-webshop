@extends('welcome')
@section('content')
    <div class="container mx-auto px-4 py-8">
        <div class="mt-8">
            @if(isset($cart->cartItems) && count($cart->cartItems) > 0)
                <div class="flex flex-col md:flex-row md:justify-between md:items-center">
                    <h1 class="text-2xl font-bold my-4">Shopping Cart</h1>
                    <button class="button-proceed bg-indigo-500 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded">
                        <a href="{{ route('checkout') }}">Proceed to checkout</a>
                    </button>
                </div>
                @foreach($cart->cartItems as $cartItem)
                    <div class="flex flex-col md:flex-row border-b border-gray-400 py-4">
                        <div class="flex-shrink-0">
                            <img src="{{ asset('storage/images/'.$cartItem->product->image) }}" alt="Product image" class="w-32 h-32 object-cover">
                        </div>
                        <div class="mt-4 md:mt-0 md:ml-6">

                            <h2 class="text-lg font-bold">{{ $cartItem->product->name }}</h2>
                            <p class="mt-2 text-gray-600">{{ $cartItem->product->description }}</p>
                            <div class="mt-4 flex items-center">
                                <span class="mr-2 text-gray-600">Quantity:</span>
                                <div class="flex items-center">
                                    <form class="change-quantity-form">
                                        @csrf
                                        <input type="hidden" name="product_id" value="{{ $cartItem->product->id }}">
                                        <button type="button" class="change-quantity-btn bg-gray-200 rounded-l-lg px-2 py-1" data-action="decrement">-</button>
                                        <span class="quantity mr-2 text-gray-600">{{ $cartItem->quantity }}</span>
                                        <small class="error"></small>
                                        <button type="button" class="change-quantity-btn bg-gray-200 rounded-l-lg px-2 py-1" data-action="increment">+</button>
                                        <span class="price ml-auto font-bold">{{ number_format($cartItem->product->price, 2, '.', '') }}€</span>
                                    </form>
                                </div>
                            </div>
                            <a class="destroy" href="{{ route('cart.destroy', ['cartItemId' => $cartItem->id]) }}">Remove</a>
                        </div>
                    </div>
                    <a href="{{ route('cart.clear') }}" class="bg-red-700 hover:bg-red-400 font-bold py-3 px-3 rounded relative inset-3">Clear Cart</a>
                @endforeach
            @else
                Your cart is empty
            @endif
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('.change-quantity-btn').on('click', function() {
                var form = $(this).closest('.change-quantity-form');
                var product_id = form.find('input[name="product_id"]').val();
                var action = $(this).data('action');
                var cartCount = $('.cart-count');
                var price = {{ isset($cartItem) ? $cartItem->product->price : 0 }};
                $.ajax({
                    type: 'POST',
                    url: '{{ route('cart.changeQuantity') }}',
                    data: {
                        _token: '{{csrf_token()}}',
                        product_id: product_id,
                        action: action,
                    },

                    // var priceElement = form.find('.price')

                    success: function (response) {
                        console.log(response);
                        let quantityElement = form.find('.quantity');
                        quantityElement.text(response.quantity);
                        $('.price').text("$"+(response.quantity * price).toFixed(2));
                        if (response.quantity < 1) {
                            $('.error').text('Quantity of minimum 1 is required');
                            $("button[data-action=\"decrement\"]").prop('disabled', true);
                            cartCount.text("");
                        } else {
                            $("button[data-action=\"decrement\"]").prop('disabled', false);
                        }
                        cartCount = response.quantity;
                        $('.cart-count').text(cartCount);

                    },
                    error: function () {
                        alert('error occurred');
                    }
                });
            });
        });
    </script>
@endsection