<?php
if (!function_exists('suffix_lite_breaking_news_news')) :
    /**
     * Banner Slider
     *
     * @since suffix 1.0.0
     *
     */
    function suffix_lite_breaking_news_news()
    {
        if (1 != suffix_lite_get_option('show_breaking_news_section')) {
            return null;
        }
        $suffix_lite_breaking_news_news_category = esc_attr(suffix_lite_get_option('select_category_for_breaking_news'));
        $suffix_lite_breaking_news_news_title = wp_kses_post(suffix_lite_get_option('breaking_news_title'));
        ?>
        <div class="breaking-block">
            <div class="suffix-lite-wrapper">
                <div class="grid-row twp-equal">
                    <div class="column column-one">
                        <h3 class="breaking-title"><?php echo wp_kses_post($suffix_lite_breaking_news_news_title); ?></h3>
                    </div>

                    <div class="column column-nine">
                        <div class="grid-row">
                            <?php
                            $suffix_lite_breaking_news_news_args = array(
                                'post_type' => 'post',
                                'cat' => absint($suffix_lite_breaking_news_news_category),
                                'ignore_sticky_posts' => true,
                                'posts_per_page' => 3,
                            ); ?>
                            <?php $suffix_lite_breaking_news_news_post_query = new WP_Query($suffix_lite_breaking_news_news_args);
                            if ($suffix_lite_breaking_news_news_post_query->have_posts()) :
                                while ($suffix_lite_breaking_news_news_post_query->have_posts()) : $suffix_lite_breaking_news_news_post_query->the_post();
                                    if (has_post_thumbnail()) {
                                        $thumb = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'thumbnail');
                                        $url = $thumb['0'];
                                    }
                                    ?>
                                    <div class="column column-three">
                                        <div class="featured-wrapper">
                                            <?php if (has_post_thumbnail()) { ?>
                                                <div class="post-image">
                                                    <a class="article-item-image" href="<?php the_permalink(); ?>">
                                                        <img src="<?php echo esc_url($url); ?>">
                                                    </a>
                                                </div>
                                            <?php } ?>
                                            <div class="post-content">
                                                <div class="item-metadata twp-meta-categories twp-meta-categories-color">
                                                    <?php suffix_lite_entry_breaking_category(); ?>
                                                </div>
                                                <h3 class="small-title">
                                                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                                </h3>
                                                <?php if (1 == suffix_lite_get_option('show_breaking_news_meta_data')){ ?>
                                                <div class="post-meta">
                                                    <span>
                                                        <?php echo esc_html__('Posted on: ', 'suffix-lite'); ?><?php the_time('F j, Y'); ?>
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
            </div>
        </div>
        <?php
    }
endif;
add_action('suffix_lite_action_breaking_news_section', 'suffix_lite_breaking_news_news', 50);
