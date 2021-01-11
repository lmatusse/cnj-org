<?php
/**
 * Template part for displaying results in search pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package yala_mag
 */

?>
<div class="col-12">
	<div class="single-news-top">
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

			<div class="news-head shadow primary">
				<?php 
				if(has_post_thumbnail()):
					the_post_thumbnail();
				endif; ?>
				<div class="meta-share">
					<!-- Meta -->
					<div class="meta">
						<span class="date"><i class="fa fa-user"></i><?php the_author(); ?></span>
						<span class="date"><i class="fa fa-calendar"></i><?php yala_mag_posted_on();?></span>
						<span class="time"><i class="fa fa-clock-o"></i><?php the_time();?></span>
						<span class="like"><i class="fa fa-comments"></i><?php echo absint(get_comments_number());?> <?php echo esc_html_e( 'Comments','yala-mag' );?></span>
					</div>
				</div>
			</div>

			<div class="news-content-main">
				<h1><?php the_title();?></h1>
				<?php the_content();?>
				<?php the_posts_navigation(); ?>
			</div>			
		</article>
	</div>	
</div>