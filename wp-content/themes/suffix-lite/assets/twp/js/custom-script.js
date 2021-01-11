(function (e) {
    "use strict";
    var n = window.TWP_JS || {};
    n.mobileMenu = {
        init: function () {
            this.toggleMenu();
            this.menuMobile();
            this.menuArrow();
        },
        toggleMenu: function () {
            e('#masthead').on('click', '.toggle-menu', function (event) {
                var ethis = e('.main-navigation .menu .menu-mobile');
                if (ethis.css('display') == 'block') {
                    ethis.slideUp('300');
                } else {
                    ethis.slideDown('300');
                }
                e('.ham').toggleClass('exit');
            });
            e('#masthead .main-navigation ').on('click', '.menu-mobile a i', function (event) {
                event.preventDefault();
                var ethis = e(this),
                    eparent = ethis.closest('li'),
                    esub_menu = eparent.find('> .sub-menu');
                if (esub_menu.css('display') == 'none') {
                    esub_menu.slideDown('300');
                    ethis.addClass('active');
                } else {
                    esub_menu.slideUp('300');
                    ethis.removeClass('active');
                }
                return false;
            });
        },
        menuMobile: function () {
            if (e('.main-navigation .menu > ul').length) {
                var ethis = e('.main-navigation .menu > ul'),
                    eparent = ethis.closest('.main-navigation'),
                    pointbreak = eparent.data('epointbreak'),
                    window_width = window.innerWidth;
                if (typeof pointbreak == 'undefined') {
                    pointbreak = 991;
                }
                if (pointbreak >= window_width) {
                    ethis.addClass('menu-mobile').removeClass('menu-desktop');
                    e('.main-navigation .toggle-menu').css('display', 'block');
                } else {
                    ethis.addClass('menu-desktop').removeClass('menu-mobile').css('display', '');
                    e('.main-navigation .toggle-menu').css('display', '');
                }
            }
        },
        menuArrow: function () {
            if (e('#masthead .main-navigation div.menu > ul').length) {
                e('#masthead .main-navigation div.menu > ul .sub-menu').parent('li').find('> a').append('<i class="fa fa-angle-down">');
            }
        }
    };
    n.TwpPreloader = function () {
        e(window).load(function () {
            e("body").addClass("page-loaded");
        });
    };
    n.TwpReveal = function () {
        e('.icon-search').on('click', function (event) {
            e('body').toggleClass('reveal-search');
            e('html').attr('style','overflow-y: scroll; position: fixed; width: 100%; left: 0px; top: 0px;');
            setTimeout(function(){ 

                e('a.close-popup').focus();

             }, 300);
            
        });
        e('.close-popup').on('click', function (event) {
            e('body').removeClass('reveal-search');
            e('html').attr('style','');
            setTimeout(function(){

                e('.icon-search').focus();

             }, 300);

        });

        e( '.skip-link-search-start' ).on( 'focus', function() {
            if ( e( 'body' ).hasClass( 'reveal-search' ) ) {

                e('a.close-popup').focus();
            }
        } );

        e( '.search-focus-active' ).on( 'focus', function() {
            if ( e( 'body' ).hasClass( 'reveal-search' ) ) {

                e('.popup-search .search-field').focus();
            }
        } );

        // Action On Esc Button
        e(document).keyup(function(j) {
            if (j.key === "Escape") { // escape key maps to keycode `27`

                if ( e( 'body' ).hasClass( 'reveal-search' ) ) {
                    e('body').removeClass('reveal-search');
                    e('html').attr('style','');
                    setTimeout(function(){

                        e('.icon-search').focus();

                     }, 300);
                }

            }
        });
    };
    n.TwpHeadroom = function () {
        e("#nav-affix").headroom({
            "tolerance": 0,
            "offset": 164,
            "classes": {
                "initial": "animated",
                "pinned": "slideDown",
                "unpinned": "slideUp",
                "top": "headroom--top",
                "notTop": "headroom--not-top"
            }
        });
    };
    n.TwpWidgetsNav = function () {
        if (e("body").hasClass("rtl")) {
            e('#widgets-nav').sidr({
                name: 'sidr-nav',
                side: 'right'
            });
        } else {
            e('#widgets-nav').sidr({
                name: 'sidr-nav',
                side: 'left'
            });
        }
        e('.sidr-class-sidr-button-close').click(function () {
            e.sidr('close', 'sidr-nav');
            e('html').attr('style','');
            setTimeout(function(){
                e('#widgets-nav').focus();
            },300);
        });

        e('#widgets-nav').click(function(){
            if ( e( 'body' ).hasClass( 'sidr-nav-open' ) ) {
                e('html').attr('style','');
            }else{
                e('html').attr('style','overflow-y: scroll; position: fixed; width: 100%; left: 0px; top: 0px;');
            }
            setTimeout(function(){
                e('a.sidr-class-sidr-button-close').focus();
            },300);
            
        });

        e( 'input, a, button' ).on( 'focus', function() {
            if ( e( 'body' ).hasClass( 'sidr-nav-open' ) ) {

                if( e(this).hasClass('skip-link-offcanvas-end') ){
                    e('.sidr-left a').focus();
                }

                if( e(this).hasClass('skip-link-offcanvas-start') ){
                    e('#sidr-nav .skip-link-offcanvas-end-1').focus();
                }

            }
        } );

        // Action On Esc Button
        e(document).keyup(function(j) {
            if (j.key === "Escape") { // escape key maps to keycode `27`
                e.sidr('close', 'sidr-nav');
                e('html').attr('style','');

                if ( e( 'body' ).hasClass( 'sidr-nav-open' ) ) {
                    setTimeout(function(){
                        e('#widgets-nav').focus();
                    },300);

                }

            }
        });
    };
    n.TwpDataBackground = function () {
        var pageSection = e(".data-bg");
        pageSection.each(function (indx) {
            if (e(this).attr("data-background")) {
                e(this).css("background-image", "url(" + e(this).data("background") + ")");
            }
        });
        e('.bg-image').each(function () {
            var src = e(this).children('img').attr('src');
            e(this).css('background-image', 'url(' + src + ')').children('img').hide();
        });
    };
    n.TwpMarquee = function () {
        e('.marquee').marquee({
            duration: 60000,
            gap: 0,
            delayBeforeStart: 0,
            duplicated: true,
            pauseOnHover: true,
            startVisible: true
        });
    };
    n.TwpSlickCarousel = function () {
        e(".mainbanner-jumbotron-1, .mainbanner-jumbotron-3, .mainbanner-jumbotron-4").slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            fade: true,
            autoplay: true,
            autoplaySpeed: 8000,
            infinite: true,
            nextArrow: '<i class="slide-icon slide-next fa fa-angle-right"></i>',
            prevArrow: '<i class="slide-icon slide-prev fa fa-angle-left"></i>',
            dots: true
        });
        e(".mainbanner-jumbotron-2").slick({
            slidesToShow: 3,
            slidesToScroll: 1,
            centerMode: true,
            centerPadding: '60px',
            autoplay: true,
            autoplaySpeed: 12000,
            infinite: true,
            nextArrow: '<i class="slide-icon slide-next fa fa-angle-right"></i>',
            prevArrow: '<i class="slide-icon slide-prev fa fa-angle-left"></i>',
            responsive: [
                {
                    breakpoint: 1024,
                    settings: {
                        slidesToShow: 2
                    }
                },
                {
                    breakpoint: 768,
                    settings: {
                        slidesToShow: 1
                    }
                }
            ]
        });
        e(".twp-slider-widget").each(function () {
            e(this).slick({
                slidesToShow: 1,
                slidesToScroll: 1,
                fade: true,
                autoplay: true,
                autoplaySpeed: 8000,
                infinite: true,
                dots: false,
                nextArrow: '<i class="slide-icon slide-next fa fa-angle-right"></i>',
                prevArrow: '<i class="slide-icon slide-prev fa fa-angle-left"></i>',
            });
        });
        e(".slider-nav").each(function () {
            e(this).slick({
                slidesToShow: 4,
                slidesToScroll: 1,
                dots: false,
                arrows: false,
                focusOnSelect: true,
                responsive: [
                    {
                        breakpoint: 991,
                        settings: {
                            slidesToShow: 3,
                            slidesToScroll: 3,
                            dots: true
                        }
                    }
                ]
            });
        });
        e(".aside-bar-disabled #primary.content-area.full-width .twp-carousal-widget, .footer-full-width .twp-carousal-widget").each(function () {
            e(this).slick({
                slidesToShow: 4,
                slidesToScroll: 4,
                focusOnSelect: true,
                dots: true,
                arrows: false,
                responsive: [
                    {
                        breakpoint: 1599,
                        settings: {
                            slidesToShow: 4,
                            slidesToScroll: 4
                        }
                    },
                    {
                        breakpoint: 992,
                        settings: {
                            slidesToShow: 2,
                            slidesToScroll: 2
                        }
                    },
                    {
                        breakpoint: 480,
                        settings: {
                            slidesToShow: 1,
                            slidesToScroll: 1
                        }
                    }
                ]
            });
        });
        e(".aside-bar-enabled .site-main .twp-carousal-widget, .aside-bar-disabled #primary.content-area.not-full-width .twp-carousal-widget").each(function () {
            e(this).slick({
                slidesToShow: 2,
                slidesToScroll: 1,
                focusOnSelect: true,
                dots: true,
                arrows: false
            });
        });
        e(".widget-area .twp-carousal-widget, .sidr .twp-carousal-widget, .footer-widget-area .twp-carousal-widget, .aside-bar .twp-carousal-widget").each(function () {
            e(this).slick({
                slidesToShow: 1,
                slidesToScroll: 1,
                focusOnSelect: true,
                dots: false,
                arrows: true,
                nextArrow: '<i class="slide-icon slide-next fa fa-angle-right"></i>',
                prevArrow: '<i class="slide-icon slide-prev fa fa-angle-left"></i>'
            });
        });
        e(".gallery-columns-1, ul.wp-block-gallery.columns-1, .wp-block-gallery.columns-1 .blocks-gallery-grid").each(function () {
            e(this).slick({
                slidesToShow: 1,
                slidesToScroll: 1,
                fade: true,
                autoplay: true,
                autoplaySpeed: 8000,
                infinite: true,
                nextArrow: '<i class="slide-icon slide-next fa fa-angle-right"></i>',
                prevArrow: '<i class="slide-icon slide-prev fa fa-angle-left"></i>',
                dots: true
            });
        });
        e(".site-content .content-area.full-width .site-main .insta-slider, .footer-full-width .insta-slider").each(function () {
            e(this).slick({
                nextArrow: '<i class="slide-icon slide-next fa fa-angle-right"></i>',
                prevArrow: '<i class="slide-icon slide-prev fa fa-angle-left"></i>',
                slidesToShow: 7,
                slidesToScroll: 1,
                autoplay: true,
                autoplaySpeed: 800,
                easing: "linear",
                responsive: [
                    {
                        breakpoint: 1400,
                        settings: {
                            slidesToShow: 5,
                        }
                    },
                    {
                        breakpoint: 991,
                        settings: {
                            slidesToShow: 4,
                        }
                    },
                    {
                        breakpoint: 768,
                        settings: {
                            slidesToShow: 3,
                        }
                    },
                    {
                        breakpoint: 480,
                        settings: {
                            slidesToShow: 1,
                        }
                    }
                ]
            });
        });
        e(".site-content .content-area.not-full-width .site-main .insta-slider").each(function () {
            e(this).slick({
                nextArrow: '<i class="slide-icon slide-next fa fa-angle-right"></i>',
                prevArrow: '<i class="slide-icon slide-prev fa fa-angle-left"></i>',
                slidesToShow: 4,
                slidesToScroll: 1,
                autoplay: true,
                autoplaySpeed: 800,
                easing: "linear",
                responsive: [
                    {
                        breakpoint: 991,
                        settings: {
                            slidesToShow: 4,
                        }
                    },
                    {
                        breakpoint: 768,
                        settings: {
                            slidesToShow: 3,
                        }
                    },
                    {
                        breakpoint: 480,
                        settings: {
                            slidesToShow: 1,
                        }
                    }
                ]
            });
        });
        e("#secondary .insta-slider, .footer-widget-area .insta-slider, .widget-area .insta-slider").each(function () {
            e(this).slick({
                slidesToShow: 1,
                slidesToScroll: 1,
                fade: true,
                autoplay: true,
                autoplaySpeed: 8000,
                infinite: true,
                nextArrow: '<i class="slide-icon slide-next fa fa-angle-right"></i>',
                prevArrow: '<i class="slide-icon slide-prev fa fa-angle-left"></i>',
                dots: false
            });
        });
    };
    n.MagnificPopup = function () {
        e('div.zoom-gallery').magnificPopup({
            delegate: 'a',
            type: 'image',
            closeOnContentClick: false,
            closeBtnInside: false,
            mainClass: 'mfp-with-zoom mfp-img-mobile',
            image: {
                verticalFit: true,
                titleSrc: function (item) {
                    return item.el.attr('title');
                }
            },
            gallery: {
                enabled: true
            },
            zoom: {
                enabled: true,
                duration: 300,
                opener: function (element) {
                    return element.find('img');
                }
            }
        });
        e('.gallery, .wp-block-gallery').each(function () {
            e(this).magnificPopup({
                delegate: 'a',
                type: 'image',
                gallery: {
                    enabled: true
                },
                zoom: {
                    enabled: true,
                    duration: 300,
                    opener: function (element) {
                        return element.find('img');
                    }
                }
            });
        });
    };
    n.TwpTabbed = function () {
        e('ul.tabs li').click(function () {
            var tab_id = e(this).attr('data-tab');
            e('ul.tabs li').removeClass('current');
            e('.tab-content').removeClass('current');
            e(this).addClass('current');
            e("#" + tab_id).addClass('current');
        });
    };
    n.TwpStickySidebar = function () {
        e('.widget-area').theiaStickySidebar({
            additionalMarginTop: 30
        });
    };
    n.show_hide_scroll_top = function () {
        if (e(window).scrollTop() > e(window).height() / 2) {
            e("#scroll-up").fadeIn(300);
        } else {
            e("#scroll-up").fadeOut(300);
        }
    };
    n.scroll_up = function () {
        e("#scroll-up").on("click", function () {
            e("html, body").animate({
                scrollTop: 0
            }, 800);
            return false;
        });
    };
    e(document).ready(function () {
        n.mobileMenu.init();
        n.TwpPreloader();
        n.TwpReveal();
        n.TwpHeadroom();
        n.TwpWidgetsNav();
        n.TwpDataBackground();
        n.TwpMarquee();
        n.TwpSlickCarousel();
        n.MagnificPopup();
        n.TwpTabbed();
        n.TwpStickySidebar();
        n.scroll_up();
    });
    e(window).scroll(function () {
        n.show_hide_scroll_top();
    });
    e(window).resize(function () {
        n.mobileMenu.menuMobile();
    });
})(jQuery);