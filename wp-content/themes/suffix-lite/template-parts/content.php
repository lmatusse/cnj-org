<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package suffix
 */
?>

<?php if (!is_single()) { ?>
    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <?php $archive_layout = suffix_lite_get_option('archive_layout'); ?>
        <?php $archive_layout_image = suffix_lite_get_option('archive_layout_image'); ?>
        <?php if ('full' == $archive_layout_image) {
            $full_width_content = 'archive-image-full clear';
        } else {
            $full_width_content = 'twp-archive-lr clear';
        }
        ?>
        <div class="<?php echo esc_attr($full_width_content); ?>">
        <?php $archive_layout_image = suffix_lite_get_option('archive_layout_image'); ?>
            <?php if (has_post_thumbnail()) :
                if ('left' == $archive_layout_image) {
                    echo "<div class='twp-image-archive image-left'>";
                    the_post_thumbnail('medium');
                } elseif ('right' == $archive_layout_image) {
                    echo "<div class='twp-image-archive image-right'>";
                    the_post_thumbnail('medium');
                } elseif ('full' == $archive_layout_image) {
                    echo "<div class='twp-image-archive image-full'>";
                    the_post_thumbnail('full');
                } else {
                    echo "<div>";
                }
                echo "</div>";/*div end*/

            endif; ?>
        <div class="entry-content twp-entry-content">
            <?php $archive_layout = suffix_lite_get_option('archive_layout'); ?>

            <div class="twp-meta-categories">
                <?php suffix_lite_entry_breaking_category(); ?>
            </div>
            <h2 class="entry-title archive-entry-title">
                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
            </h2>

            <?php if ('full' == $archive_layout) : ?>
                <?php
                    $read_more_text = esc_html(suffix_lite_get_option('read_more_button_text'));
                    the_content(sprintf(
                    /* translators: %s: Name of current post. */
                        wp_kses($read_more_text, __('%s <i class="ion-ios-arrow-right read-more-right"></i>', 'suffix-lite'), array('span' => array('class' => array()))),
                        the_title('<span class="screen-reader-text">"', '"</span>', false)
                    )); ?>
                    <?php wp_link_pages(array(
                        'before' => '<div class="page-links">' . esc_html__('Pages:', 'suffix-lite'),
                        'after' => '</div>',
                    )); ?>
            <?php else : ?>
                <div>
                    <?php the_excerpt(); ?>
                </div>
            <?php endif ?>

            <div class="twp-meta-info">
                <?php suffix_lite_posted_on(); ?>
            </div>
        </div><!-- .entry-content -->
    </article><!-- #post-## -->
    <?php } else { ?>
        <?php get_template_part( 'template-parts/content', 'single'); ?>
    <?php }

