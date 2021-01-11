<?php
/**
 * The template for displaying search results pages.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package suffix
 */

get_header(); ?>
<?php $global_layout = suffix_lite_get_option( 'global_layout' );
$sidebar_home_1 = '';
if (suffix_lite_get_option('enable_widget_middle') == 1){
    if (!is_active_sidebar('sidebar-2')) {
        $sidebar_home_1 = "full-width";
    } else {
        $sidebar_home_1 = "not-full-width";
    } 
} else {
    $sidebar_home_1 = '';
}
?>
<?php if ($global_layout == 'no-sidebar') { 
    $sidebar_home_1 = '';
}?>
	<div id="primary" class="content-area <?php echo esc_attr($sidebar_home_1); ?>">
        <div class="grid-row">
			<main id="main" class="site-main" role="main">

			<?php
			if ( have_posts() ) : ?>

				<?php
				/* Start the Loop */
				while ( have_posts() ) : the_post();

					/**
					 * Run the loop for the search to output the results.
					 * If you want to overload this in a child theme then include a file
					 * called content-search.php and that will be used instead.
					 */
					get_template_part( 'template-parts/content', 'search' );

				endwhile;

				/**
				 * Hook - suffix_lite_action_posts_navigation.
				 *
				 * @hooked: suffix_lite_custom_posts_navigation - 10
				 */
				do_action( 'suffix_lite_action_posts_navigation' );

			else :

				get_template_part( 'template-parts/content', 'none' );

			endif; ?>

			</main><!-- #main -->
			<?php if ($global_layout != 'no-sidebar') {
			    if (suffix_lite_get_option('enable_widget_middle') == 1){
			        if (is_active_sidebar('sidebar-2')) { ?>
			            <aside class="aside-bar">
			                <?php dynamic_sidebar('sidebar-2'); ?>
			            </aside>
			<?php }
			} } ?>
		</div>
	</div><!-- #primary -->

<?php
get_sidebar();
get_footer();
