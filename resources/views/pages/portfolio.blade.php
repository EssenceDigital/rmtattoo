@extends('./../site-layout')

@section('title', 'Portfolio | Rocky Mountain Tattoo')

@section('styles')
  <link rel="stylesheet" href="{{ url('_site-assets/css/plugins.css') }}">
  <link rel="stylesheet" href="{{ url('_site-assets/css/finaltilesgallery.css') }}">


@endsection

@section('menu-links')
    <li><a href="{{ url('/') }}" class="nav-link">Home</a></li>
    <li><a href="{{ url('/#about') }}" class="nav-link">About</a></li>
    <li><a href="{{ url('/#artists') }}" class="nav-link">Artists</a></li>
    <li><a href="{{ url('/portfolio') }}" class="nav-link">Portfolio</a></li>
    <li><a href="{{ url('/#faq') }}" class="nav-link">FAQ</a></li>
    <li><a href="{{ url('/precare-and-aftercare') }}" class="gold-text">Precare &amp; Aftercare</a></li>
    <li><a href="{{ url('/#bookings') }}" class="nav-link">Bookings</a></li>
@endsection

@section('content')
    <!-- mass-head start -->
    <div class="mass-head mass-head-pad text-center parallax mass-head-bg-3">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="mass-head-content">
                        <img class="img-responsive" src="{{ url('_site-assets/images/others/mass-head-logo.png') }}" alt="">
                        <h2 class="page-title">Portfolio</h2>
                    </div>
                </div> <!--/.col-->
            </div> <!--/.row-->
        </div>  <!--/.container-->

    </div>
    <!-- mass-head end -->

    <!-- about area start -->
    <div class="about-area bg-color-1 pad120">
      <div class="container">
        <div id="gallery1" class="final-tiles-gallery caption-middle caption-center effect-zoom-out effect-speed-fast caption-color-light">
          <div class="ftg-filters">
            <a class="selected" href="#ftg-set-ftgall">All</a>
            @foreach($artists as $artist)
              <a href="#ftg-set-filter-{{ $artist['id'] }}">{{ $artist['name'] }}</a>
            @endforeach
          </div>
          <div class="ftg-items">

            @foreach($portfolio as $img)
              <div class="tile ftg-set-filter-{{ $img['portfolio_artist_id'] }}">
                <a class="tile-inner" href="storage/{{ $img['src'] }}">
                  <img class="item" src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7" data-src="storage/{{ $img['src'] }}">
                </a>
              </div>
            @endforeach

          </div>
        </div>
      </div>


    </div>
    <!-- service area end -->
@endsection

@section('scripts')
  <script src="{{ url('_site-assets/js/plugins.js') }}"></script>
  <script src="{{ url('_site-assets/js/jquery.finaltilesgallery.js') }}"></script>
  <script src="{{ url('_site-assets/js/scripts.js') }}"></script>
  <script>
  	(function () {

  		$(".final-tiles-gallery").magnificPopup({
  			delegate: '.tile:not(.ftg-hidden-tile) .tile-inner',
  			type: 'image',
  			removalDelay: 300,
  			mainClass: 'mfp-fade mfp-with-zoom',
  			gallery: {
  			  enabled: true,
  			  preload: [0,2],
  			  navigateByImgClick: true,
  			  arrowMarkup: '<button title="%title%" type="button" class="mfp-arrow mfp-arrow-%dir%"></button>',
  			  tPrev: 'Previous (Left arrow key)',
  			  tNext: 'Next (Right arrow key)',
  			  tCounter: '<span class="mfp-counter">%curr% of %total%</span>'
  			},
  			zoom: {
  			    enabled: true,
  			    duration: 300,
  			    easing: 'ease-in-out',
  			    opener: function(openerElement) {
  			      return openerElement.is('img') ? openerElement : openerElement.find('img');
  			    }
  			  },
  			callbacks: {
  			    change: function() {
  			        if (this.isOpen) {
  			            this.wrap.addClass('mfp-open');
  			        }
  			    }
  			},
  	       fixedContentPos: false
  		});


          $(".final-tiles-gallery").finalTilesGallery({
              margin: 20,
              minTileWidth: 100,
              gridSize: 100,
              imageSizeFactor: [[4000, .6],[1024, .5],[800, .4],[600, .3],[480, .4]]
  		});
  	})();
  </script>
@endsection
