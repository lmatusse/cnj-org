<?php

/**
 * Widget - Footer About Widget
 *
 * @package Yala_Mag
 */


/*-----------------------------------------------------
        Footer About Widgets
        -----------------------------------------------------*/
        if (!class_exists('Yala_Mag_Footer_About_Widget')) {
            class Yala_Mag_Footer_About_Widget extends WP_Widget
            {


                
                public function __construct()
                {
                    parent::__construct(
                        'yala_mag_about_widget',
                        esc_html__('YM : Footer About', 'yala-mag'),
                        array('description' => esc_html__('Footer About widgets. Place it within "Footer widget Area"', 'yala-mag'))
                    );
                }

                public function form( $instance )
                {
                    $title          = ! empty( $instance[ 'title' ] ) ? $instance[ 'title' ] : esc_html_e('Welcome To ','yala-mag').bloginfo( 'name' );
                    $description    = ! empty( $instance[ 'description' ] ) ? $instance[ 'description' ] : '';

                    $facebook_url   = ! empty( $instance[ 'facebook_url' ] ) ?  $instance[ 'facebook_url' ] : '';
                    $twitter_url   = ! empty( $instance[ 'twitter_url' ] ) ?  $instance[ 'twitter_url' ] : '';
                    $linkedin_url   = ! empty( $instance[ 'linkedin_url' ] ) ?  $instance[ 'linkedin_url' ] : '';
                    $pinterest_url   = ! empty( $instance[ 'pinterest_url' ] ) ?  $instance[ 'pinterest_url' ] : '';
                    $youtube_url   = ! empty( $instance[ 'youtube_url' ] ) ?  $instance[ 'youtube_url' ] : '';

                    $layout_enable  = ! empty( $instance[ 'layout_enable' ] ) ? $instance[ 'layout_enable' ] : 'off';
                    ?>
                    <p>
                     <input class="checkbox" type="checkbox" <?php checked( $layout_enable, 'on' ); ?> id="<?php echo esc_attr($this->get_field_id( 'layout_enable' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'layout_enable' ) ); ?>" /> 
                     <label for="<?php echo esc_attr($this->get_field_id( 'layout_enable' )); ?>"><?php esc_html_e('Enable/Disable Footer About Section', 'yala-mag'); ?></label> 
                 </p>

                 <p>
                    <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><strong><?php echo esc_html__( 'Title: ', 'yala-mag' ); ?></strong></label>
                    <input type="text" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" value="<?php echo esc_attr( $title ); ?>" class="widefat">
                </p>

                  <p>
                    <label for="<?php echo esc_attr( $this->get_field_id( 'description' ) ); ?>"><strong><?php echo esc_html__( 'Description: ', 'yala-mag' ); ?></strong></label>
                    <input type="text" id="<?php echo esc_attr( $this->get_field_id( 'description' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'description' ) ); ?>" value="<?php echo esc_attr( $description ); ?>" class="widefat">
                </p>

                <p>
                    <label for="<?php echo esc_attr( $this->get_field_id( 'facebook_url' ) ); ?>"><strong><?php echo esc_html__( 'Facebook Url: ', 'yala-mag' ); ?></strong></label>
                    <input type="text" id="<?php echo esc_attr( $this->get_field_id( 'facebook_url' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'facebook_url' ) ); ?>" value="<?php echo esc_url( $facebook_url ); ?>" class="widefat">
                </p>


                <p>
                    <label for="<?php echo esc_attr( $this->get_field_id( 'twitter_url' ) ); ?>"><strong><?php echo esc_html__( 'Twitter Url: ', 'yala-mag' ); ?></strong></label>
                    <input type="text" id="<?php echo esc_attr( $this->get_field_id( 'twitter_url' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'twitter_url' ) ); ?>" value="<?php echo esc_url( $twitter_url ); ?>" class="widefat">
                </p>


                <p>
                    <label for="<?php echo esc_attr( $this->get_field_id( 'linkedin_url' ) ); ?>"><strong><?php echo esc_html__( 'Linkedin Url: ', 'yala-mag' ); ?></strong></label>
                    <input type="text" id="<?php echo esc_attr( $this->get_field_id( 'linkedin_url' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'linkedin_url' ) ); ?>" value="<?php echo esc_url( $linkedin_url ); ?>" class="widefat">

                </p>
                <p>
                    <label for="<?php echo esc_attr( $this->get_field_id( 'pinterest_url' ) ); ?>"><strong><?php echo esc_html__( 'Pinterest Url: ', 'yala-mag' ); ?></strong></label>
                    <input type="text" id="<?php echo esc_attr( $this->get_field_id( 'pinterest_url' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'pinterest_url' ) ); ?>" value="<?php echo esc_url( $pinterest_url ); ?>" class="widefat">
                </p>

                <p>
                    <label for="<?php echo esc_attr( $this->get_field_id( 'youtube_url' ) ); ?>"><strong><?php echo esc_html__( 'Youtube Url: ', 'yala-mag' ); ?></strong></label>
                    <input type="text" id="<?php echo esc_attr( $this->get_field_id( 'youtube_url' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'youtube_url' ) ); ?>" value="<?php echo esc_url( $youtube_url ); ?>" class="widefat">
                </p>
                
                <?php
            }

            public function update($new_instance, $old_instance)
            {
                $instance = $old_instance;
                $instance[ 'layout_enable' ] = $new_instance[ 'layout_enable' ];
                $instance[ 'title' ] = sanitize_text_field( $new_instance[ 'title' ] );
                $instance[ 'description' ] = sanitize_text_field( $new_instance[ 'description' ] );
                $instance[ 'facebook_url' ] = esc_url_raw( $new_instance[ 'facebook_url' ] );
                $instance[ 'twitter_url' ] = esc_url_raw( $new_instance[ 'twitter_url' ] );
                $instance[ 'linkedin_url' ] = esc_url_raw( $new_instance[ 'linkedin_url' ] );
                $instance[ 'pinterest_url' ] = esc_url_raw( $new_instance[ 'pinterest_url' ] );
                $instance[ 'youtube_url' ] = esc_url_raw( $new_instance[ 'youtube_url' ] );
                return $instance;
            }

            public function widget($args, $instance)
            {
                if (!empty($instance)) {
                    $layout_enable_check = isset( $instance['layout_enable'] ) ? esc_attr( $instance['layout_enable'] ) : '';
                    $layout_enable = $layout_enable_check ? 'true' : 'false';
                    $title = apply_filters( 'widget_title', ! empty( $instance['title'] ) ? $instance['title'] : '', $instance, $this->id_base );
                    $description = ! empty( $instance[ 'description' ] ) ? $instance[ 'description' ] : '';
                    
                    $facebook_url   = ! empty( $instance[ 'facebook_url' ] ) ?  $instance[ 'facebook_url' ] : '';
                    $twitter_url   = ! empty( $instance[ 'twitter_url' ] ) ?  $instance[ 'twitter_url' ] : '';
                    $linkedin_url   = ! empty( $instance[ 'linkedin_url' ] ) ?  $instance[ 'linkedin_url' ] : '';
                    $pinterest_url   = ! empty( $instance[ 'pinterest_url' ] ) ?  $instance[ 'pinterest_url' ] : '';
                    $youtube_url   = ! empty( $instance[ 'youtube_url' ] ) ?  $instance[ 'youtube_url' ] : '';


                    if($layout_enable =='true'):
                        echo $args[ 'before_widget' ];
                        ?>
                        <!-- Single Widget -->
                        <div class="single-footer f-about">
                           <?php  
                           echo $args[ 'before_title' ];
                           echo esc_html( $title );
                           echo $args[ 'after_title' ];?>
                           <p class="text"><?php echo esc_html($description);?></p>
                           <ul class="social">
                            <?php if($facebook_url != ''):?>
                                <li class="facebook"><a href="<?php echo esc_url($facebook_url);?>"><i class="fa fa-facebook-f"></i></a></li>
                            <?php endif;?>
                            <?php if($twitter_url != ''):?>
                                <li class="twitter"><a href="<?php echo esc_url($twitter_url);?>"><i class="fa fa-twitter"></i></a></li>
                            <?php endif;?>
                            <?php if($youtube_url != ''):?>
                                <li class="youtube"><a href="<?php echo esc_url($youtube_url);?>"><i class="fa fa-youtube"></i></a></li>
                            <?php endif;?>
                            <?php if($pinterest_url != ''):?>
                                <li class="pinterest"><a href="<?php echo esc_url($pinterest_url);?>"><i class="fa fa-pinterest"></i></a></li>
                            <?php endif;?>
                            <?php if($linkedin_url != ''):?>
                                <li class="linkedin"><a href="<?php echo esc_url($linkedin_url);?>"><i class="fa fa-linkedin"></i></a></li>
                            <?php endif;?>
                        </ul>
                    </div>
                    <!--/ End Single Widget -->
                    <?php
                    echo $args[ 'after_widget' ];
                endif;
            }
        }

    }
}

    /**
 * Widget - Footer Latest News
 *
 * @package Yala_Mag
 */


/*-----------------------------------------------------
        Footer Latest News Widgets
        -----------------------------------------------------*/

        if ( ! class_exists( 'Yala_Mag_Footer_Latest_News' ) ) :
    /**
    * NFooter Latest News Widgets
    */
    class Yala_Mag_Footer_Latest_News extends WP_Widget
    {

        function __construct()
        {
            $opts = array(
                'classname' => 'block-layout-a',
                'description'   => esc_html__( 'Footer Latest News widgets. Place it within "Footer widget Area"', 'yala-mag' )
            );

            parent::__construct( 'footer-latest-news', esc_html__( 'YM : Footer Latest News', 'yala-mag' ), $opts );
        }
        function form( $instance ) {

            $title = ! empty( $instance[ 'title' ] ) ? $instance[ 'title' ] : 'Latest News';
            $post_no = ! empty( $instance[ 'post_no' ] ) ? $instance[ 'post_no' ] : 3;
            $date_enable = ! empty( $instance[ 'date_enable' ] ) ? $instance[ 'date_enable' ] : 'off';
            ?>
            <p>
                <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><strong><?php echo esc_html__( 'Title: ', 'yala-mag' ); ?></strong></label>
                <input type="text" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" value="<?php echo esc_attr( $title ); ?>" class="widefat">
                <br/>
                <input class="checkbox" type="checkbox" <?php checked( $date_enable, 'on' ); ?> id="<?php echo esc_attr($this->get_field_id( 'date_enable' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'date_enable' ) ); ?>" /> 
                <label for="<?php echo esc_attr($this->get_field_id( 'date_enable' )); ?>"><?php esc_html_e('Enable/Disable date to show', 'yala-mag'); ?></label>
                <br/>
            </p>

            <p>
                <label for="<?php echo esc_attr( $this->get_field_id( 'post_no' ) )?>"><strong><?php echo esc_html__( 'Post No: ', 'yala-mag' )?></strong></label>
                <input type="number" id="<?php echo esc_attr( $this->get_field_id( 'post_no' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'post_no' ) ); ?>" value="<?php echo esc_attr( $post_no ); ?>" class="widefat">
            </p>
            <?php
        }
        function update( $new_instance, $old_instance ) {
            $instance = $old_instance;

            $instance[ 'title' ] = sanitize_text_field( $new_instance[ 'title' ] );
            $instance[ 'post_no' ] = absint( $new_instance[ 'post_no' ] );
            $instance[ 'date_enable' ] = $new_instance[ 'date_enable' ];

            return $instance;
        }
        function widget( $args, $instance ) {
            $title = apply_filters( 'widget_title', ! empty( $instance['title'] ) ? $instance['title'] : '', $instance, $this->id_base );
            $post_no = ! empty( $instance[ 'post_no' ] ) ? $instance[ 'post_no' ] : 3;
            $date_enable_check = isset( $instance['date_enable'] ) ? esc_attr( $instance['date_enable'] ) : '';
            $date_enable = $date_enable_check ? 'true' : 'false';
            echo $args[ 'before_widget' ];
            ?>
            <div class="single-footer latest-news">
                <?php
                echo $args[ 'before_title' ];
                echo esc_html( $title );
                echo $args[ 'after_title' ];
                $the_query = new WP_Query('showposts='.$post_no.'&orderby=post_date&order=desc');
                while ($the_query->have_posts()) : $the_query->the_post(); 
                    ?>
                    <div class="single-news">
                        <div class="image-thumb">
                            <?php 
                            if( has_post_thumbnail() ) :
                                the_post_thumbnail('yala-mag-101_80');
                            endif;
                            ?>
                        </div>
                        <?php 
                        $categories = get_the_category(get_the_ID());
                        ?>
                        <a href="<?php echo esc_url(get_category_link($categories[0]->term_id));?>" class="cat"><?php echo esc_html($categories[0]->name); ?></a>
                        <h4><a href="<?php the_permalink();?>"><?php the_title();?></a></h4>
                        <span class="date">
                            <?php if($date_enable =='true'): ?>
                                <i class="fa fa-clock-o"></i>
                                <?php yala_mag_posted_on();?>
                            <?php endif;
                            ?>
                        </span>
                    </div>
                    <?php
                endwhile; ?>
            </div>
            <?php
            echo $args[ 'after_widget' ];
        }
    }
endif;

/**
 * Widget - Footer Menu
 *
 * @package Yala_Mag
 */
/*-----------------------------------------------------
        Footer Menu Widgets
        -----------------------------------------------------*/

        if (!class_exists('Yala_Mag_Footer_Menu_Widget')) {
            class Yala_Mag_Footer_Menu_Widget extends WP_Widget
            {
                public function __construct()
                {
                    parent::__construct( 'yala_mag_menu_widget', esc_html__('YM : Footer Menu', 'yala-mag'), array('description' => esc_html__('Footer Menu widgets. Place it within "Footer widget Area"', 'yala-mag'))
                );
                }

                public function form( $instance )
                {
                    $title = esc_attr( $instance['title'] );
                    ?>
                    <p>
                        <label for="<?php echo esc_attr($this->get_field_id('title')); ?>">
                            <?php esc_html_e('Title', 'yala-mag'); ?>
                        </label><br/>
                        <input type="text" name="<?php echo esc_attr( $this->get_field_name('title') ); ?>" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title') ); ?>" value="<?php echo $title; ?>">
                    </p>
                    <?php
                }

                public function update($new_instance, $old_instance)
                {
                    $instance = $old_instance;
                    $instance['title'] = sanitize_text_field($new_instance['title']);

                    return $instance;
                }

                public function widget($args, $instance)
                {
                    if (!empty($instance)) {
                        $title = apply_filters('widget_title', !empty($instance['title']) ? esc_html($instance['title']) : '', $instance, $this->id_base);
                        echo $args[ 'before_widget' ];
                        ?>
                        <div class="single-footer category">
                            <?php
                            echo $args[ 'before_title' ];
                            echo esc_html( $title );
                            echo $args[ 'after_title' ];
                            
                            if ( has_nav_menu( 'footer-menu' ) ) :
                                wp_nav_menu( array(
                                  'theme_location'    => 'footer-menu',
                                  'depth'             => 1,
                                  'container'         => 'ul',
                                  'walker'            => new yala_mag_navwalker(),
                              ));
                            endif;
                            ?>
                        </div>
                        
                        <?php
                        echo $args[ 'after_widget' ];
                    }
                }

            }
        }