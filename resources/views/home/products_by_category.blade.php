@extends('welcome')

@section('content')
    <div class="mt-16">
        @if(isset($category))
            <h3 class="text-gray-600 text-2xl font-medium">{{ $category->name }}</h3>
            <div class="grid gap-6 grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 mt-6">
                @foreach ($products as $product)
                    <div class="w-full max-w-sm mx-auto rounded-md shadow-md overflow-hidden">
                        <div class="flex items-end justify-end h-56 w-full bg-cover"><img src="{{ asset('/storage/images/'.$product->image) }}" class="w-full h-56"></a>
                            <form class="add-quantity-form">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                <input type="hidden" name="quantity" value="1" min="1">
                                <button class="p-2 rounded-full bg-blue-600 text-white mx-5 -mb-4 hover:bg-blue-500 focus:outline-none focus:bg-blue-500">
                                    <svg class="h-5 w-5" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor"><path d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                                    </button>
                            </form>
                        </div>

                        <div class="px-5 py-3">
                            <h3 class="text-gray-700 uppercase">{{ $product->name }}</h3>
                            <span class="text-gray-500 mt-2">{{ number_format($product->price, 2, '.', '') }}€</span>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.add-quantity-form').on('click', function(event) {
                event.preventDefault();
                var form = $(this).closest('.add-quantity-form');
                var product_id = form.find('input[name="product_id"]').val();
                var quantity = form.find('input[name="quantity"]').val();
                var cartCount = $('.cart-count');
                console.log(cartCount);
                $.ajax({
                    type: 'POST',
                    url: '{{ route('cart.add') }}',
                    data: {
                        _token: '{{csrf_token()}}',
                        product_id: product_id,
                        quantity: quantity,
                    },
                    success: function (response) {
                        let quantityElement = form.find('.quantity');
                        quantityElement.text(response.quantity);
                        cartCount.text(response.cartCount);

                    },
                    error: function (request, status, error) {
                        alert(error);
                    }
                })
            });
        });
    </script>
@endsection