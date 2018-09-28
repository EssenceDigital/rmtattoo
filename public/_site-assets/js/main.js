(function($) {
    "use strict";
    jQuery.noConflict();
    //when dom is ready
    $(document).ready(function(){

        // on scroll event start
        $(window).on('scroll', function() {
            if ($(window).scrollTop() > 55) {
                $('#back-to-top').addClass('reveal');
            } else {
                $('#back-to-top').removeClass('reveal');
            }
        });
        // on scroll event end

        $(".nav-link").click(function(e) {
            e.preventDefault();
            var $goTo = $($(this).attr('href'));
            $('html, body').animate({
                scrollTop: $goTo.offset().top - 62
            }, 1500);
        });

        $("#slider-link").click(function() {
            var $goTo = $('#bookings');
            $('html, body').animate({
                scrollTop: $goTo.offset().top - 62
            }, 1500);
        });

    	// revolution slider start
    	$("#rev_slider_1").show().revolution({
    		sliderType:"standard",
    		sliderLayout:"fullscreen",
    		dottedOverlay:"none",
    		delay:9000,
    		spinner: "spinner4",
    		navigation: {
    			keyboardNavigation:"off",
    			keyboard_direction: "horizontal",
    			mouseScrollNavigation:"off",
    			onHoverStop:"off",
    			touch:{
    				touchenabled:"on",
    				swipe_threshold: 75,
    				swipe_min_touches: 1,
    				swipe_direction: "horizontal",
    				drag_block_vertical: false
    			},
    			arrows: {
    				enable: false,
    				style: 'metis',
    				tmp: '',
    				rtl: false,
    				hide_onleave: true,
    				hide_onmobile: true,
    				hide_under: 0,
    				hide_over: 9999,
    				hide_delay: 200,
    				hide_delay_mobile: 1200,
    				left: {
    					container: 'slider',
    					h_align: 'left',
    					v_align: 'center',
    					h_offset: 20,
    					v_offset: 0
    				},
    				right: {
    					container: 'slider',
    					h_align: 'right',
    					v_align: 'center',
    					h_offset: 20,
    					v_offset: 0
    				}
    			},
    		},
    		responsiveLevels:[1240,1024,778,480],
    		gridwidth:[1240,1024,778,480],
    		gridheight:[868,768,960,720],
    		lazyType:"none",
    		shadow:0,
    		shuffle:"off",
    		autoHeight:"off",
    	});
    	// revolution slider end

        // Artists carousel start
        $(".owl-carousel").owlCarousel({
            margin:10,
            nav:true,
            dots: false,
            navText: [
                '<i class="fa fa-chevron-left"></i>', 
                '<i class="fa fa-chevron-right"></i>'
            ],
            responsive:{
                0:{
                    items:1,
                    stagePadding: 20
                },
                600:{
                    items:2,
                    stagePadding: 20
                },
                1000:{
                    items: 3
                }
            }
        });


        // dropdown menu on mouse hover start
        $(".dropdown").on('mouseenter',function() {
            $('.nav > .dropdown-menu', this).not('.in .dropdown-menu').stop(true, true).show("400");
            $(this).addClass('open');
        }).on('mouseleave', function() {
            $('.nav > .dropdown-menu', this).not('.in .dropdown-menu').stop(true, true).hide("400");
            $(this).removeClass('open');
        });
        // dropdown menu on mouse hover end

        // back to top start
        $('#back-to-top').on('click', function(){
            $("html, body").animate({scrollTop: 0}, 500);
            return false;
        });
        // back to top end

        $('#view-all-artists').on('click', function(){
            $('#hidden-artists').slideToggle("slow");
        });

        $('#view-more-portfolio').on('click', function(){
            var groupCount = $('.portfolio-group').length,
                $current = $('.active-portfolio'),
                $next = '';

            console.log($current.attr('data-index'));
            if($current.attr('data-index') == groupCount){
                $next = $('.portfolio-group').first();

            } else {
                $next = $current.next('.portfolio-group');
            }
            // Fade in next
            $current.fadeOut(0, function(){
                $current.removeClass('active-portfolio');
            });
            $next.fadeIn(0, function(){
                $next.addClass('active-portfolio');
            });
        });

        $('#view-all-faq').on('click', function(){
            $('.hidden-faq').slideToggle("slow");
        });

    });
    //dom ready end

})(jQuery);