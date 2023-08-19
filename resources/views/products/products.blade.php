@extends('welcome')

@section('content')
    @foreach($products as $product)
        {{$product->name}}
        {{$product->description}}
        {{$product->price}}
        <a href="{{ url('product' , [ 'id' => $product->id ]) }}"><img src="{{ asset('/storage/images/'.$product->image) }}" style="height: 100px;width:100px;"></a>
    @endforeach
@endsection


