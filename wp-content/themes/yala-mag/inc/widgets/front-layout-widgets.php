<?php
/**
 * Widget - Yala Mag Layouts
 *
 * @package Yala_Mag
 */

/*-----------------------------------------------------
		Front Page Yala Mag Layout One Widgets
-----------------------------------------------------*/

if ( ! class_exists( 'Yala_Mag_Block_Layout_One' ) ) :
	/**
	* News Block Layout One
	*/
	class Yala_Mag_Block_Layout_One extends WP_Widget{

		public function __construct(){
			$opts = array(
				'classname' => 'yala_mag_block_layout_one',
				'description'	=> esc_html__( 'Yala Mag Block Layout One. Place it within "Frontpage Layouts Area"', 'yala-mag' )
			);

			parent::__construct( 'news-block-layout-one', esc_html__( 'YM: News Block Layout 1', 'yala-mag' ), $opts );
		}

		public function form( $instance ) {
			$title = ! empty( $instance[ 'title' ] ) ? $instance[ 'title' ] : __('Layout 1','yala-mag');
			$cat = ! empty( $instance[ 'cat' ] ) ? $instance[ 'cat' ] : 0;
			$post_no = ! empty( $instance[ 'post_no' ] ) ? $instance[ 'post_no' ] : 3;
			$layout_enable = ! empty( $instance[ 'layout_enable' ] ) ? $instance[ 'layout_enable' ] : 'off';
			?>

			<p>
				<input class="checkbox" type="checkbox" <?php checked( $layout_enable, 'on' ); ?> id="<?php echo esc_attr($this->get_field_id( 'layout_enable' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'layout_enable' ) ); ?>" /> 
				<label for="<?php echo esc_attr($this->get_field_id( 'layout_enable' )); ?>"><?php esc_html_e('Enable/Disable Yala Mag Block Layout 1', 'yala-mag'); ?></label>
				<br/>
			</p>

			<p>		
				<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><strong><?php echo esc_html__( 'Title: ', 'yala-mag' ); ?></strong></label>
				<input type="text" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" value="<?php echo esc_attr( $title ); ?>" class="widefat">
				<br/>	
			</p>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'cat' ) )?>"><strong><?php echo esc_html__( 'Select Category:', 'yala-mag' ); ?></strong></label>
				<br>
				<?php
				$cat_args = array(
					'orderby'	=> 'name',
					'hide_empty'	=> 1,
					'show_count'    => 1,
					'hierarchical'  => 1,
					'id'	=> $this->get_field_id( 'cat' ),
					'name'	=> $this->get_field_name( 'cat' ),
					'class'	=> 'widefat',
					'taxonomy'	=> 'category',
					'selected'	=> absint( $cat ),
				);
				wp_dropdown_categories( $cat_args );
				?>
			</p>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'post_no' ) )?>"><strong><?php echo esc_html__( 'Post No: ', 'yala-mag' )?></strong></label>
				<input type="number" id="<?php echo esc_attr( $this->get_field_id( 'post_no' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'post_no' ) ); ?>" value="<?php echo esc_attr( $post_no ); ?>" class="widefat">
			</p>
			<?php
		}


		public function update( $new_instance, $old_instance ) {
			$instance = $old_instance;
			$instance[ 'title' ] = sanitize_text_field( $new_instance[ 'title' ] );
			$instance[ 'cat' ] = absint( $new_instance[ 'cat' ] );
			$instance[ 'post_no' ] = absint( $new_instance[ 'post_no' ] );
			$instance[ 'layout_enable' ] = $new_instance[ 'layout_enable' ];
			
			return $instance;
		}

		
		public function widget( $args, $instance ) {
			$cat = ! empty( $instance[ 'cat' ] ) ? $instance[ 'cat' ] : 0;
			$title = apply_filters( 'widget_title', ! empty( $instance['title'] ) ? $instance['title'] : '', $instance, $this->id_base );
			$post_no = ! empty( $instance[ 'post_no' ] ) ? $instance[ 'post_no' ] : 3;
			
			$layout_enable_check = isset( $instance['layout_enable'] ) ? esc_attr( $instance['layout_enable'] ) : '';
			$layout_enable = $layout_enable_check ? 'true' : 'false';
			echo $args[ 'before_widget' ];
			if($layout_enable =='true'):
				?>
				<!-- Trending News -->
				<section class="treding-news section off-white">
					<?php
					$arguments = array(
						'cat'	=> absint( $cat ),
						'posts_per_page' => absint( $post_no )
					);
					$query = new WP_Query( $arguments );
					if( $query->have_posts() ) :
						?>
						<div class="container">
							<div class="row">
								<div class="col-12">
									<?php
									echo $args[ 'before_title' ];
									?>
									<?php 
									echo esc_html( $title ); ?>
									<?php
									echo $args[ 'after_title' ];
									?>
								</div>
							</div>
							<div class="row">
								<?php
									while( $query->have_posts() ) :
										$query->the_post();
										?>
										<div class="col-lg-4 col-md-6 col-12">
											<!-- Single News -->
											<div class="single-news">
												<?php 
												if(has_post_thumbnail()):?>
												<div class="news-head shadow primary">
													<div class="comment"><i class="fa fa-comments"></i><?php echo absint(get_comments_number());?></div>
													<?php the_post_thumbnail('yala-mag-350_270');?>
												</div>
												<?php endif;?>

												<div class="content">
													<h4 class="title-medium"><a href="<?php the_permalink();?>"><?php the_title();?></a></h4>
													<div class="meta">
														<span class="date"><i class="fa fa-calendar"></i><?php yala_mag_posted_on();?></span>
														<span class="time"><i class="fa fa-clock-o"></i><?php the_time();?></span>
													</div>
													<?php the_excerpt();?>
												</div>
											</div>
											<!--/ End Single News -->
										</div>
										<?php
									endwhile;
									wp_reset_postdata();
								
								?>
							</div>
						</div>
						<?php
					endif;?>
				</section>
				<?php
			endif;
			echo $args[ 'after_widget' ];
		}		
	}
endif;


/*-----------------------------------------------------
	Front Post Yala Mag Layout Two Widgets
-----------------------------------------------------*/

if (!class_exists('Yala_Mag_Block_Layout_Two')):
class Yala_Mag_Block_Layout_Two extends WP_Widget{
		public function __construct(){
			$opts = array(
				'classname' => 'yala_mag_block_layout_two',
				'description'	=> esc_html__( 'Yala Mag Block Layout Two. Place it within "Frontpage Layouts Area"', 'yala-mag' )
			);

			parent::__construct( 'news-block-layout-two', esc_html__( 'YM: News Block Layout 2', 'yala-mag' ), $opts );
		}

	    public function form( $instance ){
	    	$title = ! empty( $instance[ 'title' ] ) ? $instance[ 'title' ] : __('Layout 2','yala-mag');
			$cat = ! empty( $instance[ 'cat' ] ) ? $instance[ 'cat' ] : 0;
			$post_no = ! empty( $instance[ 'post_no' ] ) ? $instance[ 'post_no' ] : 3;
			$layout_enable = ! empty( $instance[ 'layout_enable' ] ) ? $instance[ 'layout_enable' ] : 'off';
			?>

			<p>
				<input class="checkbox" type="checkbox" <?php checked( $layout_enable, 'on' ); ?> id="<?php echo esc_attr($this->get_field_id( 'layout_enable' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'layout_enable' ) ); ?>" /> 
				<label for="<?php echo esc_attr($this->get_field_id( 'layout_enable' )); ?>"><?php esc_html_e('Enable/Disable Yala Mag Block Layout 2', 'yala-mag'); ?></label>
				<br/>
			</p>

			<p>		
				<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><strong><?php echo esc_html__( 'Title: ', 'yala-mag' ); ?></strong></label>
				<input type="text" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" value="<?php echo esc_attr( $title ); ?>" class="widefat">
				<br/>	
			</p>
			
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'cat' ) )?>"><strong><?php echo esc_html__( 'Select Category:', 'yala-mag' ); ?></strong></label>
				<br>
				<?php
				$cat_args = array(
					'orderby'	=> 'name',
					'hide_empty'	=> 1,
					'show_count'    => 1,
					'hierarchical'  => 1,
					'id'	=> $this->get_field_id( 'cat' ),
					'name'	=> $this->get_field_name( 'cat' ),
					'class'	=> 'widefat',
					'taxonomy'	=> 'category',
					'selected'	=> absint( $cat ),
				);
				wp_dropdown_categories( $cat_args );
				?>
			</p>

			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'post_no' ) )?>"><strong><?php echo esc_html__( 'Post No: ', 'yala-mag' )?></strong></label>
				<input type="number" id="<?php echo esc_attr( $this->get_field_id( 'post_no' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'post_no' ) ); ?>" value="<?php echo esc_attr( $post_no ); ?>" class="widefat">
			</p>
		
		<?php  }

	    public function update($new_instance, $old_instance){
	        $instance = $old_instance;
			$instance[ 'title' ] = sanitize_text_field( $new_instance[ 'title' ] );
			$instance[ 'cat' ] = absint( $new_instance[ 'cat' ] );
			$instance[ 'post_no' ] = absint( $new_instance[ 'post_no' ] );
			$instance[ 'layout_enable' ] = $new_instance[ 'layout_enable' ];
			
			return $instance;
	    }

	    public function widget($args, $instance){
	        if (!empty($instance)) {
	            $cat = ! empty( $instance[ 'cat' ] ) ? $instance[ 'cat' ] : 0;
				$title = apply_filters( 'widget_title', ! empty( $instance['title'] ) ? $instance['title'] : '', $instance, $this->id_base );
				$post_no = ! empty( $instance[ 'post_no' ] ) ? $instance[ 'post_no' ] : 3;
				
				$layout_enable_check = isset( $instance['layout_enable'] ) ? esc_attr( $instance['layout_enable'] ) : '';
				$layout_enable = $layout_enable_check ? 'true' : 'false';
	            if($layout_enable =='true'):
	            ?>
	          <!-- Featured News -->
				<section class="featured-news section">
					<div class="container">
						<div class="row">
							<div class="col-12">
								<h2 class="featured-title"><span><?php echo esc_html($title);?></span></h2>
							</div>
						</div>
						<div class="row">
							<div class="col-12">
								<!-- Featured Slider -->
								<div class="featured-slider">
									<?php
									$arguments = array(
										'cat'	=> absint( $cat ),
										'posts_per_page' => absint( $post_no )
									);
									$query = new WP_Query( $arguments );
									if( $query->have_posts() ) :
										while( $query->have_posts() ) :
											$query->the_post();
										?>
										<!-- Single News -->
										<div class="single-news">
											<div class="news-head shadow">
												<?php 
													if(has_post_thumbnail()):
														the_post_thumbnail('yala-mag-334_417');
													endif;
												?>
												<div class="content">	
													<?php 
														$categories = get_the_category(get_the_ID());
													?>
													<div class="cat-name"><a href="<?php echo esc_url(get_category_link($categories[0]->term_id));?>"><?php echo esc_html($categories[0]->name); ?></a></div>
													<!-- Meta -->
													<div class="meta">
														<span class="date"><i class="fa fa-calendar"></i><?php yala_mag_posted_on();?></span>
														<span class="time"><i class="fa fa-clock-o"></i><?php the_time();?></span>
														
													</div>
													<h2 class="title-medium"><a href="<?php the_permalink();?>"><?php the_title();?></a></h2>
												</div>
											</div>
										</div>
										<!--/ End Single News -->
										<?php
										endwhile;
										wp_reset_postdata();
									endif; ?>		
								</div>
								<!--/ End Featured Slider -->
							</div>
						</div>
					</div>
				</section>
				<!-- End Featured News -->
	            <?php
	            
	            endif;
	        }
	    }
	}
endif;

/*-----------------------------------------------------
		Front Page Yala Mag Layout Three Widgets
-----------------------------------------------------*/
if ( ! class_exists( 'Yala_Mag_Block_Layout_Three' ) ) :
	/**
	* Yala Mag Layout Three
	*/
	class Yala_Mag_Block_Layout_Three extends WP_Widget
	{

		public function __construct(){
			$opts = array(
				'classname' => 'yala_mag_block_layout_three',
				'description'	=> esc_html__( 'Yala Mag Block Layout Three. Place it within "Frontpage Layouts Area"', 'yala-mag' )
			);

			parent::__construct( 'yala-mag-block-layout-three', esc_html__( 'YM: Yala Mag Block Layout 3', 'yala-mag' ), $opts );
		}

		public function form( $instance ) {

			$title = ! empty( $instance[ 'title' ] ) ? $instance[ 'title' ] : __('Layout 3','yala-mag');
			$cat_1 = ! empty( $instance[ 'cat_1' ] ) ? $instance[ 'cat_1' ] : 0;
			$cat_2 = ! empty( $instance[ 'cat_2' ] ) ? $instance[ 'cat_2' ] : 0;
			$cat_3 = ! empty( $instance[ 'cat_3' ] ) ? $instance[ 'cat_3' ] : 0;
			$cat_4 = ! empty( $instance[ 'cat_4' ] ) ? $instance[ 'cat_4' ] : 0;
			$cat_5 = ! empty( $instance[ 'cat_5' ] ) ? $instance[ 'cat_5' ] : 0;
			$cat_6 = ! empty( $instance[ 'cat_6' ] ) ? $instance[ 'cat_6' ] : 0;
			$post_no = ! empty( $instance[ 'post_no' ] ) ? $instance[ 'post_no' ] : 5;
			$layout_enable = ! empty( $instance[ 'layout_enable' ] ) ? $instance[ 'layout_enable' ] : 'off';
			?>
			<p>
				<input class="checkbox" type="checkbox" <?php checked( $layout_enable, 'on' ); ?> id="<?php echo esc_attr($this->get_field_id( 'layout_enable' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'layout_enable' ) ); ?>" /> 
				<label for="<?php echo esc_attr($this->get_field_id( 'layout_enable' )); ?>"><?php esc_html_e('Enable/Disable Yala Mag Block Layout 3', 'yala-mag'); ?></label>
				<br/>
			</p>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><strong><?php echo esc_html__( 'Title: ', 'yala-mag' ); ?></strong></label>
				<input type="text" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" value="<?php echo esc_attr( $title ); ?>" class="widefat">
			</p>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'cat_1' ) )?>"><strong><?php echo esc_html__( 'Category tabs-1:', 'yala-mag' ); ?></strong></label>
				<br>
				<?php
				$cat_args_1 = array(
					'orderby'	=> 'name',
					'hide_empty'	=> 1,
					'show_count'    => 1,
					'hierarchical'  => 1,
					'id'	=> $this->get_field_id( 'cat_1' ),
					'name'	=> $this->get_field_name( 'cat_1' ),
					'class'	=> 'widefat',
					'taxonomy'	=> 'category',
					'selected'	=> absint( $cat_1 ),
				);
				wp_dropdown_categories( $cat_args_1 );
				?>
			</p>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'cat_2' ) )?>"><strong><?php echo esc_html__( 'Category tabs-2:', 'yala-mag' ); ?></strong></label>
				<?php
				$cat_args_2 = array(
					'orderby'		=> 'name',
					'hide_empty'	=> 1,
					'show_count'    => 1,
					'hierarchical'  => 1,
					'id'	=> $this->get_field_id( 'cat_2' ),
					'name'	=> $this->get_field_name( 'cat_2' ),
					'class'	=> 'widefat',
					'taxonomy'	=> 'category',
					'selected'	=> absint( $cat_2 ),
				);
				wp_dropdown_categories( $cat_args_2 );
				?>
			</p>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'cat_3' ) )?>"><strong><?php echo esc_html__( 'Category tabs-3:', 'yala-mag' ); ?></strong></label>
				<br>
				<?php
				$cat_args_3 = array(
					'orderby'	=> 'name',
					'hide_empty'	=> 1,
					'show_count'    => 1,
					'hierarchical'  => 1,
					'id'	=> $this->get_field_id( 'cat_3' ),
					'name'	=> $this->get_field_name( 'cat_3' ),
					'class'	=> 'widefat',
					'taxonomy'	=> 'category',
					'selected'	=> absint( $cat_3 ),
				);
				wp_dropdown_categories( $cat_args_3 );
				?>
			</p>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'cat_4' ) )?>"><strong><?php echo esc_html__( 'Category tabs-4', 'yala-mag' ); ?></strong></label>
				<br>
				<?php
				$cat_args_4 = array(
					'orderby'	=> 'name',
					'hide_empty'	=> 1,
					'show_count'    => 1,
					'hierarchical'  => 1,
					'id'	=> $this->get_field_id( 'cat_4' ),
					'name'	=> $this->get_field_name( 'cat_4' ),
					'class'	=> 'widefat',
					'taxonomy'	=> 'category',
					'selected'	=> absint( $cat_4 ),
				);
				wp_dropdown_categories( $cat_args_4 );
				?>
			</p>

			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'cat_5' ) )?>"><strong><?php echo esc_html__( 'Category tabs-5:', 'yala-mag' ); ?></strong></label>
				<br>
				<?php
				$cat_args_5 = array(
					'orderby'	=> 'name',
					'hide_empty'	=> 1,
					'show_count'    => 1,
					'hierarchical'  => 1,
					'id'	=> $this->get_field_id( 'cat_5' ),
					'name'	=> $this->get_field_name( 'cat_5' ),
					'class'	=> 'widefat',
					'taxonomy'	=> 'category',
					'selected'	=> absint( $cat_5 ),
				);
				wp_dropdown_categories( $cat_args_5 );
				?>
			</p>

			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'cat_6' ) )?>"><strong><?php echo esc_html__( 'Category tabs-6:', 'yala-mag' ); ?></strong></label>
				<br>
				<?php
				$cat_args_6 = array(
					'orderby'	=> 'name',
					'hide_empty'	=> 1,
					'show_count'    => 1,
					'hierarchical'  => 1,
					'id'	=> $this->get_field_id( 'cat_6' ),
					'name'	=> $this->get_field_name( 'cat_6' ),
					'class'	=> 'widefat',
					'taxonomy'	=> 'category',
					'selected'	=> absint( $cat_6 ),
				);
				wp_dropdown_categories( $cat_args_6 );
				?>
			</p>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'post_no' ) )?>"><strong><?php echo esc_html__( 'Post No: ', 'yala-mag' )?></strong></label>
				<input type="number" id="<?php echo esc_attr( $this->get_field_id( 'post_no' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'post_no' ) ); ?>" value="<?php echo esc_attr( $post_no ); ?>" class="widefat">
			</p>
			<?php
		}
		
		public function update( $new_instance, $old_instance ) {
			$instance = $old_instance;
			$instance[ 'title' ] = sanitize_text_field( $new_instance[ 'title' ] );
			$instance[ 'cat_1' ] = absint( $new_instance[ 'cat_1' ] );
			$instance[ 'cat_2' ] = absint( $new_instance[ 'cat_2' ] );
			$instance[ 'cat_3' ] = absint( $new_instance[ 'cat_3' ] );
			$instance[ 'cat_4' ] = absint( $new_instance[ 'cat_4' ] );
			$instance[ 'cat_5' ] = absint( $new_instance[ 'cat_5' ] );
			$instance[ 'cat_6' ] = absint( $new_instance[ 'cat_6' ] );
			$instance[ 'post_no' ] = absint( $new_instance[ 'post_no' ] );
			$instance[ 'layout_enable' ] = $new_instance[ 'layout_enable' ];
		
			return $instance;
		}

		public function widget( $args, $instance ) {
			$cat_1 = ! empty( $instance[ 'cat_1' ] ) ? $instance[ 'cat_1' ] : 0;
			$cat_2 = ! empty( $instance[ 'cat_2' ] ) ? $instance[ 'cat_2' ] : 0;
			$cat_3 = ! empty( $instance[ 'cat_3' ] ) ? $instance[ 'cat_3' ] : 0;
			$cat_4 = ! empty( $instance[ 'cat_4' ] ) ? $instance[ 'cat_4' ] : 0;
			$cat_5 = ! empty( $instance[ 'cat_5' ] ) ? $instance[ 'cat_5' ] : 0;
			$cat_6 = ! empty( $instance[ 'cat_6' ] ) ? $instance[ 'cat_6' ] : 0;
			
			$title = apply_filters( 'widget_title', ! empty( $instance['title'] ) ? $instance['title'] : '', $instance, $this->id_base );
			$post_no = ! empty( $instance[ 'post_no' ] ) ? $instance[ 'post_no' ] : 5;
			$layout_enable_check = isset( $instance['layout_enable'] ) ? esc_attr( $instance['layout_enable'] ) : '';
			$layout_enable = $layout_enable_check ? 'true' : 'false';
			echo $args[ 'before_widget' ];
			if($layout_enable =='true'):
			echo $args[ 'before_widget' ];

			?>
			<section class="news-tabs">
				<div class="container">
					<div class="row">
						<div class="col-12">
							<div class="tab-main">
								<div class="nav-main">
									<!-- Tab Menu -->
									<ul class="nav nav-tabs" id="myTab" role="tablist">
										<li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#<?php echo esc_attr( str_replace( ' ', '-', strtolower( get_cat_name( $cat_1 ) ) ) );?>_<?php echo esc_attr( $this->get_field_id( 'cat_1' ) )?>" role="tab"><i class="icofont-crown"></i><?php echo esc_html(get_cat_name( $cat_1 ));?></a></li>

										<li class="nav-item"><a class="nav-link" data-toggle="tab" href="#<?php echo esc_attr( str_replace( ' ', '-', strtolower( get_cat_name( $cat_2 ) ) ) );?>_<?php echo esc_attr( $this->get_field_id( 'cat_2' ) )?>" role="tab" ><i class="icofont-dashboard-web"></i><?php echo esc_html(get_cat_name( $cat_2 ));?></a></li>

										<li class="nav-item"><a class="nav-link" data-toggle="tab" href="#<?php echo esc_attr( str_replace( ' ', '-', strtolower( get_cat_name( $cat_3 ) ) ) );?>_<?php echo esc_attr( $this->get_field_id( 'cat_3' ) )?>" role="tab" ><i class="icofont-tracking"></i><?php echo esc_html(get_cat_name( $cat_3 ));?></a></li>

										<li class="nav-item"><a class="nav-link" data-toggle="tab" href="#<?php echo esc_attr( str_replace( ' ', '-', strtolower( get_cat_name( $cat_4 ) ) ) );?>_<?php echo esc_attr( $this->get_field_id( 'cat_4' ) )?>" role="tab" ><i class="icofont-ui-edit"></i><?php echo esc_html(get_cat_name( $cat_4 ));?></a></li>

										<li class="nav-item"><a class="nav-link" data-toggle="tab" href="#<?php echo esc_attr( str_replace( ' ', '-', strtolower( get_cat_name( $cat_5 ) ) ) );?>_<?php echo esc_attr( $this->get_field_id( 'cat_5' ) )?>" role="tab" ><i class="icofont-ui-edit"></i><?php echo esc_html(get_cat_name( $cat_5 ));?></a></li>

										<li class="nav-item"><a class="nav-link" data-toggle="tab" href="#<?php echo esc_attr( str_replace( ' ', '-', strtolower( get_cat_name( $cat_6 ) ) ) );?>_<?php echo esc_attr( $this->get_field_id( 'cat_6' ) )?>" role="tab" ><i class="icofont-ui-edit"></i><?php echo esc_html(get_cat_name( $cat_6 ));?></a></li>
									</ul>
									<!--/ End Tab Menu -->
								</div>
								<div class="tab-content" id="myTabContent">
									<!-- Single Tab1 -->
									<?php
									$arg_1 = array(
										'cat'	=> absint( $cat_1 ),
										'posts_per_page' => absint( $post_no )
									);
									$query1 = new WP_Query( $arg_1 );
									if( $query1->have_posts() ) :
										?>
										<div class="tab-pane fade show active" id="<?php echo esc_attr( str_replace( ' ', '-', strtolower( get_cat_name( $cat_1 ) ) ) );?>_<?php echo esc_attr( $this->get_field_id( 'cat_1' ) )?>" role="tabpanel">
											<div class="row">
												<div class="col-lg-8 col-12">
													<!-- Single News -->
													<?php
													$count = 0;
													while( $query1->have_posts() ) :
														$query1->the_post();
														if( $count == 0 ) :
															?>
															<div class="tab-big-news">
																<!-- News Head -->
																<?php 
																if(has_post_thumbnail()):?>
																	<?php the_post_thumbnail();?>
																<?php endif;
																?>
																<div class="content">
																	<h2 class="title-big"><a href="<?php the_permalink();?>"><?php the_title();?></a></h2>
																	<div class="meta">
																	
																		<span class="date"><i class="fa fa-clock-o"></i><?php yala_mag_posted_on();?></span>
																		<span class="date"><i class="fa fa-clock-o"></i><?php the_time();?></span>
																	</div>
																	<?php the_excerpt();?>
																	<div class="button">
																		<a href="<?php the_permalink();?>" class="btn"><?php esc_html_e('Read More','yala-mag');?></a>
																	</div>
																</div>
															</div>
															<!--/ End Single News -->
															<?php
														endif;
														$count = $count + 1;
													endwhile;
													wp_reset_postdata();
													?>
												</div>
												<div class="col-lg-4 col-12">
													<!-- Tab other news -->
													<div class="tab-small-news">
														<h3><?php echo esc_html($title);?></h3>
														<?php
														$count = 0;
														while( $query1->have_posts() ) :
															$query1->the_post();
															if( $count > 0 ) :?>
																<!-- Single News -->
																<div class="single-news">
																	<!-- News Head -->
																	<?php 
																	if(has_post_thumbnail()):?>
																		<div class="news-head">
																			<?php the_post_thumbnail('yala-mag-50_50');?>
																		</div>
																	<?php endif;
																	?>
																	<!-- Content -->
																	<div class="content">
																		<h4 class="title-small"><a href="<?php the_permalink();?>"><?php the_title();?></a></h4>
																	</div>
																</div>
																<!--/ End Single News -->
																<?php
															endif;
															$count = $count + 1;
														endwhile;
														wp_reset_postdata();
														?>
													</div>
													<!--/ End tab other news -->
												</div>
											</div>
										</div>
									<?php endif;?>
									<!--/ End Single Tab 1 -->
									
									<!-- Single Tab2 -->
									<?php
									$arg_2 = array(
										'cat'	=> absint( $cat_2 ),
										'posts_per_page' => absint( $post_no )
									);
									$query2 = new WP_Query( $arg_2 );
									if( $query2->have_posts() ) :
										?>
										<div class="tab-pane fade" id="<?php echo esc_attr( str_replace( ' ', '-', strtolower( get_cat_name( $cat_2 ) ) ) );?>_<?php echo esc_attr( $this->get_field_id( 'cat_2' ) )?>" role="tabpanel">
											<div class="row">
												<div class="col-lg-8 col-12">
													<!-- Single News -->
													<?php
													$count = 0;
													while( $query2->have_posts() ) :
														$query2->the_post();
														if( $count == 0 ) :
															?>
															<div class="tab-big-news">
																<!-- News Head -->
																<?php 
																if(has_post_thumbnail()):?>
																	<?php the_post_thumbnail('yala-mag-690_460');?>
																<?php endif;
																?>
																<div class="content">
																	<h2 class="title-big"><a href="<?php the_permalink();?>"><?php the_title();?></a></h2>
																	<div class="meta">
																	
																		<span class="date"><i class="fa fa-clock-o"></i><?php yala_mag_posted_on();?></span>
																		<span class="date"><i class="fa fa-clock-o"></i><?php the_time();?></span>
																	</div>
																	<?php the_excerpt();?>
																	<div class="button">
																		<a href="<?php the_permalink();?>" class="btn"><?php esc_html_e('Read More','yala-mag');?></a>
																	</div>
																</div>
															</div>
															<!--/ End Single News -->
															<?php
														endif;
														$count = $count + 1;
													endwhile;
													wp_reset_postdata();
													?>
												</div>
												<div class="col-lg-4 col-12">
													<!-- Tab other news -->
													<div class="tab-small-news">
														<h3><?php echo esc_html($title);?></h3>
														<?php
														$count = 0;
														while( $query2->have_posts() ) :
															$query2->the_post();
															if( $count > 0 ) :?>
																<!-- Single News -->
																<div class="single-news">
																	<!-- News Head -->
																	<?php 
																	if(has_post_thumbnail()):?>
																		<div class="news-head">
																			<?php the_post_thumbnail('yala-mag-50_50');?>
																		</div>
																	<?php endif;
																	?>
																	<!-- Content -->
																	<div class="content">
																		<h4 class="title-small"><a href="<?php the_permalink();?>"><?php the_title();?></a></h4>
																	</div>
																</div>
																<!--/ End Single News -->
																<?php
															endif;
															$count = $count + 1;
														endwhile;
														wp_reset_postdata();
														?>
													</div>
													<!--/ End tab other news -->
												</div>
											</div>
										</div>
									<?php endif;?>
									<!--/ End Single Tab 2 -->

									<!-- Single Tab3 -->
									<?php
									$arg_3 = array(
										'cat'	=> absint( $cat_3 ),
										'posts_per_page' => absint( $post_no )
									);
									$query3 = new WP_Query( $arg_3 );
									if( $query3->have_posts() ) :
										?>
										<div class="tab-pane fade" id="<?php echo esc_attr( str_replace( ' ', '-', strtolower( get_cat_name( $cat_3 ) ) ) );?>_<?php echo esc_attr( $this->get_field_id( 'cat_3' ) )?>" role="tabpanel">
											<div class="row">
												<div class="col-lg-8 col-12">
													<!-- Single News -->
													<?php
													$count = 0;
													while( $query3->have_posts() ) :
														$query3->the_post();
														if( $count == 0 ) :
															?>
															<div class="tab-big-news">
																<!-- News Head -->
																<?php 
																if(has_post_thumbnail()):?>
																	<?php the_post_thumbnail('yala-mag-690_460');?>
																<?php endif;
																?>
																<div class="content">
																	<h2 class="title-big"><a href="<?php the_permalink();?>"><?php the_title();?></a></h2>
																	<div class="meta">
																	
																		<span class="date"><i class="fa fa-clock-o"></i><?php yala_mag_posted_on();?></span>
																		<span class="date"><i class="fa fa-clock-o"></i><?php the_time();?></span>
																	</div>
																	<?php the_excerpt();?>
																	<div class="button">
																		<a href="<?php the_permalink();?>" class="btn"><?php esc_html_e('Read More','yala-mag');?></a>
																	</div>
																</div>
															</div>
															<!--/ End Single News -->
															<?php
														endif;
														$count = $count + 1;
													endwhile;
													wp_reset_postdata();
													?>
												</div>
												<div class="col-lg-4 col-12">
													<!-- Tab other news -->
													<div class="tab-small-news">
														<h3><?php echo esc_html($title);?></h3>
														<?php
														$count = 0;
														while( $query3->have_posts() ) :
															$query3->the_post();
															if( $count > 0 ) :?>
																<!-- Single News -->
																<div class="single-news">
																	<!-- News Head -->
																	<?php 
																	if(has_post_thumbnail()):?>
																		<div class="news-head">
																			<?php the_post_thumbnail('yala-mag-50_50');?>
																		</div>
																	<?php endif;
																	?>
																	<!-- Content -->
																	<div class="content">
																		<h4 class="title-small"><a href="<?php the_permalink();?>"><?php the_title();?></a></h4>
																	</div>
																</div>
																<!--/ End Single News -->
																<?php
															endif;
															$count = $count + 1;
														endwhile;
														wp_reset_postdata();
														?>
													</div>
													<!--/ End tab other news -->
												</div>
											</div>
										</div>
									<?php endif;?>
									<!--/ End Single Tab 3 -->

									<!-- Single Tab4 -->
									<?php
									$arg_4 = array(
										'cat'	=> absint( $cat_4 ),
										'posts_per_page' => absint( $post_no )
									);
									$query4 = new WP_Query( $arg_4 );
									if( $query4->have_posts() ) :
										?>
										<div class="tab-pane fade" id="<?php echo esc_attr( str_replace( ' ', '-', strtolower( get_cat_name( $cat_4 ) ) ) );?>_<?php echo esc_attr( $this->get_field_id( 'cat_4' ) )?>" role="tabpanel">
											<div class="row">
												<div class="col-lg-8 col-12">
													<!-- Single News -->
													<?php
													$count = 0;
													while( $query4->have_posts() ) :
														$query4->the_post();
														if( $count == 0 ) :
															?>
															<div class="tab-big-news">
																<!-- News Head -->
																<?php 
																if(has_post_thumbnail()):?>
																	<?php the_post_thumbnail('yala-mag-690_460');?>
																<?php endif;
																?>
																<div class="content">
																	<h2 class="title-big"><a href="<?php the_permalink();?>"><?php the_title();?></a></h2>
																	<div class="meta">
																	
																		<span class="date"><i class="fa fa-clock-o"></i><?php yala_mag_posted_on();?></span>
																		<span class="date"><i class="fa fa-clock-o"></i><?php the_time();?></span>
																	</div>
																	<?php the_excerpt();?>
																	<div class="button">
																		<a href="<?php the_permalink();?>" class="btn"><?php esc_html_e('Read More','yala-mag');?></a>
																	</div>
																</div>
															</div>
															<!--/ End Single News -->
															<?php
														endif;
														$count = $count + 1;
													endwhile;
													wp_reset_postdata();
													?>
												</div>
												<div class="col-lg-4 col-12">
													<!-- Tab other news -->
													<div class="tab-small-news">
														<h3><?php echo esc_html($title);?></h3>
														<?php
														$count = 0;
														while( $query4->have_posts() ) :
															$query4->the_post();
															if( $count > 0 ) :?>
																<!-- Single News -->
																<div class="single-news">
																	<!-- News Head -->
																	<?php 
																	if(has_post_thumbnail()):?>
																		<div class="news-head">
																			<?php the_post_thumbnail('yala-mag-50_50');?>
																		</div>
																	<?php endif;
																	?>
																	<!-- Content -->
																	<div class="content">
																		<h4 class="title-small"><a href="<?php the_permalink();?>"><?php the_title();?></a></h4>
																	</div>
																</div>
																<!--/ End Single News -->
																<?php
															endif;
															$count = $count + 1;
														endwhile;
														wp_reset_postdata();
														?>
													</div>
													<!--/ End tab other news -->
												</div>
											</div>
										</div>
									<?php endif;?>
									<!--/ End Single Tab 4 -->

																		<!-- Single Tab5 -->
									<?php
									$arg_5 = array(
										'cat'	=> absint( $cat_5 ),
										'posts_per_page' => absint( $post_no )
									);
									$query5 = new WP_Query( $arg_5 );
									if( $query5->have_posts() ) :
										?>
										<div class="tab-pane fade" id="<?php echo esc_attr( str_replace( ' ', '-', strtolower( get_cat_name( $cat_5 ) ) ) );?>_<?php echo esc_attr( $this->get_field_id( 'cat_5' ) )?>" role="tabpanel">
											<div class="row">
												<div class="col-lg-8 col-12">
													<!-- Single News -->
													<?php
													$count = 0;
													while( $query5->have_posts() ) :
														$query5->the_post();
														if( $count == 0 ) :
															?>
															<div class="tab-big-news">
																<!-- News Head -->
																<?php 
																if(has_post_thumbnail()):?>
																	<?php the_post_thumbnail('yala-mag-690_460');?>
																<?php endif;
																?>
																<div class="content">
																	<h2 class="title-big"><a href="<?php the_permalink();?>"><?php the_title();?></a></h2>
																	<div class="meta">
																	
																		<span class="date"><i class="fa fa-clock-o"></i><?php yala_mag_posted_on();?></span>
																		<span class="date"><i class="fa fa-clock-o"></i><?php the_time();?></span>
																	</div>
																	<?php the_excerpt();?>
																	<div class="button">
																		<a href="<?php the_permalink();?>" class="btn"><?php esc_html_e('Read More','yala-mag');?></a>
																	</div>
																</div>
															</div>
															<!--/ End Single News -->
															<?php
														endif;
														$count = $count + 1;
													endwhile;
													wp_reset_postdata();
													?>
												</div>
												<div class="col-lg-4 col-12">
													<!-- Tab other news -->
													<div class="tab-small-news">
														<h3><?php echo esc_html($title);?></h3>
														<?php
														$count = 0;
														while( $query5->have_posts() ) :
															$query5->the_post();
															if( $count > 0 ) :?>
																<!-- Single News -->
																<div class="single-news">
																	<!-- News Head -->
																	<?php 
																	if(has_post_thumbnail()):?>
																		<div class="news-head">
																			<?php the_post_thumbnail('yala-mag-50_50');?>
																		</div>
																	<?php endif;
																	?>
																	<!-- Content -->
																	<div class="content">
																		<h4 class="title-small"><a href="<?php the_permalink();?>"><?php the_title();?></a></h4>
																	</div>
																</div>
																<!--/ End Single News -->
																<?php
															endif;
															$count = $count + 1;
														endwhile;
														wp_reset_postdata();
														?>
													</div>
													<!--/ End tab other news -->
												</div>
											</div>
										</div>
									<?php endif;?>
									<!--/ End Single Tab 5 -->

																		<!-- Single Tab6 -->
									<?php
									$arg_6 = array(
										'cat'	=> absint( $cat_6 ),
										'posts_per_page' => absint( $post_no )
									);
									$query6 = new WP_Query( $arg_6 );
									if( $query6->have_posts() ) :
										?>
										<div class="tab-pane fade" id="<?php echo esc_attr( str_replace( ' ', '-', strtolower( get_cat_name( $cat_6 ) ) ) );?>_<?php echo esc_attr( $this->get_field_id( 'cat_6' ) )?>" role="tabpanel">
											<div class="row">
												<div class="col-lg-8 col-12">
													<!-- Single News -->
													<?php
													$count = 0;
													while( $query6->have_posts() ) :
														$query6->the_post();
														if( $count == 0 ) :
															?>
															<div class="tab-big-news">
																<!-- News Head -->
																<?php 
																if(has_post_thumbnail()):?>
																	<?php the_post_thumbnail('yala-mag-690_460');?>
																<?php endif;
																?>
																<div class="content">
																	<h2 class="title-big"><a href="<?php the_permalink();?>"><?php the_title();?></a></h2>
																	<div class="meta">
																	
																		<span class="date"><i class="fa fa-clock-o"></i><?php yala_mag_posted_on();?></span>
																		<span class="date"><i class="fa fa-clock-o"></i><?php the_time();?></span>
																	</div>
																	<?php the_excerpt();?>
																	<div class="button">
																		<a href="<?php the_permalink();?>" class="btn"><?php esc_html_e('Read More','yala-mag');?></a>
																	</div>
																</div>
															</div>
															<!--/ End Single News -->
															<?php
														endif;
														$count = $count + 1;
													endwhile;
													wp_reset_postdata();
													?>
												</div>
												<div class="col-lg-4 col-12">
													<!-- Tab other news -->
													<div class="tab-small-news">
														<h3><?php echo esc_html($title);?></h3>
														<?php
														$count = 0;
														while( $query6->have_posts() ) :
															$query6->the_post();
															if( $count > 0 ) :?>
																<!-- Single News -->
																<div class="single-news">
																	<!-- News Head -->
																	<?php 
																	if(has_post_thumbnail()):?>
																		<div class="news-head">
																			<?php the_post_thumbnail('yala-mag-50_50');?>
																		</div>
																	<?php endif;
																	?>
																	<!-- Content -->
																	<div class="content">
																		<h4 class="title-small"><a href="<?php the_permalink();?>"><?php the_title();?></a></h4>
																	</div>
																</div>
																<!--/ End Single News -->
																<?php
															endif;
															$count = $count + 1;
														endwhile;
														wp_reset_postdata();
														?>
													</div>
													<!--/ End tab other news -->
												</div>
											</div>
										</div>
									<?php endif;?>
									<!--/ End Single Tab 6 -->
								</div>
							</div>
						</div>
					</div>
				</div>
			</section>
			<?php
			endif;
			echo $args[ 'after_widget' ];
		}
	}
endif;


/*-----------------------------------------------------
	Front Post Yala Mag Layout Four Widgets
-----------------------------------------------------*/
if (!class_exists('Yala_Mag_Block_Layout_Four')) {
class Yala_Mag_Block_Layout_Four extends WP_Widget
{

    public function __construct(){
            $opts = array(
                'classname' => 'yala_mag_block_layout_four',
                'description'   => esc_html__( 'Yala Mag Block Layout Four. Place it within "Frontpage Layouts Area"', 'yala-mag' )
            );

            parent::__construct( 'yala-mag-block-layout-four', esc_html__( 'YM: Yala Mag Block Layout 4', 'yala-mag' ), $opts );
        }


    public function form( $instance )
    {
        $title = ! empty( $instance[ 'title' ] ) ? $instance[ 'title' ] : __('Layout 2','yala-mag');
        $cat = ! empty( $instance[ 'cat' ] ) ? $instance[ 'cat' ] : 0;
        $post_no = ! empty( $instance[ 'post_no' ] ) ? $instance[ 'post_no' ] : 3;
        $layout_enable = ! empty( $instance[ 'layout_enable' ] ) ? $instance[ 'layout_enable' ] : 'off';
        ?>

        <p>
            <input class="checkbox" type="checkbox" <?php checked( $layout_enable, 'on' ); ?> id="<?php echo esc_attr($this->get_field_id( 'layout_enable' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'layout_enable' ) ); ?>" /> 
            <label for="<?php echo esc_attr($this->get_field_id( 'layout_enable' )); ?>"><?php esc_html_e('Enable/Disable Yala Mag Block Layout 2', 'yala-mag'); ?></label>
            <br/>
        </p>

        <p>     
            <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><strong><?php echo esc_html__( 'Title: ', 'yala-mag' ); ?></strong></label>
            <input type="text" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" value="<?php echo esc_attr( $title ); ?>" class="widefat">
            <br/>   
        </p>
        
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'cat' ) )?>"><strong><?php echo esc_html__( 'Select Category:', 'yala-mag' ); ?></strong></label>
            <br>
            <?php
            $cat_args = array(
                'orderby'   => 'name',
                'hide_empty'    => 1,
                'show_count'    => 1,
                'hierarchical'  => 1,
                'id'    => $this->get_field_id( 'cat' ),
                'name'  => $this->get_field_name( 'cat' ),
                'class' => 'widefat',
                'taxonomy'  => 'category',
                'selected'  => absint( $cat ),
            );
            wp_dropdown_categories( $cat_args );
            ?>
        </p>

        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'post_no' ) )?>"><strong><?php echo esc_html__( 'Post No: ', 'yala-mag' )?></strong></label>
            <input type="number" id="<?php echo esc_attr( $this->get_field_id( 'post_no' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'post_no' ) ); ?>" value="<?php echo esc_attr( $post_no ); ?>" class="widefat">
        </p>
      <?php      
    }

    public function update($new_instance, $old_instance)
    {
        $instance = $old_instance;
        $instance[ 'title' ] = sanitize_text_field( $new_instance[ 'title' ] );
        $instance[ 'cat' ] = absint( $new_instance[ 'cat' ] );
        $instance[ 'post_no' ] = absint( $new_instance[ 'post_no' ] );
        $instance[ 'layout_enable' ] = $new_instance[ 'layout_enable' ];
        
        return $instance;
    }

    public function widget($args, $instance)
    {
        if (!empty($instance)) {
                $cat = ! empty( $instance[ 'cat' ] ) ? $instance[ 'cat' ] : 0;
                $title = apply_filters( 'widget_title', ! empty( $instance['title'] ) ? $instance['title'] : '', $instance, $this->id_base );
                $post_no = ! empty( $instance[ 'post_no' ] ) ? $instance[ 'post_no' ] : 3;
                
                $layout_enable_check = isset( $instance['layout_enable'] ) ? esc_attr( $instance['layout_enable'] ) : '';
                $layout_enable = $layout_enable_check ? 'true' : 'false';
                if($layout_enable =='true'):
                ?>
           <!-- Featured News -->
			<section class="news-carousel section">
				<div class="container">
					<div class="row">
						<div class="col-12">
							<h2 class="cat-title off-white"><span><?php echo esc_html($title);?></span></h2>
						</div>
					</div>
					<div class="row">
						<div class="col-12">
							<!-- Featured Slider -->
							<div class="carousel-slider">
								<?php
                                    $arguments = array(
                                        'cat'   => absint( $cat ),
                                        'posts_per_page' => absint( $post_no )
                                    );
                                    $query = new WP_Query( $arguments );
                                    if( $query->have_posts() ) :
                                        while( $query->have_posts() ) :
                                            $query->the_post();
                                        ?>
									<!-- Single News -->
									<div class="single-news">
										          <?php 
                                                    $categories = get_the_category(get_the_ID());
                                                ?>
											<?php 
												if(has_post_thumbnail()):?>
                                            <div class="news-head">
                                                        <div class="cat-name"><a href="<?php echo esc_url(get_category_link($categories[0]->term_id));?>" class="cat"><?php echo esc_html($categories[0]->name); ?></a></div>
											<?php	
                                                the_post_thumbnail('yala-mag-350_270');
                                            ?>
                                            </div>
											<?php 	endif;?>
											<h4 class="title-medium"><a href="<?php the_permalink();?>"><?php the_title();?></a></h4>
                                             <?php the_excerpt();?>   
                                                <a href="<?php the_permalink();?>" class="btn"><?php esc_html_e('Read More','yala-mag');?></a>
										</div>
									
									<!--/ End Single News -->
									<?php
                                        endwhile;
                                        wp_reset_postdata();
                                    endif; ?>       
							</div>
							<!--/ End Featured Slider -->
						</div>
					</div>
				</div>
			</section>
			<!-- End Featured News -->
            <?php
            endif;
        }
    }
    }
}