<?php
/**
 * The template for displaying archive pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
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
                    /*
                     * Include the Post-Format-specific template for the content.
                     * If you want to override this in a child theme, then include a file
                     * called content-___.php (where ___ is the Post Format name) and that will be used instead.
                     */
                    get_template_part( 'template-parts/content');

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

            </main>
            <?php if ($global_layout != 'no-sidebar') {
                if (suffix_lite_get_option('enable_widget_middle') == 1){
                    if (is_active_sidebar('sidebar-2')) { ?>
                        <aside class="aside-bar">
                            <?php dynamic_sidebar('sidebar-2'); ?>
                        </aside>
            <?php }
            } } ?>
        </div>
	</div>
<?php
get_sidebar();
get_footer();
