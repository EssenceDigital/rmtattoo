@extends('site-layout')

@section('title', 'Rocky Mountain Tattoo | Lethbridge, Alberta | Professional Tattoo &amp; Piercing Studio')

@section('styles')
    <!-- revolution slider css -->
    <link rel="stylesheet" href="{{ url('_site-assets/css/vendor/rev_slider/settings.css') }}">
    <link rel="stylesheet" href="{{ url('_site-assets/css/vendor/rev_slider/navigation.css') }}">
    <!-- magnific popup css -->
    <link rel="stylesheet" href="{{ url('_site-assets/css/vendor/magnific-popup.css') }}">
    <!-- OwlCarousel css -->
    <link rel="stylesheet" href="{{ url('_site-assets/css/vendor/owl.carousel.css') }}">
    <link rel="stylesheet" href="{{ url('_site-assets/css/vendor/owl.theme.css') }}">
@endsection

@section('menu-links')
    <li><a href="#about" class="nav-link">About</a></li>
    <li><a href="#artists" class="nav-link">Artists</a></li>
    <li><a href="{{ url('/portfolio') }}">Portfolio</a></li>
    <li><a href="#faq" class="nav-link">FAQ</a></li>
    <li><a href="{{ url('/precare-and-aftercare') }}" class="gold-text">Precare &amp; Aftercare</a></li>
    <li><a href="#bookings" class="nav-link">Bookings</a></li>
@endsection

@section('content')
    <!-- slideshow area start -->
    <div id="rev_slider_1_wrapper" class="rev_slider_wrapper fullscreen-container" data-alias="photography1" style="background-color:transparent;padding:0px;">
        <div id="rev_slider_1" class="rev_slider fullscreenbanner" style="display:none;" data-version="5.0.7">
            <ul>
                <!-- SLIDE  -->
                <li data-index="rs-1" data-transition="slideoververtical">
                    <!-- MAIN IMAGE -->
                    <img src="{{ url('_site-assets/images/slider/slide-1.jpg') }}"  alt=""  data-bgposition="center center" data-bgfit="cover" data-bgrepeat="no-repeat" class="rev-slidebg" data-no-retina>

                    <!-- LAYERS -->

                    <!-- LAYER NR. 1 -->
                    <div class="tp-caption Photography-Subline tp-resizeme" id="slide-1-layer-1"
                        data-x="['left','left','center','center']" data-hoffset="['50','50','0','0']"
                        data-y="['middle','middle','middle','middle']" data-voffset="['-157','-157','-157','-80']"
                        data-fontsize="['20','20','20','17']"
                        data-lineheight="['30','30','30','26']"
                        data-width="none"
                        data-height="none"
                        data-whitespace="nowrap"
                        data-transform_idle="o:1;"

                        data-transform_in="y:[100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;opacity:0;s:2000;e:Power4.easeInOut;"
                        data-transform_out="y:[100%];s:1000;e:Power2.easeInOut;s:1000;e:Power2.easeInOut;"
                        data-mask_in="x:0px;y:[100%];s:inherit;e:inherit;"
                        data-mask_out="x:inherit;y:inherit;s:inherit;e:inherit;"
                        data-start="500"
                        data-splitin="none"
                        data-splitout="none"
                        data-responsive_offset="on"

                        style="z-index: 5; white-space: nowrap; font-family: 'Open Sans', sans-serif;">
                        A PREMIER TATTOO & PIERCING STUDIO IN LETHBRIDGE, ALBERTA
                    </div>

                    <!-- LAYER NR. 2 -->
                    <div class="tp-caption Photography-Display tp-resizeme" id="slide-1-layer-2"
                        data-x="['left','left','center','center']" data-hoffset="['50','50','0','0']"
                        data-y="['middle','middle','middle','middle']" data-voffset="['-40','-40','-40','-20']"
                        data-fontsize="['60','60','60','30']"
                        data-lineheight="['60','60','60','40']"
                        data-width="none"
                        data-height="none"
                        data-whitespace="nowrap"
                        data-transform_idle="o:1;"

                        data-transform_in="y:[100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;opacity:0;s:2000;e:Power4.easeInOut;"
                        data-transform_out="y:[100%];s:1000;e:Power2.easeInOut;s:1000;e:Power2.easeInOut;"
                        data-mask_in="x:0px;y:[100%];s:inherit;e:inherit;"
                        data-mask_out="x:inherit;y:inherit;s:inherit;e:inherit;"
                        data-start="750"
                        data-splitin="none"
                        data-splitout="none"
                        data-responsive_offset="on"

                        style="z-index: 6; white-space: nowrap; font-family: Cinzel;">THE ONE AND ONLY
                    </div>

                    <!-- LAYER NR. 3 -->
                    <div class="tp-caption Photography-Display tp-resizeme" id="slide-1-layer-3"
                        data-x="['left','left','center','center']" data-hoffset="['50','50','0','0']"
                        data-y="['middle','middle','middle','middle']" data-voffset="['40','40','40','20']"
                        data-fontsize="['60','60','60','30']"
                        data-lineheight="['60','60','60','40']"
                        data-width="none"
                        data-height="none"
                        data-whitespace="nowrap"
                        data-transform_idle="o:1;"

                        data-transform_in="y:[100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;opacity:0;s:2000;e:Power4.easeInOut;"
                        data-transform_out="y:[100%];s:1000;e:Power2.easeInOut;s:1000;e:Power2.easeInOut;"
                        data-mask_in="x:0px;y:[100%];s:inherit;e:inherit;"
                        data-mask_out="x:inherit;y:inherit;s:inherit;e:inherit;"
                        data-start="1000"
                        data-splitin="none"
                        data-splitout="none"
                        data-responsive_offset="on"

                        style="z-index: 7; white-space: nowrap; color: #bc9355; font-family: Cinzel;">ROCKY MOUNTAIN TATTOO
                    </div>

                    <!-- LAYER NR. 4 -->
                    <div id="slider-link"
                        class="tp-caption rev-btn rev-bordered" id="slide-1-layer-4"
                        data-x="['left','left','center','center']" data-hoffset="['50','50','0','0']"
                        data-y="['middle','middle','bottom','bottom']" data-voffset="['181','181','270','200']"
                        data-width="none"
                        data-height="none"
                        data-whitespace="nowrap"
                        data-transform_idle="o:1;"
                        data-transform_hover="o:1;rX:0;rY:0;rZ:0;z:0;s:300;e:Power3.easeOut;"
                        data-style_hover="c:rgba(255, 255, 255, 1.00);bc:rgba(255, 255, 255, 1.00);"

                        data-transform_in="y:[100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;opacity:0;s:2000;e:Power4.easeInOut;"
                        data-transform_out="y:[175%];s:1000;e:Power2.easeInOut;s:1000;e:Power2.easeInOut;"
                        data-mask_in="x:0px;y:[100%];s:inherit;e:inherit;"
                        data-mask_out="x:inherit;y:inherit;"
                        data-start="1250"
                        data-splitin="none"
                        data-splitout="none"
                        data-actions='[{"event":"click","action":"jumptoslide","slide":"rs-164","delay":""}]'
                        data-responsive_offset="on"
                        data-responsive="off"

                        style="z-index: 8; white-space: nowrap; font-size: 14px; line-height: 15px; color: rgba(255, 255, 255, 1.00);font-family:Open Sans;background-color:rgba(0, 0, 0, 0);padding:13px 35px 13px 35px;border-color:rgba(255, 255, 255, 0.25);border-style:solid;border-width:2px;letter-spacing:1px;text-transform: uppercase;">Start a booking
                    </div>
                </li>
            </ul>
        </div>
    </div> <!--#rev_slider_1_wrapper-->
    <!-- slideshow area end -->

    <!-- service area start -->
    <div class="about-area bg-color-1 pad120" id="about">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="section-title text-center">
                        <img src="{{ url('_site-assets/images/title-img/title-img-1.png') }}" class="title-img mb15" alt="">
                        <h3 class="title">About <strong>RMT</strong></h3>
                        <p class="sub-title">Delivering high quality work to Lethbridge, Alberta</p>
                    </div>
                </div> <!-- /.col -->
            </div> <!-- /.row -->
        </div> <!--/.container-->
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <p>A brand new, premier studio offering professional tattooing, piercing, laser removal and microblading. It is both our mission and duty
                      to provide only the highest quality services in accordance with the most relevant, evidence-based health practice standards made available
                      by our governing health authority.</p>
                      <p>We also host an array of live music events and productions. For up-to-date event information, make sure that
                      you follow our Facebook page and have notifications turned on.</p>
                </div> <!-- /.col -->
            </div> <!-- /.row -->
            <div class="row mt20">
                <div class="col-md-6">
                    <img class="img-responsive xs-mb30" src="{{ url('_site-assets/images/about/about-1.jpg') }}" alt="">
                </div> <!-- /.col -->
                <div class="col-md-6">
                    <img class="img-responsive xs-mb30" src="{{ url('_site-assets/images/about/about-2.jpg') }}" alt="">
                </div> <!-- /.col -->
            </div>

        </div> <!--/.container-->
    </div>
    <!-- service area end -->



    <!-- gallery area start -->
    <div class="hair-style pad120 parallax bg-3" id="portfolio">
        <div class="container">

            <div class="row">
               <div class="col-md-4">
                    <div class="section-title-left">
                        <h3 class="title">Talented and dedicated artists for all styles</h3>
                        <p>
                          Our artists love to push their craft to the limit. Make your choice wisely.
                    </div>
                </div> <!-- /.col -->

                <div class="col-md-8">
                    <div class="owl-carousel owl-theme">
                        @foreach($portfolio as $img)
                            <div class="slide-item">

                                <a class="gallery-item" href="storage/{{ $img['src'] }}">
                                    <img src="storage/{{ $img['src'] }}" class="img-responsive" alt="">
                                </a>

                            </div>
                        @endforeach
                    </div>
                </div> <!-- /.col -->

            </div> <!-- /.row -->

            <div class="row booking-form mt65">
                <a href="{{ url('/portfolio') }}" class="btn btn-primary hvr-in" id="view-more-portfolio">View all</a>
            </div>

        </div> <!--/.container-->
    </div>
    <!-- gallery end -->


    <div class="facility-area bg-color-3 pad120" id="faq">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="section-title text-center">
                        <img src="{{ url('_site-assets/images/title-img/title-img-3.png') }}" class="title-img mb15" alt="">
                        <h3 class="title">The <strong>FAQ</strong></h3>
                        <p class="sub-title">You've got questions, we've got you covered.</p>
                    </div>
                </div> <!-- /.col -->
            </div> <!-- /.row -->
        </div> <!--/.container-->
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <!-- accordion start -->
                    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">

                        @foreach($faqs as $faq)
                            @break($loop->iteration == 11)
                            <div class="panel panel-default">
                                <div class="panel-heading" role="tab" id="heading{{ $loop->iteration }}">
                                    <h4 class="panel-title">
                                        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse{{ $loop->iteration }}" aria-expanded="false" aria-controls="collapse{{ $loop->iteration }}" class="collapsed">
                                        {{ $faq->question }}
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapse{{ $loop->iteration }}" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading{{ $loop->iteration }}" aria-expanded="false" style="height: 0px;">
                                    <div class="panel-body" style="white-space: pre-line;">
                                        {{ $faq->answer }}
                                    </div>
                                </div>
                            </div>
                        @endforeach

                        @foreach($faqs as $faq)
                            @continue($loop->iteration < 11)
                            <div class="panel panel-default hidden-faq" style="display:none;">
                                <div class="panel-heading" role="tab" id="heading{{ $loop->iteration }}">
                                    <h4 class="panel-title">
                                        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse{{ $loop->iteration }}" aria-expanded="false" aria-controls="collapse{{ $loop->iteration }}" class="collapsed">
                                        {{ $faq->question }}
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapse{{ $loop->iteration }}" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading{{ $loop->iteration }}" aria-expanded="false" style="height: 0px;">
                                    <div class="panel-body" style="white-space: pre-line;">
                                        {{ $faq->answer }}
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div>
                    <!-- accordion end -->
                </div>
            </div> <!-- /.row -->

            <div class="row booking-form mt65">
                <button class="btn btn-primary hvr-in" id="view-all-faq">View all</button>
            </div>
        </div> <!--/.container-->
    </div>

    <!-- call to action start -->
    <div class="call-to-action pad80 bg-5">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="c2a bg-drk-trns white-text" style="padding-right:80px;">
                        <div class="row">
                            <div class="col-md-12 pad80">
                                <h3>Precare and aftercare</h3>
                                <p>If you want high quality tattoo that heals fast and looks good, don't overlook these two import areas. Luckily,
                                  we have created a detailed guide to help you along the way.</p>
                                <a href="{{ url('/precare-and-aftercare') }}" target="_blank" class="btn btn-primary hvr-in">Take me there</a>
                            </div> <!-- /.col -->
                        </div> <!-- /.row -->
                    </div>
                </div> <!-- /.col -->
            </div> <!-- /.row -->
        </div> <!--/.container-->
    </div>
    <!-- call to action end -->

    <!-- booking area start -->
    <div class="booking-area bg-color-1 pad150" id="bookings">
        <div class="container">
            <div class="col-md-12">
               <div id="bookings-form">
                    <bookings-widget :captcha="'{{ session('antibotquestion') }}'"></bookings-widget>
                </div>
            </div>


        </div> <!--/.container-->
    </div>
    <!-- booking area end -->
@endsection

@section('scripts')
    <!-- revolution slider js files start -->
    <script src="{{ url('_site-assets/js/vendor/rev_slider/jquery.themepunch.tools.min.js') }}"></script>
    <script src="{{ url('_site-assets/js/vendor/rev_slider/jquery.themepunch.revolution.min.js') }}"></script>

    <script src="{{ url('_site-assets/js/vendor/rev_slider/extensions/revolution.extension.actions.min.js') }}"></script>
    <script src="{{ url('_site-assets/js/vendor/rev_slider/extensions/revolution.extension.carousel.min.js') }}"></script>
    <script src="{{ url('_site-assets/js/vendor/rev_slider/extensions/revolution.extension.kenburn.min.js') }}"></script>
    <script src="{{ url('_site-assets/js/vendor/rev_slider/extensions/revolution.extension.layeranimation.min.js') }}"></script>
    <script src="{{ url('_site-assets/js/vendor/rev_slider/extensions/revolution.extension.migration.min.js') }}"></script>
    <script src="{{ url('_site-assets/js/vendor/rev_slider/extensions/revolution.extension.navigation.min.js') }}"></script>
    <script src="{{ url('_site-assets/js/vendor/rev_slider/extensions/revolution.extension.parallax.min.js') }}"></script>
    <script src="{{ url('_site-assets/js/vendor/rev_slider/extensions/revolution.extension.slideanims.min.js') }}"></script>
    <script src="{{ url('_site-assets/js/vendor/rev_slider/extensions/revolution.extension.video.min.js') }}"></script>
    <!-- revolution slider js files end -->

    <!--Mgnific popup js file-->
    <script src="{{ url('_site-assets/js/vendor/jquery.magnific-popup.min.js') }}"></script>
    <!--Owl Carousel js file-->
    <script src="{{ url('_site-assets/js/vendor/owl.carousel.min.js') }}"></script>



    <script src="{{ url('/js/site.js') }}"></script>
    <script src="{{ url('_site-assets/js/gallery.js') }}"></script>
    <script src="{{ url('_site-assets/js/main.js') }}"></script>
@endsection
