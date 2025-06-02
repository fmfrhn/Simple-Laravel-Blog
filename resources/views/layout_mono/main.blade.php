<!DOCTYPE html>
<html lang="en">
@include('layout_mono.partials.head')

<body data-preloader="1">

    @include('layout_mono.header')
    @yield('container')
    @include('layout_mono.footer')
    @include('layout_mono.partials.js')

</body>

</html>
