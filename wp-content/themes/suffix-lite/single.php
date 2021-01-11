<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package suffix
 */

get_header(); ?>
<?php
$sidebar_home_1 = '';
if (suffix_lite_get_option('enable_widget_middle_single') == 1){
    if (!is_active_sidebar('sidebar-home-2')) {
        $sidebar_home_1 = "full-width";
    } else {
        $sidebar_home_1 = "not-full-width";
    } 
} else {
    $sidebar_home_1 = '';
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
if ($global_layout != 'no-sidebar') {
   $sidebar_home_1 = '';
}
?>
	<div id="primary" class="content-area <?php echo esc_attr($sidebar_home_1); ?>">
        <div class="grid-row">
            <main id="main" class="site-main" role="main">

            <?php
            while ( have_posts() ) : the_post();

                get_template_part( 'template-parts/content' );

                the_post_navigation();

                // If comments are open or we have at least one comment, load up the comment template.
                if ( comments_open() || get_comments_number() ) :
                    comments_template();
                endif;

            endwhile; // End of the loop.
            ?>

            </main>
            <?php if ($global_layout != 'no-sidebar') {
            if (suffix_lite_get_option('enable_widget_middle_single') == 1){ ?>
                <aside class="aside-bar">
                    <?php dynamic_sidebar('sidebar-2'); ?>
                </aside>
            <?php } } ?>
        </div>
	</div>

<?php
get_sidebar();
get_footer();
