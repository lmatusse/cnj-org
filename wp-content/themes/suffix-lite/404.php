<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package suffix
 */

get_header(); ?>

<div class="error-404 not-found">
	<div class="suffix-lite-wrapper">
		<div class="grid-row">
			<div class="column column-full">
				<div class="page-content error-404-content">
					<h3 class="error-404-title"><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'suffix-lite' ); ?></h3>
					<?php
					get_search_form();
					?>
				</div><!-- .page-content -->
			</div>
		</div>
	</div>
</div><!-- .error-404 -->
<?php
get_footer();
