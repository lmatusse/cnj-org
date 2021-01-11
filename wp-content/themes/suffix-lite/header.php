<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package suffix
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php if ( function_exists( 'wp_body_open' ) ) {
    wp_body_open();
}
?>
<?php if (suffix_lite_get_option('enable_preloader_option') == 1) { ?>
    <div class="preloader">
        <div class="preloader-wrapper">
            <div class="loader">
                <span class="screen-reader-text"><?php esc_html_e('Loading...', 'suffix-lite'); ?></span>
            </div>
        </div>
    </div>
<?php } ?>

<div id="page" class="site site-bg">
    <a class="skip-link screen-reader-text" href="#main"><?php esc_html_e('Skip to content', 'suffix-lite'); ?></a>
    <?php 
    $header_class = "";
    if (has_header_image()) {
       $header_class = "data-bg-enable";
    } ?>
    <header id="masthead" class="site-header data-bg <?php echo esc_attr($header_class);?>" role="banner" data-background="<?php echo esc_url(get_header_image()); ?>">
        <?php if (suffix_lite_get_option('show_top_bar_section') == 1) { ?>
            <div class="top-bar">
                <div class="suffix-lite-wrapper clear">
                    <?php if ((suffix_lite_get_option('show_off_canvas') == 1) && (is_active_sidebar( 'slide-menu' ))) { ?>
                    <div class="twp-sidr">
                        <a id="widgets-nav" class="alt-bgcolor" href="#sidr-nav">
                            <span class="hamburger hamburger--arrow">
                                  <span class="hamburger-box">
                                    <span class="hamburger-inner">
                                       <small class="screen-reader-text"><?php esc_html_e('Toggle menu', 'suffix-lite'); ?></small>
                                    </span>
                                  </span>
                            </span>
                        </a>
                    </div>
                    <?php } ?>
                    <?php $rtl_class_c = 'left';
                    if(is_rtl()){ 
                        $rtl_class_c = 'right';
                    }?>
                    <div class="news">
                        <?php
                        $suffix_lite_ticker_text = suffix_lite_get_option('ticker_title');
                        if (!empty($suffix_lite_ticker_text)) { ?>
                            <span class="primary-bgcolor"><?php echo esc_html($suffix_lite_ticker_text); ?></span>
                        <?php } ?>
                        <?php
                        $suffix_lite_ticker_category = absint(suffix_lite_get_option('select_category_for_ticker_section'));
                        $suffix_lite_ticker_news_number = absint(suffix_lite_get_option('ticker_slider_number'));
                        $tinker_args = array(
                            'post_type' => 'post',
                            'posts_per_page' => absint( $suffix_lite_ticker_news_number ),
                            'ignore_sticky_posts' => 1,
                            'cat' => absint($suffix_lite_ticker_category),
                        );
                        $suffix_lite_tinker_post_query = new WP_Query($tinker_args);
                        if ($suffix_lite_tinker_post_query->have_posts()) : ?>
                            <div data-speed="10000" data-direction="<?php echo $rtl_class_c; ?>" class="marquee">
                                <?php while ($suffix_lite_tinker_post_query->have_posts()) : $suffix_lite_tinker_post_query->the_post();
                                    ?>
                                    <a href="<?php the_permalink(); ?>">
                                        <span><?php printf(_x('%s ago', '%s = human-readable time difference', 'suffix-lite'), human_time_diff(get_the_time('U'), current_time('timestamp'))); ?></span><?php the_title(); ?>
                                    </a>
                                <?php
                                endwhile; ?>
                            </div>
                            <?php wp_reset_postdata();
                        endif; ?>
                    </div>
                    <?php if (suffix_lite_get_option('show_top_date') == 1) { ?>
                        <div class="twp-date primary-bgcolor">
                            <i class="fa fa-calendar"></i>
                            <?php $time = current_time('timestamp');
                            echo date_i18n('l, M j, Y',$time); ?>
                        </div>
                    <?php } ?>
                </div>
            </div>
        <?php } ?>
        <?php if (suffix_lite_get_option('enable_logo_center') == 1) {
            $infinity_header_center = 'header-center';
        } else {
            $infinity_header_center = 'header-left';
        } ?>

        <div class="upper-header <?php echo esc_attr($infinity_header_center); ?>">
            <div class="suffix-lite-wrapper">
                <div class="grid-row">
                    <?php if (suffix_lite_get_option('enable_logo_center') == 1) {
                        $infinity_header1_center = 'column-full';
                    } else {
                        $infinity_header1_center = 'column-four';
                    } ?>
                    <div class="column <?php echo esc_attr($infinity_header1_center); ?>">
                        <div class="site-branding">
                            <?php suffix_lite_the_custom_logo(); ?>
                            <?php
                            if (is_front_page() && is_home()) : ?>
                                <span class="site-title">
                                    <a href="<?php echo esc_url(home_url('/')); ?>" rel="home">
                                        <?php bloginfo('name'); ?>
                                    </a>
                                </span>
                            <?php else : ?>
                                <span class="site-title">
                                        <a href="<?php echo esc_url(home_url('/')); ?>" rel="home">
                                            <?php bloginfo('name'); ?>
                                        </a>
                                    </span>
                            <?php endif;
                            $description = get_bloginfo('description', 'display');
                            if ($description || is_customize_preview()) : ?>
                                <p class="site-description"><?php echo $description; ?></p>
                            <?php endif; ?>
                        </div>
                    </div>
                    <?php if (is_active_sidebar('top-header-add')) { ?>
                        <?php if (suffix_lite_get_option('enable_logo_center') == 1) {
                            $infinity_header2_center = 'column-full';
                        } else {
                            $infinity_header2_center = 'column-six';
                        } ?>
                        <div class="column <?php echo esc_attr($infinity_header2_center); ?>">
                            <?php dynamic_sidebar('top-header-add'); ?>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
        <?php if (suffix_lite_get_option('enable_menu_center') == 1) {
            $infinity_enable_menu = 'site-navigation-center';
        } else {
            $infinity_enable_menu = 'site-navigation-left';
        } ?>
        <div id="nav-affix" class="site-navigation <?php echo esc_attr($infinity_enable_menu); ?>">
            <?php
            $navigation_collaps_enable = absint(suffix_lite_get_option('show_navigation_collaps'));
            ?>
            <div class="suffix-lite-wrapper">
                <div class="grid-row">
                    <div class="column column-full">
                        <nav class="main-navigation" role="navigation">
                            <a href="javascript:void(0)" class="toggle-menu" aria-controls="primary-menu" aria-expanded="false">
                                 <span class="screen-reader-text"><?php esc_html_e('Primary Menu', 'suffix-lite'); ?></span>
                                <i class="ham"></i>
                            </a>
                            <?php wp_nav_menu(array(
                                'theme_location' => 'primary',
                                'menu_id' => 'primary-menu',
                                'container' => 'div',
                                'container_class' => 'menu'
                            )); ?>

                            <div class="nav-right">

                                <?php if (suffix_lite_get_option('enable_header_search') == 1) { ?>

                                    <a href="javascript:void(0)" class="icon-search">
                                        <i class="twp-icon fa fa-search"></i>
                                    </a>

                                <?php } ?>

                                <?php if (has_nav_menu('social')) { ?>
                                    <div class="social-icons ">
                                        <?php
                                        wp_nav_menu(
                                            array('theme_location' => 'social',
                                                'link_before' => '<span class="screen-reader-text">',
                                                'link_after' => '</span>',
                                                'menu_id' => 'social-menu',
                                                'fallback_cb' => false,
                                                'menu_class' => 'twp-social-nav',
                                                'container_class' => 'social-menu-container'
                                            )); ?>
                                    </div>
                                <?php } ?>
                            </div>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <?php if (suffix_lite_get_option('enable_header_search') == 1) { ?>

        <div class="popup-search">
            <div class="table-align">
                <a class="skip-link-search-start" href="javascript:void(0)"></a>
                
                <div class="table-align-cell v-align-middle">
                    <?php get_search_form(); ?>
                </div>
                <a href="javascript:void(0)" class="close-popup"></a>
                <a href="javascript:void(0)" class="screen-reader-text search-focus-active"></a>
            </div>
        </div>

    <?php } ?>


    <?php
    if (is_front_page()) {
        do_action('suffix_lite_action_breaking_news_section');

        /**
         * suffix_lite_action_front_page hook
         * @since suffix 0.0.2
         *
         * @hooked suffix_lite_action_front_page -  10
         * @sub_hooked suffix_lite_action_front_page -  10
         */
        do_action('suffix_lite_action_front_page');
    } else {
        do_action('suffix-lite-page-inner-title');
    }
    ?>
    <?php
    if (is_active_sidebar('sidebar-2')) {
        if ((suffix_lite_get_option('enable_widget_middle_single') == 1) || (suffix_lite_get_option('enable_widget_middle') == 1)){
            $content_body_class = "aside-bar-enabled";
        }else if(is_front_page()) {
            $content_body_class = "aside-bar-enabled";
        } else {
            $content_body_class = "aside-bar-disabled";
        }
    } else {
        $content_body_class = "aside-bar-disabled";
    }
    $global_layout = suffix_lite_get_option( 'global_layout' );
    if ( $post && is_singular() ) {
        $post_options = get_post_meta( $post->ID, 'suffix-lite-meta-select-layout', true );
        if ( empty( $post_options ) ) {
            $global_layout = esc_attr( suffix_lite_get_option('global_layout') );
        } else{
            $global_layout = esc_attr($post_options);
        }
    }
    if ($global_layout == 'no-sidebar') {
        $content_body_class = "aside-bar-disabled";
    }
    ?>
    <div id="content" class="site-content <?php echo esc_attr($content_body_class); ?>">