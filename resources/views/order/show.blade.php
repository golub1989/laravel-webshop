@extends('welcome')
@section('content')

<!-- @php
    $totalPrice = 0;
@endphp -->
<div class="container mx-auto">
    
    @foreach ($orders as $order)
        @php
            $totalPrice = 0;
        @endphp
        @foreach ($order->orderItems as $orderItem)

            <div class="my-8 h-64 rounded-md overflow-hidden bg-cover bg-center" style="background-image: url('storage/images/laptops.jpg');">
                <div class="bg-gray-900 bg-opacity-50 flex items-center h-full">
                    <div class="px-10 max-w-xl">
                        <h2 class="text-2xl text-white font-semibold">{{ $orderItem->product->name }}</h2>
                        <p class="mt-2 text-gray-400">{{ $orderItem->product->description }}</p>
                        <p class="mt-2 text-gray-400">Subtotal: {{ $subtotal = $orderItem->product->price * $orderItem->quantity }} €</p>
                        <!-- <img src="{{ asset('storage/images/'.$orderItem->product->image) }}" style="height: 100px; width: 100px;"> -->
        
                    </div>
                    <img src="{{ asset('storage/images/'.$orderItem->product->image) }}" style="height: 150px; width: 150px;">
                </div>
            </div>

            
            
           
            <!-- <img src="{{ asset('storage/images/'.$orderItem->product->image) }}" style="height: 250px; width: 250px;"> -->

            @php
                $totalPrice += $subtotal;
            @endphp
            
        @endforeach
        <h2 class="text-2xl text-black font-semibold">Total Price: {{ $totalPrice }} €</h2>
    @endforeach
</div>
<!-- <h2 class="text-2xl text-black font-semibold">Total Price: {{ $totalPrice }} €</h2> -->
<!-- Total Price: {{ $totalPrice }} -->

@endsection