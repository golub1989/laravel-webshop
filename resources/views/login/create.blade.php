@extends('welcome')
@section('content')
<div id="heading">
        <h1 class="login">Sign-in</h1>
    </div>
<form method="POST" action="/login">
        {{ csrf_field() }}
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" class="form-control" id="email" name="email">
        </div>

        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" class="form-control" id="password" name="password">
        </div>

        <div class="form-group">
            <button style="cursor:pointer" type="submit" class="btn btn-primary">Login</button>
        </div>

        <div class="register-redirect">
            <p>You don't have an account? Register <span class="alert-register"><a href="{{ url('register') }}">here</a></span>
        </div>

    </form>
    @endsection