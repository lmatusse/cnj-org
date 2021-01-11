<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Yala_Mag
 */

?>
</div><!-- #content -->
<!-- Footer Area -->
<footer class="footer style2">
	<?php if(get_theme_mod('yala_mag_footer_top_enable','1')):?>
		<!-- Footer Top -->
		<div class="footer-top">
			<div class="container">
				<div class="row">
					<?php if ( is_active_sidebar( 'footer-widget' ) ) {
						dynamic_sidebar( 'footer-widget' );
					}?>
				</div>
			</div>
		</div>
		<!-- End Footer Top -->
	<?php endif;?>
	<!-- Copyright -->
	<div class="copyright">
		<div class="container">
			<div class="row">
				<div class="col-lg-6 col-md-6 col-12">
					<div class="copyright-content text-left">
						<p><i class="fa fa-copyright"></i><?php echo esc_html( date('Y'));?> <?php bloginfo('name');?></p>
					</div>
				</div>
				<div class="col-lg-6 col-md-6 col-12">
					<div class="copyright-content text-right">
						<p>
							<?php
							/* translators: 1: Theme name, 2: Theme author. */
							printf( esc_html__( 'Theme %2$s by  %1$s', 'yala-mag' ), '<a href="https://www.yalathemes.com" target="_blank" >YalaThemes</a>' , '<a href="https://www.yalathemes.com/downloads/yala-mag-free-wordpress-theme/" target="_blank">Yala Mag </a>' );?>
						</p>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- End Copyright -->
</footer>
<!-- End Footer Area -->
   
<?php wp_footer(); ?>

</body>
</html>