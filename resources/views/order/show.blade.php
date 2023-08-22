@extends('welcome')
@section('content')
@php
    $totalPrice = 0;
@endphp
@foreach ($orders->orderItems as $orderItem)
    {{ $orderItem->product->name }}<br>
    {{ $orderItem->product->description }}<br>
    Subtotal: {{ $subtotal = $orderItem->product->price * $orderItem->quantity }}<br>
    <img src="{{ asset('storage/images/'.$orderItem->product->image) }}" style="height: 250px;width:250px;">

    @php
        $totalPrice += $subtotal;
    @endphp
 @endforeach

 Total Price: {{ $totalPrice }}

 @endsection