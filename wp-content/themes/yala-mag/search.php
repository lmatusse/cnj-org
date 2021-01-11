<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package yala_mag
 */

get_header();
?>
<section class="news-single off-white section">
	<div class="container">
		<div class="row">
			<div class="col-lg-8 col-12">
				<div class="row">
					<?php
					while ( have_posts() ) :
					the_post();
					get_template_part( 'template-parts/content', 'single' );
					the_post_navigation();
					?>
					
					<div class="col-12">
						<div class="comments-form">
							<?php 
							// If comments are open or we have at least one comment, load up the comment template.
							if ( comments_open() || get_comments_number() ) :
								comments_template();
							endif;?>
						</div>
					</div>
					<?php endwhile; // End of the loop.?>	
				</div>
			</div>
			<div class="col-lg-4 col-12">
				<?php get_sidebar();?>
			</div>
		</div>
	</div>
</section>
<?php
get_footer();
?>