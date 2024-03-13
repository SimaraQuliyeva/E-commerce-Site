<footer class="site-footer border-top">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 mb-5 mb-lg-6">
                <div class="row">
                    <div class="col-md-12">
                        <h3 class="footer-heading mb-4">Menu</h3>
                    </div>
                    <div class="col-md-6 col-lg-4">
                        <ul class="list-unstyled">
                            <li><a href="#">Home</a></li>
                            <li><a href="#">About</a></li>
                            <li><a href="#">Products</a></li>
                            <li><a href="#">Contact</a></li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-6">
                <div class="block-5 mb-5">
                    <h3 class="footer-heading mb-4">Contact Info</h3>
                    <ul class="list-unstyled">
                        @foreach($settings as $setting)
                        <li class="address">{{$setting->address}}</li>
                        <li class="phone"><a href="tel://{{str_replace(' ','',$setting->phone) }}">{{$setting->phone}}</a></li>
                        <li class="email">{{$setting->email}}</li>
                        @endforeach
                    </ul>
                </div>

            </div>
        </div>
        <div class="row pt-5 mt-5 text-center">
            <div class="col-md-12">
                <p>
                    &copy;{{date('Y')}} All rights reserved |  <i class="icon-heart" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank" class="text-primary">Simara Quliyeva</a>
                </p>
            </div>

        </div>
    </div>
</footer>
