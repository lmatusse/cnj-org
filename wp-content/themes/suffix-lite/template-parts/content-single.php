<?php
/**
 * Template part for displaying single posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package suffix
 */

?>
	<div class="entry-content">
		<?php if (has_excerpt()) { ?>
			<div class="single-excerpt">
				<?php the_excerpt(); ?>
			</div>
		<?php } ?>
		<?php
			$image_values = get_post_meta( $post->ID, 'suffix-lite-meta-image-layout', true );
			if ( empty( $image_values ) ) {
				$values = esc_attr( suffix_lite_get_option('single_post_image_layout') );
			} else{
				$values = esc_attr($image_values);
			}
			if( 'no-image' != $values ){
				if( 'left' == $values ){
					echo "<div class='image-left twp-featured-image'>";
					the_post_thumbnail('medium');
				}
				elseif( 'right' == $values ){
					echo "<div class='image-right twp-featured-image'>";
					the_post_thumbnail('medium');
				}
				else{
					echo "<div class='image-full twp-featured-image'>";
					the_post_thumbnail('full');
				}
				echo "</div>";/*div end */
			}
		?>
		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'suffix-lite' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->
	<?php suffix_lite_entry_tags(); ?>
</article><!-- #post-## -->

<?php 
if (1 == suffix_lite_get_option('enable_author_info_in_single')) { ?>
    <div class="author-description">
        <div class="author-avatar">
        	<?php $user_email = get_the_author_meta( 'user_email' ); ?>
            <img src="<?php echo get_avatar_url($user_email,  'size = 200'); ?>">
        </div>
        <div class="author-details">
            <?php
            $user_display_name = get_the_author_meta( 'display_name' );
            $user_user_description = get_the_author_meta( 'user_description' ); ?>
            <h3 class="author-name">
                <?php echo esc_html($user_display_name); ?>
            </h3>
            <div class="author-info author-description-content">
                <?php echo esc_html($user_user_description); ?>
            </div>
        </div>
    </div>
<?php } ?>

<?php 
if (1 == suffix_lite_get_option('enable_related_post_in_single')) {
    /**
     * Hook suffix_lite_related_posts
     *
     * @hooked suffix_lite_get_related_posts
     */
    do_action('suffix_lite_related_posts');
}