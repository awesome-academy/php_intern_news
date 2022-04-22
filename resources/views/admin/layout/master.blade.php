<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <link rel="icon" type="image/png" href="assets/img/favicon.ico">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

    <title>@yield('title')</title>

    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />

    @section('styles')
        @include('admin.layout.styles')
    @show
</head>

<body>
    <div class="wrapper">
        @include('admin.layout.sidebar')

        <div class="main-panel">
            @include('admin.layout.navbar')


            <div class="content">
                @yield('content')
            </div>


            @include('admin.layout.footer')

        </div>
    </div>
    @section('scripts')
        @include('admin.layout.scripts')
    @show
</body>

</html>
