@extends("layouts.layout")

@section("pageTitle","Login")

@section("content")
<div class="container">
    <form action="{{route('login_route')}}" method="post">
        @csrf
        <div class="mb-3">
            <label for="Email" class="form-label">Email: </label>
            <input type="Email" class="form-control" id="Email" placeholder="Please enter your email" required>
        </div>
        <div class="mb-3">
            <label for="Password" class="form-label">Password</label>
            <input type="password" class="form-control" id="Password" placeholder="please enter your password" required>
        </div>
        <button type="submit" class="btn btn-primary">Login</button>
    </form>

</div>
@endsection
