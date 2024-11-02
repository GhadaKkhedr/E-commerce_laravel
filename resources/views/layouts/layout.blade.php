<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@include("layouts.header")

@include("layouts.navbar")

@include("layouts.AlertMessages")

<body>
    <div class="container">
        @yield('content')
    </div>
</body>

@include("layouts.footer")

</html>
