<!-- News Slider -->
<?php if(get_theme_mod('yala_mag_slider_enable','1')):?>
	<section class="news-slider">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<!-- News Slider -->
					<div class="slider-inner">
						<div class="slider-active">
							<?php
							$args = array(
								'post_type' => 'post',
								'posts_per_page' => absint(get_theme_mod('yala_mag_slider_number','3')),
								'cat' => esc_attr(get_theme_mod('yala_mag_slider_category_id','')),
								'post_status' => 'publish',
								'order'     => 'DSC',
							);
							//print_r($args);exit;
							$sliderloop = new WP_Query($args);

							while ($sliderloop->have_posts()) : 
								$sliderloop->the_post(); 
								$slider_img_url = get_the_post_thumbnail_url( get_the_ID());
								?>
								<!-- Single Slider -->
								<div class="single-slider shadow" style="background-image:url(<?php echo esc_url($slider_img_url);?>)">
									
									<div class="slider-content">
										<div class="slider-text">
											<h1><a href="<?php the_permalink();?>"><?php the_title();?></a></h1>
											<?php the_excerpt();?>
											<a class="btn" href="<?php the_permalink();?>"><?php esc_html_e( 'Read Full News', 'yala-mag' );?></a>
										</div>
									</div>	
								</div>
								<!--/ End Single Slider -->
							<?php endwhile;
							wp_reset_postdata();
							?>
						</div>
						<!-- Slider Pager -->
					</div>
					<!--/ End Tstimonial Slider -->
				</div>
			</div>
		</div>
	</section>
<?php endif;?>
<!--/ End News Slider -->