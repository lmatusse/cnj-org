<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package yala_mag
 */

?>

<div class="col-lg-6 col-md-6 col-12">
	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<!-- Single News -->
		<div class="single-news">
			<div class="news-head">
				<?php 
					$categories = get_the_category(get_the_ID());
				?>
				<div class="cat-name"><a href="<?php echo esc_url(get_category_link($categories[0]->term_id));?>"><?php echo esc_html($categories[0]->name); ?></a></div>
				<div class="comment"><i class="fa fa-comments"></i><?php echo absint(get_comments_number());?> </div>
				<?php if(has_post_thumbnail()):?>
					<?php the_post_thumbnail('yala-mag-350_270');?>
				<?php endif; ?>
			</div>
			<div class="content">
				<h4 class="title-medium"><a href="<?php the_permalink();?>"><?php the_title();?></a></h4>
				<?php the_excerpt(); ?>
				<div class="meta">
					<span class="date"><i class="fa fa-calendar"></i><?php yala_mag_posted_on();?></span>
					<span class="date"><i class="fa fa-clock-o"></i><?php the_time();?></span>						
				</div>
			</div>
		</div>
		<!--/ End Single News -->
	</article>
</div>

<?php
wp_link_pages( array(
	'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'yala-mag' ),
	'after'  => '</div>',
) );
?>
