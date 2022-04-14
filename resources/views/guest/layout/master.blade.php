<!DOCTYPE html>
<html lang="en">

<head>
    @section('metatags')
        @include('guest.layout.metatags')
    @show
    <title>@yield('page-title')</title>
    @section('styles')
        @include('guest.layout.styles')
    @show
</head>

<body>
    @include('guest.layout.header')
    @yield('content')
    @include('guest.layout.footer')
    @section('scripts')
        @include('guest.layout.scripts')
    @show
</body>

</html>
