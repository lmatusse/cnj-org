<?php
if (!function_exists('suffix_lite_featured_news')) :
    /**
     * Banner Slider
     *
     * @since suffix 1.0.0
     *
     */
    function suffix_lite_featured_news()
    {
        if (1 != suffix_lite_get_option('show_featured_news_section')) {
            return null;
        }
        $suffix_lite_featured_news_category = esc_attr(suffix_lite_get_option('select_category_for_featured_news'));
        $suffix_lite_featured_news_title = esc_html(suffix_lite_get_option('featured_news_title'));
        $suffix_lite_featured_news_number = 4;
        ?>
        <div class="featured-block">
            <div class="suffix-lite-wrapper-fluid">
                <div class="grid-row">
                    <?php if (!empty($suffix_lite_featured_news_title)) { ?>
                        <div class="column column-full">
                            <h2 class="block-title">
                                <?php echo esc_html($suffix_lite_featured_news_title); ?>
                            </h2>
                        </div>
                    <?php } ?>
                    <?php
                    $suffix_lite_featured_news_args = array(
                        'post_type' => 'post',
                        'cat' => absint($suffix_lite_featured_news_category),
                        'ignore_sticky_posts' => true,
                        'posts_per_page' => absint($suffix_lite_featured_news_number),
                    ); ?>
                    <?php $suffix_lite_featured_news_post_query = new WP_Query($suffix_lite_featured_news_args);
                    if ($suffix_lite_featured_news_post_query->have_posts()) :
                        while ($suffix_lite_featured_news_post_query->have_posts()) : $suffix_lite_featured_news_post_query->the_post();
                            if (has_post_thumbnail()) {
                                $suffix_lite_featured_post_image_option  = suffix_lite_get_option('featured_post_image_option');
                                $thumb = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), $suffix_lite_featured_post_image_option);
                                $url = $thumb['0'];
                            }
                            ?>
                            <div class="column column-quarter">
                                <div class="column-post">
                                    <?php if (has_post_thumbnail()) { ?>
                                        <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" class="bg-image bg-image-featured">
                                            <img src="<?php echo esc_url($url); ?>">
                                        </a>
                                    <?php } ?>
                                    <div class="article-detail">
                                        <h3 class="small-title">
                                            <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                                                <?php the_title(); ?>
                                            </a>
                                        </h3>
                                        <?php if (1 == suffix_lite_get_option('show_post_meta_featured_news')) { ?>
                                        <div class="post-meta">
                                            <span class="posted-on">
                                                    <?php echo get_the_date('F j, Y'); ?>
                                            </span>
                                        </div>
                                    <?php } ?>
                                    </div>
                                </div>
                            </div>
                        <?php endwhile;
                    endif;
                    wp_reset_postdata();
                    ?>
                </div>
            </div>
        </div>
        <?php
    }
endif;
add_action('suffix_lite_action_front_page', 'suffix_lite_featured_news', 50);
