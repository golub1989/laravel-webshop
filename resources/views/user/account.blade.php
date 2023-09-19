@extends('welcome')
@section('content')
<div class="container mx-auto">
    <div class="my-8 h-64 rounded-md overflow-hidden bg-cover bg-center">
        <div class="bg-gray-900 bg-opacity-50 flex items-center h-full">
            <div class="px-10 max-w-xl">
                @if(isset($user))
                    <h2 class="text-2xl text-black font-semibold">{{ $user->name }}</h2>
                    <p class="mt-2 text-black-400">{{ $user->email }}</p>
                @endif
                <button class="flex items-center mt-4 px-3 py-2 bg-blue-600 text-white text-sm uppercase font-medium rounded hover:bg-blue-500 focus:outline-none focus:bg-blue-500">
                    <a href="{{ url('account/update-password') }}">Change password</a>
                    <svg class="h-5 w-5 mx-2" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor"><path d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                </button>
                <button class="flex items-center mt-4 px-3 py-2 bg-blue-600 text-white text-sm uppercase font-medium rounded hover:bg-blue-500 focus:outline-none focus:bg-blue-500">
                    <a href="{{ route('orders') }}">Orders</a>                    
                    <svg class="h-5 w-5 mx-2" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor"><path d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                </button>
                <!-- <a href="{{ url('account/update-password') }}">Change password</a>
                <a href="{{ route('orders') }}">Orders</a> -->
</div>
        </div>

    </div>
</div>
@endsection