<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package suffix
 */

?>
</div><!-- #content -->
<?php if (is_active_sidebar('footer-full-width-2')) { ?>
    <div class="footer-full-width">
        <div class="suffix-lite-wrapper-fluid">
                <?php dynamic_sidebar('footer-full-width-2'); ?>
        </div>
    </div>
<?php } ?>



<footer id="colophon" class="site-footer" role="contentinfo">
    <?php $suffix_lite_footer_widgets_number = suffix_lite_get_option('number_of_footer_widget');
    if (1 == $suffix_lite_footer_widgets_number) {
        $col = 'column-full';
    } elseif (2 == $suffix_lite_footer_widgets_number) {
        $col = 'column-half';
    } elseif (3 == $suffix_lite_footer_widgets_number) {
        $col = 'column-three';
    } elseif (4 == $suffix_lite_footer_widgets_number) {
        $col = 'column-quarter';
    } else {
        $col = 'column-three';
    }
    if (is_active_sidebar('footer-col-one') || is_active_sidebar('footer-col-two') || is_active_sidebar('footer-col-three') || is_active_sidebar('footer-col-four')) { ?>
        <div class="footer-widget-area">
            <div class="suffix-lite-wrapper">
                <div class="grid-row">
                    <?php if (is_active_sidebar('footer-col-one') && $suffix_lite_footer_widgets_number > 0) : ?>
                        <div class="column <?php echo esc_attr($col); ?>">
                            <?php dynamic_sidebar('footer-col-one'); ?>
                        </div>
                    <?php endif; ?>
                    <?php if (is_active_sidebar('footer-col-two') && $suffix_lite_footer_widgets_number > 1) : ?>
                        <div class="column <?php echo esc_attr($col); ?>">
                            <?php dynamic_sidebar('footer-col-two'); ?>
                        </div>
                    <?php endif; ?>
                    <?php if (is_active_sidebar('footer-col-three') && $suffix_lite_footer_widgets_number > 2) : ?>
                        <div class="column <?php echo esc_attr($col); ?>">
                            <?php dynamic_sidebar('footer-col-three'); ?>
                        </div>
                    <?php endif; ?>
                    <?php if (is_active_sidebar('footer-col-four') && $suffix_lite_footer_widgets_number > 3) : ?>
                        <div class="column <?php echo esc_attr($col); ?>">
                            <?php dynamic_sidebar('footer-col-four'); ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>

    <?php } ?>
    <?php if (has_nav_menu('footer')) { ?>
        <div class="footer-middle">
            <div class="suffix-lite-wrapper">
                <div class="grid-row">
                    <div class="column column-full">
                        <div class="site-footer-menu">
                            <?php
                            wp_nav_menu(array(
                                'theme_location' => 'footer',
                                'menu_id' => 'footer-menu',
                                'container' => 'div',
                                'depth' => 1,
                                'menu_class' => false
                            )); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>

    <div class="footer-bottom site-copyright">
        <div class="suffix-lite-wrapper">
            <div class="grid-row">
                <div class="column column-half">
                    <div class="footer-logo">
                        <?php
                            $suffix_lite_footer_secondary_logo = suffix_lite_get_option('footer_secondary_logo');
                        ?>
                        <?php if (!empty($suffix_lite_footer_secondary_logo)) { ?>
                            <a  href="<?php echo esc_url(get_home_url()); ?>">
                                <img src="<?php echo esc_url($suffix_lite_footer_secondary_logo); ?>">
                            </a>
                        <?php } else { ?>
                            <span class="site-title">
                                <a href="<?php echo esc_url(home_url('/')); ?>" rel="home">
                                    <?php bloginfo('name'); ?>
                                </a>
                            </span>
                        <?php } ?>
                    </div>
                    <div class="theme-info">
                        <?php
                        $suffix_lite_copyright_text = suffix_lite_get_option('copyright_text');
                        if (!empty ($suffix_lite_copyright_text)) {
                            echo wp_kses_post($suffix_lite_copyright_text);
                        }
                        ?>
                        <?php if ((suffix_lite_get_option('enable_copyright_credit')) == 1) { ?>
                            <span class="">
                                <?php printf(esc_html__('Theme: %1$s by %2$s', 'suffix-lite'), 'Suffix', '<a href="https://themeinwp.com/" target = "_blank" rel="designer">ThemeinWP </a>'); ?>
                            </span>
                        <?php } ?>
                    </div>
                </div>
                <div class="column column-half">
                    <?php if (has_nav_menu('social')) { ?>
                        <div class="twp-social-share">
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
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</footer>

<?php
$ed_footer_scroll_top = suffix_lite_get_option('ed_footer_scroll_top');
if( $ed_footer_scroll_top ){ ?>

    <a id="scroll-up" class="primary-bgcolor">
        <i class="fa fa-angle-up"></i>
    </a>

<?php } ?>

<?php if (is_active_sidebar('slide-menu')) : ?>
    <div id="sidr-nav">
        <div class="sidr-header">
            <a href="javascript:void(0)" class="skip-link-offcanvas-start"></a>
            <div class="sidr-left">

                <?php suffix_lite_the_custom_logo(); ?>

                <span class="site-title">
                    <a href="<?php echo esc_url(home_url('/')); ?>" rel="home">
                        <?php bloginfo('name'); ?>
                    </a>
                </span>

                <?php $description = get_bloginfo('description', 'display');

                if ($description || is_customize_preview()) : ?>

                    <p class="site-description"><?php echo $description; ?></p>

                <?php endif; ?>

            </div>

            <div class="sidr-right">
                <a class="sidr-class-sidr-button-close" href="#sidr-nav">

                    <span class="screen-reader-text"><?php esc_html_e('Close', 'suffix-lite');?></span>

                    <i class="fa fa-close"></i>

                </a>
            </div>

        </div>

        <?php dynamic_sidebar('slide-menu'); ?>
        <a href="javascript:void(0)" class="skip-link-offcanvas-end-1"></a>
        <a href="javascript:void(0)" class="skip-link-offcanvas-end"></a>
    </div>
<?php endif; ?>

</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>