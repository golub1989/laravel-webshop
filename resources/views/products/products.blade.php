@extends('welcome')

@section('content')
@foreach($products as $product)
    {{$product->name}}
    {{$product->description}}
    {{$product->price}}
    <!-- {{$product->image}} -->
    <img src="{{ asset('/storage/images/'.$product->image) }}" style="height: 100px;width:100px;">


    <!-- <a href="{{ url('product/{id}') }}">View</a> -->
    <a href="{{ url('product' , [ 'id' => $product->id ]) }}">View</a>

@endforeach
@endsection


