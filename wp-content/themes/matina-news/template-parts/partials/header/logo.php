<?php
/**
 * Header Logo
 *
 * @package Matina News
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

?>
<div class="site-branding" <?php matina_news_schema_markup( 'logo' ); ?>>
    <?php
        if ( function_exists( 'the_custom_logo' ) && has_custom_logo() ) {

            the_custom_logo();
        }
    ?>
            <a class="site-title" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
    <?php
            $matina_news_description = get_bloginfo( 'description', 'display' );
            if ( $matina_news_description || is_customize_preview() ) {
    ?>
                <span class="site-description"><?php echo $matina_news_description; ?></span>
    <?php
            }
    ?>
</div><!-- .site-branding -->