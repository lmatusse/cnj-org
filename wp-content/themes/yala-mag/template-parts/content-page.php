<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package yala_mag
 */

?>
<div class="single-news-inner">
	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<?php 
		if(has_post_thumbnail()):?>
			<div class="image">
				<?php the_post_thumbnail();?>
			</div>
		<?php endif; ?>
		<div class="meta-share">
			<div class="meta">
				<span class="author">
				<?php echo get_avatar( get_the_author_meta('ID'), 100); ?>
					<?php yala_mag_posted_by();?>
				</span>
				<span class="date pl-1"><i class="fa fa-clock-o"></i>
					<?php yala_mag_posted_on();?>
				</span>
				<span class="date pl-4">
					<a href="#"><i class="fa fa-comments"></i>
						<?php echo absint(get_comments_number());?> 
						<?php echo esc_html_e( 'Comments','yala-mag' );?>
					</a>
				</span>
			</div>
		</div>
	<div class="news-content">
		<?php the_content();?>
	</div>
	<?php if ( get_edit_post_link() ) : ?>
		<footer class="entry-footer">
			<?php
			edit_post_link(
				sprintf(
					wp_kses(
						/* translators: %s: Name of current post. Only visible to screen readers */
						__( 'Edit <span class="screen-reader-text">%s</span>', 'yala-mag' ),
						array(
							'span' => array(
								'class' => array(),
							),
						)
					),
					get_the_title()
				),
				'<span class="edit-link">',
				'</span>'
			);
			?>
		</footer><!-- .entry-footer -->
	<?php endif; ?>
</article>
</div>
