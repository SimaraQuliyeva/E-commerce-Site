<!DOCTYPE html>
<html lang="en">
@include('front.partials.top')
<body>

<div class="site-wrap">
    @include('front.partials.header')

    @yield('content')

    @include('front.partials.footer')
</div>

<script src='{{asset ("front/js/jquery-3.3.1.min.js") }}'></script>
<script src='{{asset ("front/js/jquery-ui.js") }}'></script>
<script src='{{asset ("front/js/popper.min.js") }}'></script>
<script src='{{asset ("front/js/bootstrap.min.js") }}'></script>
<script src='{{asset ("front/js/owl.carousel.min.js") }}'></script>
<script src='{{asset ("front/js/jquery.magnific-popup.min.js") }}'></script>
<script src='{{asset ("front/js/aos.js") }}'></script>

<script src='{{asset ("front/js/main.js") }}'></script>

</body>
</html>
