@extends('welcome')

@section('content')
    <main class="my-8">
        <div class="container mx-auto">
            @if(isset($categories))
                @foreach($categories as $category)
                <div class="my-8 h-64 rounded-md overflow-hidden bg-cover bg-center" style="background-image: url('storage/images/laptops.jpg');">
                        <div class="bg-gray-900 bg-opacity-50 flex items-center h-full">
                            <div class="px-10 max-w-xl">
                                <h2 class="text-2xl text-white font-semibold">{{ $category->name }}</h2>
                                <p class="mt-2 text-gray-400">Otkrij laptop svojih snova - pronađi savršenu kombinaciju performansi, stila i funkcionalnosti.</p>
                                <button class="flex items-center mt-4 px-3 py-2 bg-blue-600 text-white text-sm uppercase font-medium rounded hover:bg-blue-500 focus:outline-none focus:bg-blue-500">
                                    <a href="{{ route('home', ['category_id' => $category->id]) }}">Shop now</a>
                                    <svg class="h-5 w-5 mx-2" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor"><path d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                                </button>

                            </div>
                        </div>
                    </div>
                @endforeach

                <div class="mt-16">
                    <h3 class="text-gray-600 text-2xl font-medium">Buy now</h3>


                    <div class="grid gap-6 grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 mt-6">
                        @foreach($randomProducts as $products)
                            <div class="w-full max-w-sm mx-auto rounded-md shadow-md overflow-hidden">
                                <div class="flex items-end justify-end h-56 w-full bg-cover"><img src="{{ asset('/storage/images/'.$products->image) }}" class="w-full h-56">
                                    <form class="add-quantity-form">
                                        @csrf
                                        <input type="hidden" name="product_id" value="{{ $products->id }}">
                                        <input type="hidden" name="quantity" value="1">
                                        <button class="p-2 rounded-full bg-blue-600 text-white mx-5 -mb-4 hover:bg-blue-500 focus:outline-none focus:bg-blue-500">
                                            <svg class="h-5 w-5" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor"><path d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                                        </button>
                                    </form>
                                </div>

                                <div class="px-5 py-3">
                                    <h3 class="text-gray-700 uppercase">{{ $products->name }}</h3>
                                    <h3 class="text-gray-700 uppercase">{{ $products->description }}</h3>
                                    <span class="text-gray-500 mt-2">{{ number_format($products->price, 2, '.', '') }}€</span>
                                </div>
                            </div>

                        @endforeach
                     @endif
                </div>
            </div>
        </div>
    </main>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script>
        $(document).ready(function () {
            var counter = 0;

            $('.add-quantity-form').on('click', function(event) {
                event.preventDefault();
                var form = $(this).closest('.add-quantity-form');
                var product_id = form.find('input[name="product_id"]').val();
                var quantity = form.find('input[name="quantity"]').val();
                var cartCount = $('.cart-count');

                $.ajax({
                    type: 'POST',
                    url: '{{ route('cart.add') }}',
                    data: {
                        _token: '{{ csrf_token() }}',
                        product_id: product_id,
                        quantity: quantity,
                    },
                    success: function(response) {
                        console.log(response);
                        let quantityElement = form.find('.quantity');
                        quantityElement.text(response.quantity);
                        cartCount.text(response.cartCount);
                        let quantity = parseInt(response.quantity);
                        cartCount.text(quantity + counter);
                        counter++;
                    },
                    error: function (request, status, error) {
                        alert(error);
                    }
                })

            });
        });

        $('.on-hover-red').hover(function() {
            $(this).css('color', '#e26571');
        }, function () {
            $(this).css('color', 'black');
        })
    </script>
@endsection