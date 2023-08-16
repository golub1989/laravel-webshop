@foreach($products as $product)
    {{$product->name}}
    {{$product->description}}
    {{$product->price}}
    {{$product->image}}

    <!-- <a href="{{ url('product/{id}') }}">View</a> -->
    <a href="{{ url('product' , [ 'id' => $product->id ]) }}">View</a>

@endforeach