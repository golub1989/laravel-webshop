@extends('welcome')
@section('content')
<h1 style="text-align:center">My orders</h1>

    @php 
         $currency = '$';
    @endphp
@php
    $totalPrice = 0;
@endphp
@if (count($orders) > 0) 
@foreach ($orders as $order)
        <div class="order">
           
            <ul>
                @foreach ($order->orderItems as $item)
                    <li>{{ $item->product->name }} - Quantity: {{ $item->quantity }}</li>
                @endforeach
            </ul>
        </div>
        
    @endforeach
    @else 
        <p>You don't have any orders yet.</p>
    @endif
 @endsection