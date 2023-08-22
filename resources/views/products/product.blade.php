@extends('welcome')
@section('content')
{{ $product->name ?? 'empty' }}
 <form method="POST" action="{{ route('cart.add') }}">
    @csrf
    <input type="hidden" name="product_id" value="{{ $product->id }}">
    <input type="number" name="quantity" value="1" min="1" max="10">
    <button type="submit">Add to Cart</button>
</form>

@endsection