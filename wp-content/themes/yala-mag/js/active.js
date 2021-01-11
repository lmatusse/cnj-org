/*==================================
Template Name: Yala Mag 
Version: 1.0
====================================*/    
(function(jQuery) {
    "use strict";
     jQuery(document).on('ready', function() {	
		
		/*==============================
			Mobile Nav
		================================*/ 	
		jQuery('.menu').slicknav({
			prependTo:".mobile-nav",
			allowParentLinks: true,
			duration: 600,
			closeOnClick:true,
		});
	 	
	 	jQuery('.slicknav_menu li:last a').focusout(function(event){
     	 	jQuery('.menu').slicknav('close');
   		}); 
		/*===============================
			News SLider
		=================================*/ 
		jQuery(".news-slider .slider-active").owlCarousel({
			loop:true,
			autoplay:true,
			smartSpeed: 600,
			autoplayTimeout:3500,
			autoplayHoverPause:true,
			nav:true,
			navText: ['<i class="fa fa-angle-left" aria-hidden="true"></i>', '<i class="fa fa-angle-right" aria-hidden="true"></i>'],
			dots:false,
			items:1,
		});
		
		/*===============================
			Home Slider One
		=================================*/ 
		jQuery(".featured-slider").owlCarousel({
			loop:true,
			autoplay:true,
			smartSpeed: 600,
			autoplayTimeout:3500,
			autoplayHoverPause:true,
			nav:true,
			navText: ['<i class="fa fa-angle-left" aria-hidden="true"></i>', '<i class="fa fa-angle-right" aria-hidden="true"></i>'],
			dots:false,
			margin:30,
			responsive:{
				300: {
					items:1,
				},
				480: {
					items:1,
				},
				768: {
					items:2,
				},
				1170: {			
					items:3,
				},
			}
		});
		/*===============================
			Carousel Slider 
		=================================*/ 
		jQuery(".carousel-slider").owlCarousel({
			loop:true,
			autoplay:true,
			smartSpeed: 600,
			autoplayTimeout:3500,
			autoplayHoverPause:true,
			nav:true,
			navText: ['<i class="fa fa-angle-left" aria-hidden="true"></i>', '<i class="fa fa-angle-right" aria-hidden="true"></i>'],
			dots:false,
			margin:30,
			responsive:{
				300: {
					items:1,
				},
				480: {
					items:1,
				},
				768: {
					items:2,
				},
				1170: {			
					items:3,
				},
			}
		});
		
		/*=====================================
			Video Popup
		======================================*/ 
		jQuery('.video-popup').magnificPopup({
			type: 'iframe',
			removalDelay: 300,
			mainClass: 'mfp-fade'
		});
		
		/*====================================
			Scrool Up
		======================================*/ 	
		jQuery.scrollUp({
			scrollName: 'scrollUp',      // Element ID
			scrollDistance: 300,         // Distance from top/bottom before showing element (px)
			scrollFrom: 'top',           // 'top' or 'bottom'
			scrollSpeed: 1000,            // Speed back to top (ms)
			animationSpeed: 200,         // Animation speed (ms)
			scrollTrigger: false,        // Set a custom triggering element. Can be an HTML string or jQuery object
			scrollTarget: false,         // Set a custom target element for scrolling to. Can be element or number
			scrollText: ["<i class='fa fa-long-arrow-up'></i>"], // Text for element, can contain HTML
			scrollTitle: false,          // Set a custom <a> title if required.
			scrollImg: false,            // Set true to use image
			activeOverlay: false,        // Set CSS color to display scrollUp active point, e.g '#00FFFF'
			zIndex: 2147483647           // Z-Index for the overlay
		});
		
	});	
		/*====================================
			Extra JS
		======================================*/ 
		jQuery('.a').on("click", function (e) {
			var anchor = $(this);
				jQuery('html, body').stop().animate({
					scrollTop: $(anchor.attr('href')).offset().top - 70
				}, 1000);
			e.preventDefault();
		});
		
		/*====================================
			Preloader JS
		======================================*/		
		jQuery('.preloader').delay(2000).fadeOut('slow');
			setTimeout(function() {
			jQuery('body').removeClass('no-scroll');
		}, 2000);

		//remove .nav-link from top menu anchor
		jQuery('.top-nav li a').removeClass('nav-link'); 
		jQuery('.single-footer ul li a').removeClass('nav-link'); 
		jQuery('.single-footer.category ul li a').append('<i class="fa fa-caret-right"></i>'); 
		// Keyboard Navigation
		jQuery('.header-inner-menu').on('keydown', function (e) {
		    if ((e.which === 9 && !e.shiftKey)) {
		        // e.preventDefault();
		        jQuery('.header .main-menu .nav .dropdown li').css('opacity','1');
		        jQuery('.header .main-menu .nav .dropdown li').css('visibility','visible');
		    }	  
	    });

		jQuery(".header .main-menu .nav .dropdown li").hover(
		  function() {
		    jQuery('.header .main-menu .nav .dropdown li').css('opacity','');
	        jQuery('.header .main-menu .nav .dropdown li').css('visibility','');
		  }, function() {
		   jQuery('.header .main-menu .nav .dropdown li').css('opacity','');
	       jQuery('.header .main-menu .nav .dropdown li').css('visibility','');
		  }
		);
		
		 var width = jQuery(window).width();
		 
		if( width < 601 ){
	        jQuery('#wpadminbar').css('margin-top','-45px ! important');
	    }
	    jQuery(window).on('resize', function() {
         width = jQuery(this).width();
         if( width < 601 ){
            jQuery('#wpadminbar').css('margin-top','-45px ! important');
          }
	    });
})(jQuery);