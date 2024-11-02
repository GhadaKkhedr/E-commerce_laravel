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
                @if(!Auth::guest() && Auth::user()->identity)
                <li class="nav-item">
                    <a class="nav-link text-info" href="/cart">Cart </a>
                </li>
                @endif
                @endguest

            </ul>
            <form class="d-flex form-inline" role="search">
                <input class="form-control me-2" type="search" name="searchBox" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-info" type="submit">Search</button>
            </form>
            <div class="d-flex ms-auto">
                @if (!Auth::guest())
                <h6>Welcome {{ Auth::user()->userName}}</h6>
                @endif
            </div>
        </div>
    </div>
</nav>