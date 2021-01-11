<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package yala_mag
 */

get_header();
?>
<?php get_template_part( 'sections/section','slider' ); ?>
<section class="news-grid-one archives section off-white">
	<div class="container">
		<div class="row">
			<div class="col-lg-8 col-12 ">
				<div class="row">
					<?php
					if ( have_posts() ) :
					/* Start the Loop */
					while ( have_posts() ) :
						the_post();

							/*
							 * Include the Post-Type-specific template for the content.
							 * If you want to override this in a child theme, then include a file
							 * called content-___.php (where ___ is the Post Type name) and that will be used instead.
							 */
							get_template_part( 'template-parts/content' );
							endwhile;
							

					else :

						get_template_part( 'template-parts/content', 'none' );

					endif;
					?>
				</div>
				<div class="row">
					<div class="col-12">
						<!-- Start Pagination -->
						<div class="pagination-main">
							<?php yala_mag_pagination();?>
						</div>
						<!--/ End Pagination -->
					</div>
				</div>
			</div>
			<div class="col-lg-4 col-12">
				<!-- Blog Sidebar -->
				<?php get_sidebar();?>
				<!--/ End Blog Sidebar -->
			</div>
		</div>
	</div>
</section>
<?php get_footer();?>
