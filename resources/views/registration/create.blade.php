@extends('welcome')
@section('content')
    <div id="heading">
        <h1 class="register">Registration</h1>
    </div>
    <form method="POST" action="/register">
    {{ csrf_field() }}
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" class="form-control" id="name" name="name">
        </div>

        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" class="form-control" id="email" name="email">
        </div>

        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" class="form-control" id="password" name="password">
        </div>

        <div class="form-group">
            <button style="cursor:pointer" type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>

    <div class="login-redirect">
         <p>Already have an account? Sign-in <span class="login-alert"><a href="{{ url('login') }}">here</a></span>
     </div>

@endsection
