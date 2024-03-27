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
@yield('customJs')
<script src='{{asset ("front/js/main.js") }}'></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        setTimeout(function() {
            var successDiv = document.getElementById('success-div');
            if (successDiv) {
                successDiv.style.display = 'none';
            }

            var errorDiv = document.getElementById('error-div');
            if (errorDiv) {
                errorDiv.style.display = 'none';
            }
        }, 5000);
    });
</script>

</body>
</html>
