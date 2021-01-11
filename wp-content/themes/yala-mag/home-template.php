<?php
/**
 * Template Name: Fontpage
 *
 * This is page is used as front page.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Yala_Mag
 */
get_header();

get_template_part( 'sections/section','slider' );

if ( is_active_sidebar( 'frontpage-layout' ) ) {
	dynamic_sidebar( 'frontpage-layout' );
}

the_content();

get_footer();
?>