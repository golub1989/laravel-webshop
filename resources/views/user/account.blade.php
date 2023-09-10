@extends('welcome')
@section('content')

    @if(isset($user))
        {{ $user->name }}
        {{ $user->email }}
    @endif
    <a href="{{ url('account/update-password') }}">Change password</a>
    <a href="{{ route('orders') }}">Orders</a>

@endsection