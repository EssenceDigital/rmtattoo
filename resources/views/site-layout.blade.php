<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">        
        <link href="https://fonts.googleapis.com/css?family=Cinzel" rel="stylesheet">
        <title>@yield('title')</title>

        <link rel="apple-touch-icon" sizes="57x57" href="{{ url('_site-assets/favicon/apple-icon-57x57.png') }}">
        <link rel="apple-touch-icon" sizes="60x60" href="{{ url('_site-assets/favicon/apple-icon-60x60.png') }}">
        <link rel="apple-touch-icon" sizes="72x72" href="{{ url('_site-assets/favicon/apple-icon-72x72.png') }}">
        <link rel="apple-touch-icon" sizes="76x76" href="{{ url('_site-assets/favicon/apple-icon-76x76.png') }}">
        <link rel="apple-touch-icon" sizes="114x114" href="{{ url('_site-assets/favicon/apple-icon-114x114.png') }}">
        <link rel="apple-touch-icon" sizes="120x120" href="{{ url('_site-assets/favicon/apple-icon-120x120.png') }}">
        <link rel="apple-touch-icon" sizes="144x144" href="{{ url('_site-assets/favicon/apple-icon-144x144.png') }}">
        <link rel="apple-touch-icon" sizes="152x152" href="{{ url('_site-assets/favicon/apple-icon-152x152.png') }}">
        <link rel="apple-touch-icon" sizes="180x180" href="{{ url('_site-assets/favicon/apple-icon-180x180.png') }}">
        <link rel="icon" type="image/png" sizes="192x192"  href="{{ url('_site-assets/favicon/android-icon-192x192.png') }}">
        <link rel="icon" type="image/png" sizes="32x32" href="{{ url('_site-assets/favicon/favicon-32x32.png') }}">
        <link rel="icon" type="image/png" sizes="96x96" href="{{ url('_site-assets/favicon/favicon-96x96.png') }}">
        <link rel="icon" type="image/png" sizes="16x16" href="{{ url('_site-assets/favicon/favicon-16x16.png') }}">
        <link rel="manifest" href="{{ url('_site-assets/favicon/manifest.json') }}">
        <meta name="msapplication-TileColor" content="#ffffff">
        <meta name="msapplication-TileImage" content="{{ url('_site-assets/favicon/ms-icon-144x144.png') }}">
        <meta name="theme-color" content="#ffffff">

        <!-- all stylesheets include start -->        
        <!-- bootstrap v3.3.7 css -->
        <link rel="stylesheet" href="{{ url('_site-assets/css/vendor/bootstrap.min.css') }}">
        <!-- Page specefic styles -->
        @yield('styles')
        <!-- fontawesome css -->
        <link rel="stylesheet" href="{{ url('_site-assets/css/vendor/font-awesome.min.css') }}">
        <!-- flaticon css -->
        <link rel="stylesheet" href="{{ url('_site-assets/fonts/flaticon/flaticon.css') }}">
        <!-- theme style css -->
        <link rel="stylesheet" href="{{ url('_site-assets/css/style.css') }}">
        <!-- responsive css -->
        <link rel="stylesheet" href="{{ url('_site-assets/css/responsive.css') }}">       
        <!-- all stylesheets include end -->
        <script>
          window.Laravel = <?php echo json_encode([
              'csrfToken' => csrf_token(),
          ]); ?>
        </script> 
    </head>
    <body>
        <!-- desktop header start -->
        <div class="header navbar-fixed-top">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <!-- bootstrap-navbar start -->
                        <nav class="navbar navbar-default">
                            <div class="container-fluid">
                                
                                <div class="navbar-header">
                                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                                        <span class="sr-only">Toggle navigation</span>
                                        <span class="icon-bar"></span>
                                        <span class="icon-bar"></span>
                                        <span class="icon-bar"></span>
                                    </button>
                                    <a class="navbar-brand" href="{{ url('/') }}">
                                        <img src="{{ url('_site-assets/images/others/logo-mono-white.png') }}" alt="">
                                    </a>
                                </div> <!--/.navbar-header-->

                                <!-- Collect the nav links, forms, and other content for toggling -->
                                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                                    <ul class="nav navbar-nav">
                                        @yield('menu-links')
                                    </ul>
                                    
                                </div><!-- /.navbar-collapse -->
                            </div> <!-- /.container-fluid -->
                        </nav>
                        <!-- bootstrap-navbar end -->

                    </div> <!--/.col-->
                    
                </div> <!--/.row-->
            </div> <!--/.container-->
        </div>
        <!-- desktop header end -->

        <!-- Page content -->
        @yield('content')

        <!-- footer start -->
        <div class="footer bg-color-2 pad80 text-center">
            <div class="container">
                <div class="row mb30">
                    <div class="col-md-12">
                        <div class="footer-logo">
                            <img src="{{ url('_site-assets/images/others/footer-logo.png') }}" alt="" class="img-center img-responsive">
                        </div>
                    </div>
                </div>
                <div class="row mb30">
                    <div class="col-md-5 col-sm-5">
                        <div class="footer-contact text-right">
                            <p>613 4th Ave South</p>
                        </div>
                    </div>
                    <div class="col-md-2 col-sm-2">
                        <div class="footer-icon">
                            <img src="{{ url('_site-assets/images/others/footer-machine.png') }}" alt="" class="img-center img-responsive">
                        </div>
                    </div>
                    <div class="col-md-5 col-sm-5">
                        <div class="footer-contact text-left">
                            <p>Lethbridge, Alberta</p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="footer-social">
                            <ul>
                                <li>
                                    <a href="https://www.facebook.com/rockymountaintattoocanada/" target="_blank">
                                        <i class="fa fa-facebook"></i>
                                    </a>
                                </li>
                                <li><a href="https://www.instagram.com/rockymountaintattoo/" target="_blank">
                                        <i class="fa fa-instagram"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="https://twitter.com/RockyMtnTattoo" target="_blank"><i class="fa fa-twitter"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="https://www.youtube.com/channel/UC9ULSC7xEP9P4mRBEZdOd5A?view_as=subscriber" target="_blank">
                                        <i class="fa fa-youtube"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="https://www.pinterest.ca/RockyMTattoo/?eq=rocky%20mountain&etslf=4790" target="_blank">
                                        <i class="fa fa-pinterest"></i>
                                    </a>
                                </li>                                
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- footer end -->

        <!-- all js include start -->
        <!-- jquery -->
        <script src="{{ url('_site-assets/js/vendor/jquery-3.1.1.min.js') }}"></script>
        <!-- bootstrap -->
        <script src="{{ url('_site-assets/js/vendor/bootstrap.min.js') }}"></script>
        <!-- Page specefic scripts -->
        @yield('scripts')
        <!--Appear js file-->
        <script src="{{ url('_site-assets/js/vendor/jquery.appear.js') }}"></script>      
    </body>
</html>
