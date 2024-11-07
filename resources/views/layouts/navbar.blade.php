<nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm m-5">
    <div class="container-fluid">
        <a class="navbar-brand" href="#"><img src="{{ asset('images/logo-ecommerce.jpg') }}" alt="shop with GHKM" width="70px" height="70px"></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse text-center" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item active">
                    <a class="nav-link  text-info active" href="/">Home<span class="sr-only"></span></a>
                </li>
                <!-- Authentication Links -->
                @guest
                @if (Route::has('login'))
                <li class="nav-item">
                    <a class="nav-link text-info" href="{{ route('login') }}">{{ __('Login') }}</a>
                </li>
                @endif
                @if (Route::has('register'))
                <li class="nav-item">
                    <a class="nav-link text-info" href="{{ route('Register_route') }}">{{ __('Register') }}</a>
                </li>
                @endif
                @else
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::user()->userName}}
                    </a>

                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </li>

                @endguest

            </ul>

            @if(!Auth::guest() && Auth::user()->identity !== 2)
            <form class="d-flex form-inline" role="search" method="get" action="{{route('search')}}">
                @csrf
                <input class="form-control me-2" type="search" name="keyword" id="keyword" placeholder="Search keyword" aria-label="Search">
                <button class="btn btn-outline-info" type="submit">Search</button>
            </form>
            @endif
            <div class="d-flex ms-auto">
                @if (!Auth::guest())
                <h6 style="margin-right:300px ;">Welcome {{ Auth::user()->userName}}</h6>
                @endif
            </div>
        </div>
    </div>
    @if(!Auth::guest() && Auth::user()->identity === 1)
        @if(isset($cart))
        @include('UserForms.cart',$cart)
        @else
        @include('UserForms.cart')
        @endif
    @endif
</nav>
