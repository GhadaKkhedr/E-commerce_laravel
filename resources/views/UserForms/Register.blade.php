@extends("layouts.layout")

@section("pageTitle","Register")

@section("content")




<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form action="{{route('Register_route')}}" method="post">
                        @csrf
                        <div class="mb-3">
                            <label for="FName" class="form-label">Full Name : </label>
                            <input type="text" class="form-control @error('FName') is-invalid @enderror" name="FName" id="FName" placeholder="Please enter your full name" required>
                            @error('FName')
                            <div>{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="userName" class="form-label">User Name : </label>
                            <input type="text" class="form-control @error('userName') is-invalid @enderror" name="userName" id="userName" placeholder="Please enter your username" required>
                            @error('userName')
                            <div>{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="Email" class="form-label">Email address</label>
                            <input type="email" class="form-control @error('Email') is-invalid @enderror" name="Email" id="Email" aria-describedby="emailHelp" placeholder="Please enter your email" required>
                            <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                            @error('Email')
                            <div>{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="Password" class="form-label">Password</label>
                            <input type="password" class="form-control @error('Password') is-invalid @enderror" name="Password" id="Password" placeholder="please enter your password" required>
                            @error('Password')
                            <div>{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3 form-check">
                            <input type="radio" class="form-radio-select @error('identity') is-invalid @enderror" name="identity" id="select1" value="0" required>
                            <label class="form-radio-label" for="select1">Seller</label>
                            <input type="radio" class="form-radio-select" name="identity" id="select2" value="1">
                            <label class="form-radio-label" for="select2">Customer</label>
                            @error('identity')
                            <div>{{ $message }}</div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Add User</button>
                    </form>
                </div>
                @endsection
