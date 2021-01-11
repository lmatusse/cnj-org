<?php
/**
 * CSS related hooks.
 *
 * This file contains hook functions which are related to CSS.
 *
 * @package suffix
 */

if (!function_exists('suffix_lite_trigger_custom_css_action')) :

    /**
     * Do action theme custom CSS.
     *
     * @since 1.0.0
     */
    function suffix_lite_trigger_custom_css_action()
    {
        global $suffix_lite_google_fonts;

        $suffix_lite_enable_banner_overlay = suffix_lite_get_option('enable_overlay_option');
        $suffix_lite_site_title_color = suffix_lite_get_option('site_title_color');
        $suffix_lite_text_size_site_title = suffix_lite_get_option('text_size_site_title');
        $suffix_lite_primary_color = suffix_lite_get_option('primary_color');
        $suffix_lite_slider_article_title_color = suffix_lite_get_option('slider_article_title_color');
        $suffix_lite_article_background_color = suffix_lite_get_option('slider_article_background_color');
        $suffix_lite_featured_article_title_color = suffix_lite_get_option('featured_article_title_color');
        $suffix_lite_article_title_color_widget = suffix_lite_get_option('article_title_color_widget');
        $suffix_lite_top_bar_background_color = suffix_lite_get_option('top_bar_background_color');
        $suffix_lite_top_bar_text_color = suffix_lite_get_option('top_bar_text_color');
        $suffix_lite_ticker_background_color = suffix_lite_get_option('ticker_background_color');
        $suffix_lite_footer_widget_bg_color = suffix_lite_get_option('footer_widget_bg_color');
        $suffix_lite_footer_widget_text_color = suffix_lite_get_option('footer_widget_text_color');
        $suffix_lite_footer_copyright_bg_color = suffix_lite_get_option('footer_copyright_bg_color');
        $suffix_lite_footer_copyright_text_color = suffix_lite_get_option('footer_copyright_text_color');

        $suffix_lite_primary_font = $suffix_lite_google_fonts[suffix_lite_get_option('primary_font')];
        $suffix_lite_secondary_font = $suffix_lite_google_fonts[suffix_lite_get_option('secondary_font')];
        ?>
        <style type="text/css">
            <?php
            if ( $suffix_lite_enable_banner_overlay == 1 ){ ?>
            .inner-header-overlay {
                background: #282828;
                filter: alpha(opacity=65);
                opacity: 0.65;
            }

            <?php } ?>

            <?php
            if (!empty($suffix_lite_site_title_color) ){ ?>
            .site .upper-header .site-branding .site-title a,
            .site .upper-header .site-branding .site-description{
                color: <?php echo esc_html($suffix_lite_site_title_color); ?>;
            }
            <?php } ?>


            <?php
            if (!empty($suffix_lite_text_size_site_title) ){ ?>
            .site .upper-header .site-branding .site-title{
                font-size: <?php echo esc_html($suffix_lite_text_size_site_title); ?>px;
            }
            <?php } ?>


            <?php
           if (!empty($suffix_lite_primary_color) ){ ?>
            body .site .primary-bgcolor,
            body .site button,
            body .site input[type="button"],
            body .site input[type="reset"],
            body .site input[type="submit"],
            body .site .insta-button a,
            body .site .menu-description,
            body .site .widget.suffix_lite_widget_tabbed ul.tabs li.current,
            body .site .widget.suffix_lite_widget_tabbed ul.tabs li:hover,
            body .site .widget.suffix_lite_widget_tabbed ul.tabs li:focus,
            body .site .widget.suffix_lite_widget_tabbed .site-footer .widget ul li,
            body .site .mainbanner-jumbotron-2 .slide-icon,
            body .site .twp-meta-categories-bg a,
            body .site .twp-slider-widget .twp-meta-categories a{
                background-color: <?php echo esc_html($suffix_lite_primary_color); ?> !important;
            }

            body .site .author-info .author-social > a:hover,
            body .site .author-info .author-social > a:focus {
                border-color: <?php echo esc_html($suffix_lite_primary_color); ?> !important;
            }

            body .site .sticky .entry-title:before,
            body .site .post.format-video .entry-title:before,
            body .site .post.format-image .entry-title:before,
            body .site .post.format-gallery .entry-title:before,
            body .site .post.format-audio .entry-title:before,
            body .site a:hover,
            body .site a:focus,
            body .site a:active,
            body .site .breaking-title,
            body .site .twp-meta-categories-color a,
            body .site .author-info .author-social > a:hover,
            body .site .author-info .author-social > a:focus,
            body .site .social-icons ul li a:hover,
            body .site .social-icons ul li a:focus,
            body .site .nav-right .icon-search:hover,
            body .site .nav-right .icon-search:focus {
                color: <?php echo esc_html($suffix_lite_primary_color); ?> !important;
            }

            @media only screen and (min-width: 992px) {
                body .site .main-navigation .menu ul > li.current-menu-item > a,
                body .site .main-navigation .menu ul > li:hover > a,
                body .site .main-navigation .menu ul > li:focus > a {
                    color: <?php echo esc_html($suffix_lite_primary_color); ?> !important;
                }
            }

            <?php } ?>


            <?php
            if (!empty($suffix_lite_primary_font) ){ ?>
                body,
                body .site button,
                body .site input,
                body .site select,
                body .site textarea {
                    font-family: <?php echo esc_html($suffix_lite_primary_font); ?> !important;
                }
            <?php } ?>

            <?php
           if (!empty($suffix_lite_secondary_font) ){ ?>
            body .site h1,
            body .site h2,
            body .site h3,
            body .site h4,
            body .site h5,
            body .site h6,
            body .site blockquote,
            body .site q {
                font-family: <?php echo esc_html($suffix_lite_secondary_font); ?> !important;
            }
            <?php } ?>


            <?php
            if (!empty($suffix_lite_slider_article_title_color) ){ ?>
                .main-banner .mainbanner-jumbotron .slide-title a,
                .main-banner .mainbanner-jumbotron .slider-figcaption .post-meta,
                .main-banner .mainbanner-jumbotron .slider-figcaption .slide-details{
                    color: <?php echo esc_html($suffix_lite_slider_article_title_color); ?>;
                }
            <?php } ?>

            <?php
            if (!empty($suffix_lite_article_background_color) ){ ?>
            .site .mainbanner-jumbotron-3 .slick-item,
            .site .mainbanner-jumbotron-4 .slick-item,
            .site .mainbanner-jumbotron .data-bg-slide {
                background-color: <?php echo esc_html($suffix_lite_article_background_color); ?>;
            }
            <?php } ?>


            <?php
            if (!empty($suffix_lite_featured_article_title_color) ){ ?>
                .twp-featured-block .article-detail .small-title a {
                    color: <?php echo esc_html($suffix_lite_featured_article_title_color); ?>;
                }
            <?php } ?>

            <?php
            if (!empty($suffix_lite_article_title_color_widget) ){ ?>
                .widget .small-title a {
                    color: <?php echo esc_html($suffix_lite_article_title_color_widget); ?>;
                }
            <?php } ?>


            <?php
            if (!empty($suffix_lite_top_bar_background_color) ){ ?>
                body .site .news a:hover > span,
                body .site .news a:hover,
                .site .top-bar:before {
                    background: <?php echo esc_html($suffix_lite_top_bar_background_color); ?>;
                }
            <?php } ?>

            <?php
            if (!empty($suffix_lite_top_bar_text_color) ){ ?>
                .site .top-bar,
                .site .top-bar a{
                    color: <?php echo esc_html($suffix_lite_top_bar_text_color); ?>;
                }
                .site .news a > span:not(.comments):after,
                .site .hamburger-inner,
                .site .hamburger-inner:after,
                .site .hamburger-inner:before{
                    background-color: <?php echo esc_html($suffix_lite_top_bar_text_color); ?>;
                }
            <?php } ?>

            <?php
            if (!empty($suffix_lite_ticker_background_color) ){ ?>
                .site .top-bar .news {
                    background: <?php echo esc_html($suffix_lite_ticker_background_color); ?>;
                }
            <?php } ?>

            <?php
            if (!empty($suffix_lite_footer_widget_bg_color) ){ ?>
                .site .site-footer {
                    background: <?php echo esc_html($suffix_lite_footer_widget_bg_color); ?>;
                }
            <?php } ?>

            <?php
            if (!empty($suffix_lite_footer_widget_text_color) ){ ?>
            .site .site-footer .footer-widget-area,
            .site .site-footer .footer-widget-area a,
            .site .site-footer .footer-middle,
            .site .site-footer .footer-middle a{
                color: <?php echo esc_html($suffix_lite_footer_widget_text_color); ?>;
            }
            <?php } ?>

            <?php
            if (!empty($suffix_lite_footer_copyright_bg_color) ){ ?>
            .site .site-footer .footer-bottom{
                background: <?php echo esc_html($suffix_lite_footer_copyright_bg_color); ?>;
            }
            <?php } ?>

            <?php
            if (!empty($suffix_lite_footer_copyright_text_color) ){ ?>
            .site .site-footer .footer-bottom,
            .site .site-footer .footer-bottom a{
                color: <?php echo esc_html($suffix_lite_footer_copyright_text_color); ?>;
            }
            <?php } ?>

        </style>

    <?php }

endif;