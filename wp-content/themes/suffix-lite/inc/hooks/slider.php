<?php
if (!function_exists('suffix_lite_banner_slider')) :
    /**
     * Banner Slider
     *
     * @since suffix 1.0.0
     *
     */
    function suffix_lite_banner_slider()
    {
        if (1 != suffix_lite_get_option('show_slider_section')) {
            return null;
        }
        $suffix_lite_slider_category = absint(suffix_lite_get_option('select_category_for_slider'));
        $suffix_lite_slider_number = absint(suffix_lite_get_option('main_slider_number'));
        $suffix_lite_slider_excerpt_number = absint(suffix_lite_get_option('number_of_content_home_slider'));
        ?>

        <div class="main-banner">
            <?php
            $suffix_lite_banner_slider_args = array(
                'post_type' => 'post',
                'cat' => absint($suffix_lite_slider_category),
                'ignore_sticky_posts' => true,
                'posts_per_page' => absint( $suffix_lite_slider_number ),
            ); ?>
            <?php 
            $suffix_lite_slider_layout = '';
            if (suffix_lite_get_option('slider_layout_option') == 'full-width') {
                $suffix_lite_slider_layout = 'mainbanner-jumbotron-fullwidth';
            } elseif (suffix_lite_get_option('slider_layout_option') == 'boxed') {
                $suffix_lite_slider_layout = 'mainbanner-jumbotron-boxed';
            }
            ?> 
            <?php 
                $suffix_lite_slider_style = '';
                if (suffix_lite_get_option('slider_style_option') == 'single-slider') {
                    $suffix_lite_slider_style = 'mainbanner-jumbotron-1';
                } elseif (suffix_lite_get_option('slider_style_option') == 'carousel-slider') {
                    $suffix_lite_slider_style = 'mainbanner-jumbotron-2';
                } elseif (suffix_lite_get_option('slider_style_option') == 'slider-text') {
                    $suffix_lite_slider_style = 'mainbanner-jumbotron-3';
                } elseif (suffix_lite_get_option('slider_style_option') == 'text-slider') {
                    $suffix_lite_slider_style = 'mainbanner-jumbotron-4';
                }
            ?>
            <!-- Slide -->
            <?php $rtl_class_c = 'false';
            if(is_rtl()){ 
                $rtl_class_c = 'true';
            }?>
            <div class="mainbanner-jumbotron <?php echo esc_attr($suffix_lite_slider_style); ?> <?php echo esc_attr($suffix_lite_slider_layout);?>" data-slick='{ "rtl": <?php echo($rtl_class_c); ?>, "dots":<?php if (1 == suffix_lite_get_option('show_slider_pagination')) { echo 'true,';}else{echo 'false,';} ?> "arrows":<?php if (1 == suffix_lite_get_option('show_slider_control')) {  echo 'true'; }else{echo 'false';} ?> }'>
                <?php
                $suffix_lite_banner_slider_post_query = new WP_Query($suffix_lite_banner_slider_args);
                if ($suffix_lite_banner_slider_post_query->have_posts()) :
                    while ($suffix_lite_banner_slider_post_query->have_posts()) : $suffix_lite_banner_slider_post_query->the_post();
                        if(has_post_thumbnail()){
                            $thumb = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'full' );
                            $url = $thumb['0'];
                        }
                        else{
                            $url = '';
                        }
                        global $post;
                        $author_id = $post->post_author;
                        ?>
                            <figure class="slick-item">
                                <div class="data-bg data-bg-slide" data-background="<?php echo esc_url($url); ?>"></div>
                                <figcaption class="slider-figcaption">
                                    <div class="slider-figcaption-wrapper">
                                        <div class="item-metadata twp-meta-categories twp-meta-categories-bg">
                                            <?php suffix_lite_entry_category(); ?>
                                        </div>
                                        <h2 class="slide-title">
                                            <a href="<?php the_permalink(); ?>">
                                                <?php the_title(); ?>
                                            </a>
                                        </h2>
                                        <?php if (1 == suffix_lite_get_option('show_slider_post_meta')) { ?>
                                            <div class="post-meta">
                                                <span>
                                                    <?php echo esc_html__('Posted on: ', 'suffix-lite'); ?><?php the_time('F j, Y'); ?>
                                                </span>
                                            </div>
                                        <?php } ?>
                                        <?php if (1 == suffix_lite_get_option('show_slider_content')) { ?>
                                            <div class="slide-details">
                                                <?php if (has_excerpt()) {
                                                    $suffix_lite_slider_content = get_the_excerpt();
                                                } else {
                                                    $suffix_lite_slider_content = suffix_lite_words_count($suffix_lite_slider_excerpt_number, get_the_content());
                                                } 
                                                echo esc_html($suffix_lite_slider_content);?>
                                            </div>
                                        <?php } ?>
                                    </div>
                                </figcaption>
                            </figure>
                        <?php
                        endwhile;
                endif;
                wp_reset_postdata();
                ?>
            </div>
        </div>
        <?php
    }
endif;
add_action('suffix_lite_action_front_page', 'suffix_lite_banner_slider', 40);
