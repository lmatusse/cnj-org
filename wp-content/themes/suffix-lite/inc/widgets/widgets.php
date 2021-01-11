<?php
/**
 * Theme widgets.
 *
 * @package Suffix
 */
// Load widget base.
require_once get_template_directory() . '/inc/widgets/widget-base-class.php';
if (!function_exists('suffix_lite_load_widgets')) :
    /**
     * Load widgets.
     *
     * @since 1.0.0
     */
    function suffix_lite_load_widgets()
    {
        // suffix_lite_Grid_Panel widget.
        register_widget('Suffix_Lite_Widget_Style_1');
        // list panel widget.
        register_widget('Suffix_Lite_Widget_Style_2');
        // style 3
        register_widget('Suffix_Lite_Widget_Style_3');
        //list widget
        register_widget('Suffix_Lite_Widget_List');
        // Recent Post widget.
        register_widget('Suffix_Lite_Sidebar_Widget');

        // Carousel widget.
        register_widget('Suffix_Lite_Carousel_Post_Widget');

        // Auther widget.
        register_widget('Suffix_Lite_Author_Post_Widget');
        // Tabbed widget.
        register_widget('Suffix_Lite_Tabbed_Widget');
        register_widget('Suffix_Lite_Widget_Social');
        register_widget('Suffix_Lite_Widget_Slider');

    }
endif;
add_action('widgets_init', 'suffix_lite_load_widgets');
/*Grid Panel single cat widget*/
if (!class_exists('Suffix_Lite_Widget_Style_1')) :
    /**
     * Latest news widget Class.
     *
     * @since 1.0.0
     */
    class Suffix_Lite_Widget_Style_1 extends Suffix_Lite_Widget_Base
    {
        /**
         * Sets up a new widget instance.
         *
         * @since 1.0.0
         */
        function __construct()
        {
            $opts = array(
                'classname' => 'suffix_lite_grid_panel_widget',
                'description' => __('Displays posts from selected category.', 'suffix-lite'),
                'customize_selective_refresh' => true,
            );
            $fields = array(
                'title' => array(
                    'label' => __('Title:', 'suffix-lite'),
                    'type' => 'text',
                    'class' => 'widefat',
                ),
                'post_category' => array(
                    'label' => __('Select Category:', 'suffix-lite'),
                    'type' => 'dropdown-taxonomies',
                    'show_option_all' => __('All Categories', 'suffix-lite'),
                ),
                'enable_meta' => array(
                    'label' => __('Enable Post Meta', 'suffix-lite'),
                    'type' => 'checkbox',
                    'default' => true,
                ),
                'select_image_size' => array(
                    'label' => __('Select Image Size Featured Post:', 'suffix-lite'),
                    'type' => 'select',
                    'default' => 'suffix-lite-400-260',
                    'options' => array(
                        'thumbnail' => esc_html__( 'Thumbnail', 'suffix-lite' ),
                        'medium' => esc_html__( 'Medium', 'suffix-lite' ),
                        'medium_large' => esc_html__( 'Medium Large', 'suffix-lite' ),
                        'large' => esc_html__( 'Large', 'suffix-lite' ),
                        'full' => esc_html__( 'Full', 'suffix-lite' ),
                        'suffix-lite-400-260'    => esc_html__( 'Image 400 x 260', 'suffix-lite' ),
                        'suffix-lite-900-600'    => esc_html__( 'Image 900 x 600', 'suffix-lite' ),
                        ),
                    
                ),
                'excerpt_length_featured' => array(
                    'label' => __('Excerpt Length For Featured Post:', 'suffix-lite'),
                    'description' => __('Number of words', 'suffix-lite'),
                    'type' => 'number',
                    'css' => 'max-width:60px;',
                    'default' => 50,
                    'min' => 0,
                    'max' => 200,
                ),
                'select_image_size_2' => array(
                    'label' => __('Select Image Size Other Post:', 'suffix-lite'),
                    'type' => 'select',
                    'default' => 'suffix-lite-400-260',
                    'options' => array(
                        'thumbnail' => esc_html__( 'Thumbnail', 'suffix-lite' ),
                        'medium' => esc_html__( 'Medium', 'suffix-lite' ),
                        'medium_large' => esc_html__( 'Medium Large', 'suffix-lite' ),
                        'large' => esc_html__( 'Large', 'suffix-lite' ),
                        'full' => esc_html__( 'Full', 'suffix-lite' ),
                        'suffix-lite-400-260'    => esc_html__( 'Image 400 x 260', 'suffix-lite' ),
                        'suffix-lite-725-480'    => esc_html__( 'Image 720 x 480', 'suffix-lite' ),
                        ),
                    
                ),
                'excerpt_length' => array(
                    'label' => __('Excerpt Length For List Post:', 'suffix-lite'),
                    'description' => __('Number of words', 'suffix-lite'),
                    'type' => 'number',
                    'css' => 'max-width:60px;',
                    'default' => 20,
                    'min' => 0,
                    'max' => 200,
                ),
                'post_number' => array(
                    'label' => __('Number of Posts:', 'suffix-lite'),
                    'type' => 'number',
                    'default' => 5,
                    'css' => 'max-width:60px;',
                    'min' => 1,
                    'max' => 10,
                ),
                'view_detail' => array(
                    'label' => __('View Detail Text:', 'suffix-lite'),
                    'type' => 'text',
                    'class' => 'widefat',
                ),
            );
            parent::__construct('suffix-lite-grid-layout', __('SFX: Single Category Widget', 'suffix-lite'), $opts, array(), $fields);
        }
        /**
         * Outputs the content for the current widget instance.
         *
         * @since 1.0.0
         *
         * @param array $args Display arguments.
         * @param array $instance Settings for the current widget instance.
         */
        function widget($args, $instance)
        {
            $params = $this->get_params($instance);
            echo $args['before_widget'];
            $qargs = array(
                'posts_per_page' => absint($params['post_number']),
                'no_found_rows' => true,
            );
            if (absint($params['post_category']) > 0) {
                $qargs['category'] = absint($params['post_category']);
            }
            $all_posts = get_posts($qargs);
            ?>
            <?php if (!empty($all_posts)) : ?>
            <?php global $post;
            $author_id = $post->post_author;
            $i = 1;
            ?>
            <div class="suffix-lite-widget suffix-lite-widget-1">
                <?php if (!empty($params['title'])) {
                    echo $args['before_title'] . $params['title'] . $args['after_title'];
                } ?>
                <div class="widget-row">
                    <?php foreach ($all_posts as $key => $post) : ?>
                        <?php setup_postdata($post); ?>
                        <?php if ($i == 1) {
                            $feature_post = 'featured-post';
                        } else {
                            $feature_post = 'all-post';
                        } 
                        $select_image_size = esc_attr($params['select_image_size']);
                        ?>
                        <div class="column column-half <?php echo esc_attr($feature_post); ?>">
                            <?php if ($i == 1) { ?>
                                <?php if (has_post_thumbnail()) { ?>
                                    <div class="post-image">
                                        <a class="twp-image-wrapper" href="<?php the_permalink(); ?>">
                                         <?php
                                            the_post_thumbnail($select_image_size, array(
                                                'alt' => the_title_attribute(array(
                                                    'echo' => false,
                                                )),
                                            ));
                                            ?>
                                        </a>
                                    </div>
                                <?php } ?>
                                <div class="post-content">
                                    <h3 class="small-title">
                                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?>
                                        </a>
                                    </h3>
                                    <?php if (true === $params['enable_meta']) { ?>
                                        <div class="post-meta">
                                            <span>
                                                <?php echo esc_html__('Posted on: ', 'suffix-lite'); ?><?php the_time('F j, Y'); ?>
                                            </span>
                                        </div>
                                    <?php } ?>
                                    <?php if ( ! is_active_sidebar( 'sidebar-home-2' ) ) { ?>
                                    <?php if (absint($params['excerpt_length_featured']) > 0) : ?>
                                        <div class="post-description">
                                            <?php
                                            $excerpt = suffix_lite_words_count(absint($params['excerpt_length_featured']), get_the_content());
                                            echo wp_kses_post(wpautop($excerpt));
                                            ?>
                                        </div>
                                    <?php endif; ?>
                                <?php } ?>
                                </div>
                                <?php if ( is_active_sidebar( 'sidebar-home-2' ) ) { ?>
                                    <?php if (absint($params['excerpt_length_featured']) > 0) : ?>
                                        <div class="post-description">
                                            <?php
                                            $excerpt = suffix_lite_words_count(absint($params['excerpt_length_featured']), get_the_content());
                                            echo wp_kses_post(wpautop($excerpt));
                                            ?>
                                        </div>
                                    <?php endif; ?>
                                <?php } ?>
                            <?php } else { ?>
                                <?php $select_image_size_2 = esc_attr($params['select_image_size_2']); ?>
                                
                                <?php if (has_post_thumbnail()) { ?>
                                    <div class="post-image">
                                        <a class="twp-image-wrapper" href="<?php the_permalink(); ?>">
                                            <?php
                                               the_post_thumbnail($select_image_size_2, array(
                                                   'alt' => the_title_attribute(array(
                                                       'echo' => false,
                                                   )),
                                               ));
                                            ?>
                                        </a>
                                    </div>
                                <?php } ?>
                                <div class="post-content">
                                    <h3 class="small-title">
                                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?>
                                        </a>
                                    </h3>
                                    <?php if (true === $params['enable_meta']) { ?>
                                        <div class="post-meta">
                                            <span>
                                                <?php echo esc_html__('Posted on: ', 'suffix-lite'); ?><?php the_time('F j, Y'); ?>
                                            </span>
                                        </div>
                                    <?php } ?>
                                    <?php if ( ! is_active_sidebar( 'sidebar-home-2' ) ) { ?>
                                    <?php if (absint($params['excerpt_length']) > 0) : ?>
                                        <div class="post-description">
                                            <?php
                                            $excerpt = suffix_lite_words_count(absint($params['excerpt_length']), get_the_content());
                                            echo wp_kses_post(wpautop($excerpt));
                                            ?>
                                        </div>
                                    <?php endif; ?>
                                <?php } ?>
                                </div>
                                    <?php if ( is_active_sidebar( 'sidebar-home-2' ) ) { ?>
                                    <?php if (absint($params['excerpt_length']) > 0) : ?>
                                        <div class="post-description">
                                            <?php
                                            $excerpt = suffix_lite_words_count(absint($params['excerpt_length']), get_the_content());
                                            echo wp_kses_post(wpautop($excerpt));
                                            ?>
                                        </div>
                                    <?php endif; ?>
                                <?php } ?>
                            <?php } ?>
                        </div>
                        <?php $i++; endforeach; ?>
                </div>
                <?php $post_cat_id = absint($params['post_category']); ?>
                <?php if (!empty($params['view_detail'])) { ?>
                    <div class="view-all">
                        <a href="<?php echo esc_url(get_category_link($post_cat_id)); ?>"><?php echo esc_html($params['view_detail']) ?></a>
                    </div>
                <?php } ?>   
            </div>
            <?php wp_reset_postdata(); ?>
        <?php endif; ?>
            <?php echo $args['after_widget'];
        }
    }
endif;
/*Grid Panel widget*/
if (!class_exists('Suffix_Lite_Widget_Style_2')) :
    /**
     * Latest news widget Class.
     *
     * @since 1.0.0
     */
    class Suffix_Lite_Widget_Style_2 extends Suffix_Lite_Widget_Base
    {
        /**
         * Sets up a new widget instance.
         *
         * @since 1.0.0
         */
        function __construct()
        {
            $opts = array(
                'classname' => 'suffix_lite_list_panel_widget',
                'description' => __('Displays post form selected category on List Format.', 'suffix-lite'),
                'customize_selective_refresh' => true,
            );
            $fields = array(
                'title_1' => array(
                    'label' => __('Title For Category 1:', 'suffix-lite'),
                    'default' => __('Title 1', 'suffix-lite'),
                    'type' => 'text',
                    'class' => 'widefat',
                ),
                'post_category_1' => array(
                    'label' => __('Select Category 1:', 'suffix-lite'),
                    'type' => 'dropdown-taxonomies',
                    'show_option_all' => __('All Categories', 'suffix-lite'),
                ),
                'title_2' => array(
                    'label' => __('Title For Category 2:', 'suffix-lite'),
                    'default' => __('Title 2', 'suffix-lite'),
                    'type' => 'text',
                    'class' => 'widefat',
                ),
                'post_category_2' => array(
                    'label' => __('Select Category 2:', 'suffix-lite'),
                    'type' => 'dropdown-taxonomies',
                    'show_option_all' => __('All Categories', 'suffix-lite'),
                ),
                'enable_meta' => array(
                    'label' => __('Enable Post Meta', 'suffix-lite'),
                    'type' => 'checkbox',
                    'default' => true,
                ),
                'post_number' => array(
                    'label' => __('Number of Posts:', 'suffix-lite'),
                    'type' => 'number',
                    'default' => 4,
                    'css' => 'max-width:60px;',
                    'min' => 1,
                    'max' => 10,
                ),
                'select_image_size' => array(
                    'label' => __('Select Image Size Featured Post:', 'suffix-lite'),
                    'type' => 'select',
                    'default' => 'suffix-lite-725-480',
                    'options' => array(
                        'thumbnail' => esc_html__( 'Thumbnail', 'suffix-lite' ),
                        'medium' => esc_html__( 'Medium', 'suffix-lite' ),
                        'medium_large' => esc_html__( 'Medium Large', 'suffix-lite' ),
                        'large' => esc_html__( 'Large', 'suffix-lite' ),
                        'full' => esc_html__( 'Full', 'suffix-lite' ),
                        'suffix-lite-400-260'    => esc_html__( 'Image 400 x 260', 'suffix-lite' ),
                        'suffix-lite-725-480'    => esc_html__( 'Image 720 x 480', 'suffix-lite' ),
                        ),
                    
                ),
                'excerpt_length_featured' => array(
                    'label' => __('Excerpt Length For Featured Post:', 'suffix-lite'),
                    'description' => __('Number of words', 'suffix-lite'),
                    'type' => 'number',
                    'css' => 'max-width:60px;',
                    'default' => 50,
                    'min' => 0,
                    'max' => 200,
                ),
                'select_image_size_2' => array(
                    'label' => __('Select Image Size Other Post:', 'suffix-lite'),
                    'type' => 'select',
                    'default' => 'suffix-lite-400-260',
                    'options' => array(
                        'thumbnail' => esc_html__( 'Thumbnail', 'suffix-lite' ),
                        'medium' => esc_html__( 'Medium', 'suffix-lite' ),
                        'medium_large' => esc_html__( 'Medium Large', 'suffix-lite' ),
                        'large' => esc_html__( 'Large', 'suffix-lite' ),
                        'full' => esc_html__( 'Full', 'suffix-lite' ),
                        'suffix-lite-400-260'    => esc_html__( 'Image 400 x 260', 'suffix-lite' ),
                        'suffix-lite-725-480'    => esc_html__( 'Image 720 x 480', 'suffix-lite' ),
                        ),
                    
                ),
                'excerpt_length' => array(
                    'label' => __('Excerpt Length For List Post:', 'suffix-lite'),
                    'description' => __('Number of words', 'suffix-lite'),
                    'type' => 'number',
                    'css' => 'max-width:60px;',
                    'default' => 20,
                    'min' => 0,
                    'max' => 200,
                ),
                'view_detail' => array(
                    'label' => __('View Detail Text:', 'suffix-lite'),
                    'type' => 'text',
                    'class' => 'widefat',
                ),
            );
            parent::__construct('suffix-lite-list-layout', __('SFX: Double Category Widget', 'suffix-lite'), $opts, array(), $fields);
        }
        /**
         * Outputs the content for the current widget instance.
         *
         * @since 1.0.0
         *
         * @param array $args Display arguments.
         * @param array $instance Settings for the current widget instance.
         */
        function widget($args, $instance)
        {
            $params = $this->get_params($instance);
            echo $args['before_widget'];
            $q_1_args = array(
                'posts_per_page' => absint($params['post_number']),
                'no_found_rows' => true,
            );
            if (absint($params['post_category_1']) > 0) {
                $q_1_args['category'] = absint($params['post_category_1']);
            }
            $all_posts_1 = get_posts($q_1_args);
            // query for 2nd cat
            $q_2_args = array(
                'posts_per_page' => absint($params['post_number']),
                'no_found_rows' => true,
            );
            if (absint($params['post_category_2']) > 0) {
                $q_2_args['category'] = absint($params['post_category_2']);
            }
            $all_posts_2 = get_posts($q_2_args);
            ?>
            <div class="suffix-lite-widget suffix-lite-widget-2">
                <div class="widget-row">
                    <?php if (!empty($all_posts_1)) : ?>
                        <?php global $post;
                        $author_id = $post->post_author;
                        $i = 1;
                        ?>
                        <div class="column column-half">
                            <?php if (!empty($params['title_1'])) {
                                echo $args['before_title'] . $params['title_1'] . $args['after_title'];
                            } ?>
                            <div class="widget-list clear">
                                <?php foreach ($all_posts_1 as $key => $post) : ?>
                                    <?php setup_postdata($post); ?>
                                    <?php if ($i == 1) {
                                        $feature_post = 'featured-post';
                                    } else {
                                        $feature_post = '';
                                    } 
                                    $select_image_size = esc_attr($params['select_image_size']);
                                    ?>
                                    <div class="article-block-wrapper <?php echo esc_attr($feature_post); ?>">
                                        <?php if ($i == 1) { ?>
                                            <?php if (has_post_thumbnail()) { ?>
                                                <div class="post-image">
                                                    <a class="twp-image-wrapper" href="<?php the_permalink(); ?>">
                                                        <?php
                                                           the_post_thumbnail($select_image_size, array(
                                                               'alt' => the_title_attribute(array(
                                                                   'echo' => false,
                                                               )),
                                                           ));
                                                        ?>
                                                    </a>
                                                </div>
                                            <?php } ?>
                                            <div class="post-content">
                                                <h3 class="small-title">
                                                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?>
                                                    </a>
                                                </h3>
                                                <?php if (true === $params['enable_meta']) { ?>
                                                    <div class="post-meta">
                                                        <span>
                                                            <?php echo esc_html__('Posted on: ', 'suffix-lite'); ?><?php the_time('F j, Y'); ?>
                                                        </span>
                                                    </div>
                                                <?php } ?>
                                                <?php if (absint($params['excerpt_length_featured']) > 0) : ?>
                                                    <div class="post-description">
                                                        <?php
                                                        $excerpt = suffix_lite_words_count(absint($params['excerpt_length_featured']), get_the_content());
                                                        echo wp_kses_post(wpautop($excerpt));
                                                        ?>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                        <?php } else { ?>
                                            <?php
                                                $select_image_size_2 = esc_attr($params['select_image_size_2']);
                                             ?>
                                            <?php if (has_post_thumbnail()) { ?>
                                                <div class="post-image">
                                                    <a class="twp-image-wrapper" href="<?php the_permalink(); ?>">
                                                        <?php
                                                           the_post_thumbnail($select_image_size_2, array(
                                                               'alt' => the_title_attribute(array(
                                                                   'echo' => false,
                                                               )),
                                                           ));
                                                        ?>
                                                    </a>
                                                </div>
                                            <?php } ?>
                                            <div class="post-content">
                                                <h3 class="small-title">
                                                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?>
                                                    </a>
                                                </h3>
                                                <?php if (true === $params['enable_meta']) { ?>
                                                    <div class="post-meta">
                                                        <span>
                                                            <?php echo esc_html__('Posted on: ', 'suffix-lite'); ?><?php the_time('F j, Y'); ?>
                                                        </span>
                                                    </div>
                                                <?php } ?>
                                                <?php if (absint($params['excerpt_length']) > 0) : ?>
                                                    <div class="post-description">
                                                        <?php
                                                        $excerpt = suffix_lite_words_count(absint($params['excerpt_length']), get_the_content());
                                                        echo wp_kses_post(wpautop($excerpt));
                                                        ?>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                        <?php } ?>
                                    </div>
                                    <?php $i++; endforeach; ?>
                            </div>
                            <?php $post_cat_id = absint($params['post_category_1']); ?>
                            <?php if (!empty($params['view_detail'])) { ?>
                                <div class="view-all"><a
                                            href="<?php echo esc_url(get_category_link($post_cat_id)); ?>"><?php echo esc_html($params['view_detail']) ?></a>
                                </div>
                            <?php } ?>
                            <?php wp_reset_postdata(); ?>
                        </div>
                    <?php endif; ?>
                    <!-- second category -->
                    <?php if (!empty($all_posts_2)) : ?>
                        <?php global $post;
                        $author_id = $post->post_author;
                        $i = 1;
                        ?>
                        <div class="column column-half">
                            <?php if (!empty($params['title_2'])) {
                                echo $args['before_title'] . $params['title_2'] . $args['after_title'];
                            } ?>
                            <div class="items-wrap">
                                <?php foreach ($all_posts_2 as $key => $post) : ?>
                                    <?php setup_postdata($post); ?>
                                    <?php if ($i == 1) {
                                        $feature_post = 'featured-post';
                                    } else {
                                        $feature_post = '';
                                    } 
                                    $select_image_size = esc_attr($params['select_image_size']);
                                    ?>
                                    <div class="article-block-wrapper <?php echo esc_attr($feature_post); ?>">
                                        <?php if ($i == 1) { ?>
                                            <?php if (has_post_thumbnail()) { ?>
                                                <div class="post-image">
                                                    <a class="twp-image-wrapper" href="<?php the_permalink(); ?>">
                                                        <?php
                                                           the_post_thumbnail($select_image_size, array(
                                                               'alt' => the_title_attribute(array(
                                                                   'echo' => false,
                                                               )),
                                                           ));
                                                        ?>
                                                    </a>
                                                </div>
                                            <?php } ?>
                                            <div class="post-content">
                                                <h3 class="small-title">
                                                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                                </h3>
                                                <?php if (true === $params['enable_meta']) { ?>
                                                    <div class="post-meta">
                                                        <span>
                                                            <?php echo esc_html__('Posted on: ', 'suffix-lite'); ?><?php the_time('F j, Y'); ?>
                                                        </span>
                                                    </div>
                                                <?php } ?>
                                                <?php if (absint($params['excerpt_length_featured']) > 0) : ?>
                                                    <div class="post-description">
                                                        <?php
                                                        $excerpt = suffix_lite_words_count(absint($params['excerpt_length_featured']), get_the_content());
                                                        echo wp_kses_post(wpautop($excerpt));
                                                        ?>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                        <?php } else { ?>
                                            <?php  $select_image_size_2 = esc_attr($params['select_image_size_2']); ?>
                                            <?php if (has_post_thumbnail()) { ?>
                                                <div class="post-image">
                                                    <a class="twp-image-wrapper" href="<?php the_permalink(); ?>">
                                                        <?php
                                                           the_post_thumbnail($select_image_size_2, array(
                                                               'alt' => the_title_attribute(array(
                                                                   'echo' => false,
                                                               )),
                                                           ));
                                                        ?>
                                                    </a>
                                                </div>
                                            <?php } ?>
                                            <div class="post-content">
                                                <h3 class="small-title">
                                                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                                </h3>
                                                <?php if (true === $params['enable_meta']) { ?>
                                                    <div class="post-meta">
                                                        <span>
                                                            <?php echo esc_html__('Posted on: ', 'suffix-lite'); ?><?php the_time('F j, Y'); ?>
                                                        </span>
                                                    </div>
                                                <?php } ?>
                                                <?php if (absint($params['excerpt_length']) > 0) : ?>
                                                    <div class="post-description">
                                                        <?php
                                                        $excerpt = suffix_lite_words_count(absint($params['excerpt_length']), get_the_content());
                                                        echo wp_kses_post(wpautop($excerpt));
                                                        ?>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                        <?php } ?>
                                    </div>
                                    <?php $i++; endforeach; ?>
                            </div>
                            <?php $post_cat_id = absint($params['post_category_2']); ?>
                            <?php if (!empty($params['view_detail'])) { ?>
                                <div class="view-all"><a
                                            href="<?php echo(get_category_link($post_cat_id)); ?>"><?php echo esc_html($params['view_detail']) ?></a>
                                </div>
                            <?php } ?>
                            <?php wp_reset_postdata(); ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            <?php echo $args['after_widget'];
        }
    }
endif;

if (!class_exists('Suffix_Lite_Widget_Style_3')) :
    /**
     * Latest news widget Class.
     *
     * @since 1.0.0
     */
    class Suffix_Lite_Widget_Style_3 extends Suffix_Lite_Widget_Base
    {
        /**
         * Sets up a new widget instance.
         *
         * @since 1.0.0
         */
        function __construct()
        {
            $opts = array(
                'classname' => 'suffix_lite_single_panel_widget',
                'description' => __('Displays posts from selected category.', 'suffix-lite'),
                'customize_selective_refresh' => true,
            );
            $fields = array(
                'title' => array(
                    'label' => __('Title:', 'suffix-lite'),
                    'type' => 'text',
                    'class' => 'widefat',
                ),
                'post_category' => array(
                    'label' => __('Select Category:', 'suffix-lite'),
                    'type' => 'dropdown-taxonomies',
                    'show_option_all' => __('All Categories', 'suffix-lite'),
                ),
                'select_layout' => array(
                    'label' => __('Select Layout:', 'suffix-lite'),
                    'type' => 'select',
                    'default' => 'img-alt',
                    'options' => array(
                        'img-alt' => esc_html__( 'Image Alternate', 'suffix-lite' ),
                        'img-left'    => esc_html__( 'Image Left', 'suffix-lite' ),
                        'img-right'    => esc_html__( 'Image Right', 'suffix-lite' ),
                        ),
                    
                ),
                'enable_meta' => array(
                    'label' => __('Enable Post Meta', 'suffix-lite'),
                    'type' => 'checkbox',
                    'default' => true,
                ),
                'select_image_size' => array(
                    'label' => __('Select Image Size:', 'suffix-lite'),
                    'type' => 'select',
                    'default' => 'suffix-lite-725-480',
                    'options' => array(
                        'thumbnail' => esc_html__( 'Thumbnail', 'suffix-lite' ),
                        'medium' => esc_html__( 'Medium', 'suffix-lite' ),
                        'medium_large' => esc_html__( 'Medium Large', 'suffix-lite' ),
                        'large' => esc_html__( 'Large', 'suffix-lite' ),
                        'full' => esc_html__( 'Full', 'suffix-lite' ),
                        'suffix-lite-400-260'    => esc_html__( 'Image 400 x 260', 'suffix-lite' ),
                        'suffix-lite-725-480'    => esc_html__( 'Image 720 x 480', 'suffix-lite' ),
                        ),
                    
                ),
                'excerpt_length' => array(
                    'label' => __('Excerpt Length:', 'suffix-lite'),
                    'description' => __('Number of words', 'suffix-lite'),
                    'type' => 'number',
                    'css' => 'max-width:60px;',
                    'default' => 20,
                    'min' => 0,
                    'max' => 200,
                ),
                'post_number' => array(
                    'label' => __('Number of Posts:', 'suffix-lite'),
                    'type' => 'number',
                    'default' => 5,
                    'css' => 'max-width:60px;',
                    'min' => 1,
                    'max' => 10,
                ),
                'view_detail' => array(
                    'label' => __('View Detail Text:', 'suffix-lite'),
                    'type' => 'text',
                    'class' => 'widefat',
                ),
            );
            parent::__construct('suffix-lite-alternate-layout', __('SFX: List Category Widget', 'suffix-lite'), $opts, array(), $fields);
        }
        /**
         * Outputs the content for the current widget instance.
         *
         * @since 1.0.0
         *
         * @param array $args Display arguments.
         * @param array $instance Settings for the current widget instance.
         */
        function widget($args, $instance)
        {
            $params = $this->get_params($instance);
            echo $args['before_widget'];
            $qargs = array(
                'posts_per_page' => absint($params['post_number']),
                'no_found_rows' => true,
            );
            if (absint($params['post_category']) > 0) {
                $qargs['category'] = absint($params['post_category']);
            }
            $all_posts = get_posts($qargs);
            ?>
            <?php if (!empty($all_posts)) : ?>
            <?php global $post;
            $author_id = $post->post_author;
            $i = 1;
            ?>

            <div class="list-widget">
                <?php if (!empty($params['title'])) {
                    echo $args['before_title'] . $params['title'] . $args['after_title'];
                } ?>
                <?php foreach ($all_posts as $key => $post) : ?>
                    <?php setup_postdata($post); ?>
                    <?php 
                    $select_layout = esc_attr($params['select_layout']);
                    if ($select_layout == 'img-left') {
                        $feature_post = 'row-ltr';
                    } elseif($select_layout == 'img-right'){
                        $feature_post = 'row-rtl';
                    } else { 
                        if ($i % 2 == 0) {
                        $feature_post = 'row-rtl';
                            } else {
                            $feature_post = 'row-ltr';
                        } 
                    }?>
                    <div class="widget-row twp-equal <?php echo esc_attr($feature_post); ?>">
                        <div class="column column-half">
                            <?php if (has_post_thumbnail()) { 
                                $select_image_size = esc_attr($params['select_image_size']); ?>
                                <div class="post-image">
                                    <a class="twp-image-wrapper" href="<?php the_permalink(); ?>">
                                        <?php
                                           the_post_thumbnail($select_image_size, array(
                                               'alt' => the_title_attribute(array(
                                                   'echo' => false,
                                               )),
                                           ));
                                        ?>
                                    </a>
                                </div>
                            <?php } ?>
                        </div> 
                        <div class="column column-half">
                            <div class="post-content">
                                <h3 class="small-title">
                                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?> </a>
                                </h3>
                                <?php if (true === $params['enable_meta']) { ?>
                                    <div class="post-meta">
                                        <span>
                                            <?php echo esc_html__('Posted on: ', 'suffix-lite'); ?><?php the_time('F j, Y'); ?>
                                        </span>
                                    </div>
                                <?php } ?>
                            </div>
                            <?php if (absint($params['excerpt_length']) > 0) : ?>
                                <div class="post-description">
                                    <?php
                                    $excerpt = suffix_lite_words_count(absint($params['excerpt_length']), get_the_content());
                                    echo wp_kses_post(wpautop($excerpt));
                                    ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>

                    <?php $i++; endforeach; ?>
                    <?php $post_cat_id = absint($params['post_category']); ?>
                    <?php if (!empty($params['view_detail'])) { ?>
                        <div class="view-all"><a
                                    href="<?php echo esc_url(get_category_link($post_cat_id)); ?>"><?php echo esc_html($params['view_detail']) ?></a>
                        </div>
                    <?php } ?> 
            </div>
            <?php wp_reset_postdata(); ?>
        <?php endif; ?>

            <?php echo $args['after_widget'];
        }
    }
endif;

/*Grid Panel widget*/
if (!class_exists('Suffix_Lite_Sidebar_Widget')) :
    /**
     * Popular widget Class.
     *
     * @since 1.0.0
     */
    class Suffix_Lite_Sidebar_Widget extends Suffix_Lite_Widget_Base
    {
        /**
         * Sets up a new widget instance.
         *
         * @since 1.0.0
         */
        function __construct()
        {
            $opts = array(
                'classname' => 'suffix_lite_popular_post_widget',
                'description' => __('Displays post form selected category specific for popular post in sidebars.', 'suffix-lite'),
                'customize_selective_refresh' => true,
            );
            $fields = array(
                'title' => array(
                    'label' => __('Title:', 'suffix-lite'),
                    'type' => 'text',
                    'class' => 'widefat',
                ),
                'post_category' => array(
                    'label' => __('Select Category:', 'suffix-lite'),
                    'type' => 'dropdown-taxonomies',
                    'show_option_all' => __('All Categories', 'suffix-lite'),
                ),
                'enable_meta' => array(
                    'label' => __('Enable Post Meta', 'suffix-lite'),
                    'type' => 'checkbox',
                    'default' => true,
                ),
                'enable_discription' => array(
                    'label' => __('Enable Description:', 'suffix-lite'),
                    'type' => 'checkbox',
                    'default' => false,
                ),
                'select_image_size' => array(
                    'label' => __('Select Image Size:', 'suffix-lite'),
                    'type' => 'select',
                    'default' => 'suffix-lite-725-480',
                    'options' => array(
                        'thumbnail' => esc_html__( 'Thumbnail', 'suffix-lite' ),
                        'medium' => esc_html__( 'Medium', 'suffix-lite' ),
                        'medium_large' => esc_html__( 'Medium Large', 'suffix-lite' ),
                        'large' => esc_html__( 'Large', 'suffix-lite' ),
                        'full' => esc_html__( 'Full', 'suffix-lite' ),
                        'suffix-lite-400-260'    => esc_html__( 'Image 400 x 260', 'suffix-lite' ),
                        'suffix-lite-725-480'    => esc_html__( 'Image 720 x 480', 'suffix-lite' ),
                        ),
                    
                ),
                'excerpt_length' => array(
                    'label' => __('Excerpt Length:', 'suffix-lite'),
                    'description' => __('Number of words', 'suffix-lite'),
                    'default' => 15,
                    'css' => 'max-width:60px;',
                    'min' => 0,
                    'max' => 200,
                ),
                'post_number' => array(
                    'label' => __('Number of Posts:', 'suffix-lite'),
                    'type' => 'number',
                    'default' => 4,
                    'css' => 'max-width:60px;',
                    'min' => 1,
                    'max' => 10,
                ),
            );
            parent::__construct('suffix-lite-popular-sidebar-layout', __('SFX: Recent Post Widget', 'suffix-lite'), $opts, array(), $fields);
        }
        /**
         * Outputs the content for the current widget instance.
         *
         * @since 1.0.0
         *
         * @param array $args Display arguments.
         * @param array $instance Settings for the current widget instance.
         */
        function widget($args, $instance)
        {
            $params = $this->get_params($instance);
            echo $args['before_widget'];
            if (!empty($params['title'])) {
                echo $args['before_title'] . $params['title'] . $args['after_title'];
            }
            $qargs = array(
                'posts_per_page' => absint($params['post_number']),
                'no_found_rows' => true,
            );
            if (absint($params['post_category']) > 0) {
                $qargs['category'] = absint($params['post_category']);
            }
            $all_posts = get_posts($qargs);
            global $post;
            ?>
            <?php if (!empty($all_posts)) : ?>
            <div class="twp-recent-widget">
                <div class="recent-widget-list">
                    <?php foreach ($all_posts as $key => $post) : ?>
                        <?php setup_postdata($post); ?>
                        <div class="full-item">
                            <div class="widget-row">
                                <div class="item-image column column-four">
                                    <?php if (has_post_thumbnail()) {
                                    $select_image_size = esc_attr($params['select_image_size']); ?>
                                        <figure class="twp-article">
                                            <div class="twp-article-item">
                                                <div class="article-item-image">
                                                    <?php
                                                       the_post_thumbnail($select_image_size, array(
                                                           'alt' => the_title_attribute(array(
                                                               'echo' => false,
                                                           )),
                                                       ));
                                                    ?>
                                                </div>
                                            </div>
                                        </figure>
                                    <?php } ?>
                                </div>
                                <div class="full-item-details column column-six">
                                    <div class="full-item-content">
                                        <h3 class="small-title">
                                            <a href="<?php the_permalink(); ?>">
                                                <?php the_title(); ?>
                                            </a>
                                        </h3>
                                    </div>
                                    <?php if (true === $params['enable_meta']) { ?>
                                        <div class="post-meta">
                                            <span>
                                                <?php echo esc_html__('Posted on: ', 'suffix-lite'); ?><?php the_time('F j, Y'); ?>
                                            </span>
                                        </div>
                                    <?php } ?>
                                    <div class="full-item-discription">
                                        <?php if (true === $params['enable_discription']) { ?>
                                            <?php if (absint($params['excerpt_length']) > 0) : ?>
                                                <div class="post-description">
                                                    <?php
                                                    $excerpt = suffix_lite_words_count(absint($params['excerpt_length']), get_the_content());
                                                    echo wp_kses_post(wpautop($excerpt));
                                                    ?>
                                                </div>
                                            <?php endif; ?>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php
                    endforeach; ?>
                </div>
            </div>
            <?php wp_reset_postdata(); ?>
        <?php endif; ?>
            <?php echo $args['after_widget'];
        }
    }
endif;

/*list widget*/
if (!class_exists('Suffix_Lite_Widget_List')) :
    /**
     * List widget Class.
     *
     * @since 1.0.0
     */
    class Suffix_Lite_Widget_List extends Suffix_Lite_Widget_Base
    {
        /**
         * Sets up a new widget instance.
         *
         * @since 1.0.0
         */
        function __construct()
        {
            $opts = array(
                'classname' => 'suffix_lite_list_post_widget',
                'description' => __('Displays post form selected category listing posts title.', 'suffix-lite'),
                'customize_selective_refresh' => true,
            );
            $fields = array(
                'title' => array(
                    'label' => __('Title:', 'suffix-lite'),
                    'type' => 'text',
                    'class' => 'widefat',
                ),
                'post_category' => array(
                    'label' => __('Select Category:', 'suffix-lite'),
                    'type' => 'dropdown-taxonomies',
                    'show_option_all' => __('All Categories', 'suffix-lite'),
                ),
                'post_number' => array(
                    'label' => __('Number of Posts:', 'suffix-lite'),
                    'type' => 'number',
                    'default' => 4,
                    'css' => 'max-width:60px;',
                    'min' => 1,
                    'max' => 10,
                ),
            );
            parent::__construct('suffix-lite-list-post-layout', __('SFX: List Post Widget', 'suffix-lite'), $opts, array(), $fields);
        }
        /**
         * Outputs the content for the current widget instance.
         *
         * @since 1.0.0
         *
         * @param array $args Display arguments.
         * @param array $instance Settings for the current widget instance.
         */
        function widget($args, $instance)
        {
            $params = $this->get_params($instance);
            echo $args['before_widget'];
            if (!empty($params['title'])) {
                echo $args['before_title'] . $params['title'] . $args['after_title'];
            }
            $qargs = array(
                'posts_per_page' => absint($params['post_number']),
                'no_found_rows' => true,
            );
            if (absint($params['post_category']) > 0) {
                $qargs['category'] = absint($params['post_category']);
            }
            $all_posts = get_posts($qargs);
            global $post;
            ?>
            <?php if (!empty($all_posts)) : ?>
            <div class="twp-list-widget">
                <?php foreach ($all_posts as $key => $post) : ?>
                    <?php setup_postdata($post); ?>
                        <div class="article-list">
                            <h3 class="small-title">
                                <a href="<?php the_permalink(); ?>" class="article-list-block">
                                    <span class="list-icon">
                                        <i class="fa fa-angle-double-right" aria-hidden="true"></i>
                                    </span>
                                    <span class="list-title"><?php the_title(); ?></span>
                                </a>
                            </h3>
                        </div>
                <?php
                endforeach; ?>
            </div>
            <?php wp_reset_postdata(); ?>
        <?php endif; ?>
            <?php echo $args['after_widget'];
        }
    }
endif;
/*Grid Panel widget*/
if (!class_exists('Suffix_Lite_Carousel_Post_Widget')) :
    /**
     * carousel widget Class.
     *
     * @since 1.0.0
     */
    class Suffix_Lite_Carousel_Post_Widget extends Suffix_Lite_Widget_Base
    {
        /**
         * Sets up a new widget instance.
         *
         * @since 1.0.0
         */
        function __construct()
        {
            $opts = array(
                'classname' => 'suffix_lite_carousel_widget',
                'description' => __('Displays posts from selected category in carousel.', 'suffix-lite'),
                'customize_selective_refresh' => true,
            );
            $fields = array(
                'post_category' => array(
                    'label' => __('Select Category:', 'suffix-lite'),
                    'type' => 'dropdown-taxonomies',
                    'show_option_all' => __('All Categories', 'suffix-lite'),
                ),
                'enable_meta' => array(
                    'label' => __('Enable Post Meta', 'suffix-lite'),
                    'type' => 'checkbox',
                    'default' => true,
                ),
                'select_image_size' => array(
                    'label' => __('Select Image Size:', 'suffix-lite'),
                    'type' => 'select',
                    'default' => 'suffix-lite-725-480',
                    'options' => array(
                        'thumbnail' => esc_html__( 'Thumbnail', 'suffix-lite' ),
                        'medium' => esc_html__( 'Medium', 'suffix-lite' ),
                        'medium_large' => esc_html__( 'Medium Large', 'suffix-lite' ),
                        'large' => esc_html__( 'Large', 'suffix-lite' ),
                        'full' => esc_html__( 'Full', 'suffix-lite' ),
                        'suffix-lite-400-260'    => esc_html__( 'Image 400 x 260', 'suffix-lite' ),
                        'suffix-lite-725-480'    => esc_html__( 'Image 720 x 480', 'suffix-lite' ),
                        ),
                    
                ),
                'post_number' => array(
                    'label' => __('Number of Posts:', 'suffix-lite'),
                    'type' => 'number',
                    'default' => 5,
                    'css' => 'max-width:60px;',
                    'min' => 1,
                    'max' => 15,
                ),
            );
            parent::__construct('suffix-lite-carousel-layout', __('SFX: Carousel Widget', 'suffix-lite'), $opts, array(), $fields);
        }
        /**
         * Outputs the content for the current widget instance.
         *
         * @since 1.0.0
         *
         * @param array $args Display arguments.
         * @param array $instance Settings for the current widget instance.
         */
        function widget($args, $instance)
        {
            $params = $this->get_params($instance);
            echo $args['before_widget'];
            $qargs = array(
                'posts_per_page' => absint($params['post_number']),
                'no_found_rows' => true,
            );
            if (absint($params['post_category']) > 0) {
                $qargs['category'] = absint($params['post_category']);
            }
            $all_posts = get_posts($qargs);
            ?>
            <?php if (!empty($all_posts)) : ?>
            <?php global $post;
            $author_id = $post->post_author;
            ?>
            <?php $rtl_class_c = 'false';
            if(is_rtl()){ 
                $rtl_class_c = 'true';
            }?>
            <div class="twp-carousal-widget" data-slick='{"rtl": <?php echo($rtl_class_c); ?>}'>
                <?php foreach ($all_posts as $key => $post) : ?>
                    <?php setup_postdata($post); ?>
                    <div class="carousal-item">
                        <div class="post-image">
                            <a class="bg-image carousal-slider-bg" href="<?php the_permalink(); ?>">
                                <?php if (has_post_thumbnail($post->ID)) : ?>
                                    <?php 
                                    $select_image_size = esc_attr($params['select_image_size']);
                                       the_post_thumbnail($select_image_size, array(
                                           'alt' => the_title_attribute(array(
                                               'echo' => false,
                                           )),
                                       ));
                                    ?>
                                <?php else : ?>
                                <?php endif; ?>
                            </a>
                        </div>
                        <div class="post-content post-content-1">
                            <?php if (true === $params['enable_meta']) { ?>
                                <div class="post-meta">
                                    <span>
                                        <?php echo esc_html__('Posted on: ', 'suffix-lite'); ?><?php the_time('F j, Y'); ?>
                                    </span>
                                </div>
                            <?php } ?>
                            <h3 class="small-title">
                                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                            </h3>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <?php wp_reset_postdata(); ?>
        <?php endif; ?>
            <?php echo $args['after_widget'];
        }
    }
endif;

/*tabed widget*/
if (!class_exists('Suffix_Lite_Tabbed_Widget')) :
    /**
     * Tabbed widget Class.
     *
     * @since 1.0.0
     */
    class Suffix_Lite_Tabbed_Widget extends Suffix_Lite_Widget_Base
    {
        /**
         * Sets up a new widget instance.
         *
         * @since 1.0.0
         */
        function __construct()
        {
            $opts = array(
                'classname' => 'suffix_lite_widget_tabbed',
                'description' => __('Tabbed widget.', 'suffix-lite'),
            );
            $fields = array(
                'popular_heading' => array(
                    'label' => __('Popular', 'suffix-lite'),
                    'type' => 'heading',
                ),
                'popular_number' => array(
                    'label' => __('No. of Posts:', 'suffix-lite'),
                    'type' => 'number',
                    'css' => 'max-width:60px;',
                    'default' => 5,
                    'min' => 1,
                    'max' => 10,
                ),
                'enable_discription' => array(
                    'label' => __('Enable Description:', 'suffix-lite'),
                    'type' => 'checkbox',
                    'default' => true,
                ),
                'enable_meta' => array(
                    'label' => __('Enable Post Meta', 'suffix-lite'),
                    'type' => 'checkbox',
                    'default' => true,
                ),
                'select_image_size' => array(
                    'label' => __('Select Image Size', 'suffix-lite'),
                    'type' => 'select',
                    'default' => 'suffix-lite-725-480',
                    'options' => array(
                        'thumbnail' => esc_html__( 'Thumbnail', 'suffix-lite' ),
                        'medium' => esc_html__( 'Medium', 'suffix-lite' ),
                        'medium_large' => esc_html__( 'Medium Large', 'suffix-lite' ),
                        'large' => esc_html__( 'Large', 'suffix-lite' ),
                        'full' => esc_html__( 'Full', 'suffix-lite' ),
                        'suffix-lite-400-260'    => esc_html__( 'Image 400 x 260', 'suffix-lite' ),
                        'suffix-lite-725-480'    => esc_html__( 'Image 720 x 480', 'suffix-lite' ),
                        ),
                    
                ),
                'excerpt_length' => array(
                    'label' => __('Excerpt Length:', 'suffix-lite'),
                    'description' => __('Number of words', 'suffix-lite'),
                    'default' => 10,
                    'css' => 'max-width:60px;',
                    'min' => 0,
                    'max' => 200,
                ),
                'recent_heading' => array(
                    'label' => __('Recent', 'suffix-lite'),
                    'type' => 'heading',
                ),
                'recent_number' => array(
                    'label' => __('No. of Posts:', 'suffix-lite'),
                    'type' => 'number',
                    'css' => 'max-width:60px;',
                    'default' => 5,
                    'min' => 1,
                    'max' => 10,
                ),
                'comments_heading' => array(
                    'label' => __('Comments', 'suffix-lite'),
                    'type' => 'heading',
                ),
                'comments_number' => array(
                    'label' => __('No. of Comments:', 'suffix-lite'),
                    'type' => 'number',
                    'css' => 'max-width:60px;',
                    'default' => 5,
                    'min' => 1,
                    'max' => 10,
                ),
            );
            parent::__construct('suffix-lite-tabbed', __('SFX: Tab Widgets', 'suffix-lite'), $opts, array(), $fields);
        }
        /**
         * Outputs the content for the current widget instance.
         *
         * @since 1.0.0
         *
         * @param array $args Display arguments.
         * @param array $instance Settings for the current widget instance.
         */
        function widget($args, $instance)
        {
            $params = $this->get_params($instance);
            $tab_id = 'tabbed-' . $this->number;
            echo $args['before_widget'];
            ?>
            <div class="tabbed-container">
                <div class="section-head">
                    <ul class="tabs">
                        <li class="tab-link tab-popular current" data-tab="tab-1">
                            <?php esc_html_e('Popular', 'suffix-lite'); ?>
                        </li>
                        <li class="tab-link tab-recent" data-tab="tab-2">
                            <?php esc_html_e('Recent', 'suffix-lite'); ?>
                        </li>
                        <li class="tab-link tab-comments" data-tab="tab-3">
                            <?php esc_html_e('Comments', 'suffix-lite'); ?>
                        </li>
                    </ul>
                </div>

                <div id="tab-1" class="tab-content current">
                    <?php $this->render_news('popular', $params); ?>
                </div>
                <div id="tab-2" class="tab-content">
                    <?php $this->render_news('recent', $params); ?>
                </div>
                <div id="tab-3" class="tab-content">
                    <?php $this->render_comments($params); ?>
                </div>
            </div>
            <?php
            echo $args['after_widget'];
        }
        /**
         * Render news.
         *
         * @since 1.0.0
         *
         * @param array $type Type.
         * @param array $params Parameters.
         * @return void
         */
        function render_news($type, $params)
        {
            if (!in_array($type, array('popular', 'recent'))) {
                return;
            }
            switch ($type) {
                case 'popular':
                    $qargs = array(
                        'posts_per_page' => $params['popular_number'],
                        'no_found_rows' => true,
                        'orderby' => 'comment_count',
                    );
                    break;
                case 'recent':
                    $qargs = array(
                        'posts_per_page' => $params['recent_number'],
                        'no_found_rows' => true,
                    );
                    break;
                default:
                    break;
            }
            $all_posts = get_posts($qargs);
            ?>
            <?php if (!empty($all_posts)) : ?>
            <?php global $post;
            ?>
            <ul class="article-item article-list-item article-tabbed-list article-item-left">
                <?php foreach ($all_posts as $key => $post) : ?>
                    <?php setup_postdata($post); ?>
                    <li class="full-item">
                        <div class="widget-row">
                            <div class="item-image column column-four">
                                <a href="<?php the_permalink(); ?>" class="news-item-thumb">
                                    <?php if (has_post_thumbnail($post->ID)) : ?>
                                        <?php 
                                        $select_image_size = esc_attr($params['select_image_size']);?>
                                        <?php
                                           the_post_thumbnail($select_image_size, array(
                                               'alt' => the_title_attribute(array(
                                                   'echo' => false,
                                               )),
                                           ));
                                        ?>
                                    <?php else : ?>
                                    <?php endif; ?>
                                </a>
                            </div>
                            <div class="full-item-details column column-six">
                                <div class="full-item-content">
                                    <h3 class="small-title">
                                        <a href="<?php the_permalink(); ?>">
                                            <?php the_title(); ?>
                                        </a>
                                    </h3>
                                    <?php if (true === $params['enable_meta']) { ?>
                                        <div class="post-meta">
                                            <span>
                                                <?php echo esc_html__('Posted on: ', 'suffix-lite'); ?><?php the_time('F j, Y'); ?>
                                            </span>
                                        </div>
                                    <?php } ?>
                                    <div class="full-item-desc">
                                        <?php if (true === $params['enable_discription']) { ?>
                                            <?php if (absint($params['excerpt_length']) > 0) : ?>
                                                <div class="post-description">
                                                    <?php
                                                    $excerpt = suffix_lite_words_count(absint($params['excerpt_length']), get_the_content());
                                                    echo wp_kses_post(wpautop($excerpt));
                                                    ?>
                                                </div>
                                            <?php endif; ?>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div><!-- .news-content -->
                    </li>
                <?php endforeach; ?>
            </ul><!-- .news-list -->
            <?php wp_reset_postdata(); ?>
        <?php endif; ?>
            <?php
        }
        /**
         * Render comments.
         *
         * @since 1.0.0
         *
         * @param array $params Parameters.
         * @return void
         */
        function render_comments($params)
        {
            $comment_args = array(
                'number' => $params['comments_number'],
                'status' => 'approve',
                'post_status' => 'publish',
            );
            $comments = get_comments($comment_args);
            ?>
            <?php if (!empty($comments)) : ?>
            <ul class="article-item article-list-item article-item-left comments-tabbed--list">
                <?php foreach ($comments as $key => $comment) : ?>
                    <li class="article-panel clear">
                        <figure class="article-thumbmnail">
                            <?php $comment_author_url = get_comment_author_url($comment); ?>
                            <?php if (!empty($comment_author_url)) : ?>
                                <a href="<?php echo esc_url($comment_author_url); ?>"><?php echo get_avatar($comment, 65); ?></a>
                            <?php else : ?>
                                <?php echo get_avatar($comment, 65); ?>
                            <?php endif; ?>
                        </figure><!-- .comments-thumb -->
                        <div class="comments-content">
                            <?php echo get_comment_author_link($comment); ?>
                            &nbsp;<?php echo esc_html_x('on', 'Tabbed Widget', 'suffix-lite'); ?>&nbsp;<a
                                    href="<?php echo esc_url(get_comment_link($comment)); ?>"><?php echo get_the_title($comment->comment_post_ID); ?></a>
                        </div><!-- .comments-content -->
                    </li>
                <?php endforeach; ?>
            </ul><!-- .comments-list -->
        <?php endif; ?>
            <?php
        }
    }
endif;
if (!class_exists('Suffix_Lite_Widget_Social')) :
    /**
     * Social Menu widget Class.
     *
     * @since 1.0.0
     */
    class Suffix_Lite_Widget_Social extends Suffix_Lite_Widget_Base
    {
        /**
         * Sets up a new widget instance.
         *
         * @since 1.0.0
         */
        function __construct()
        {
            $opts = array(
                'classname' => 'suffix_lite_social_widget',
                'description' => __('Displays social menu if you have set it(social menu)', 'suffix-lite'),
                'customize_selective_refresh' => true,
            );
            $fields = array(
                'title' => array(
                    'label' => __('Title:', 'suffix-lite'),
                    'description' => __('Note: Displays social menu if you have set it(social menu)', 'suffix-lite'),
                    'type' => 'text',
                    'class' => 'widefat',
                ),
                'description' => array(
                    'label' => __('Description:', 'suffix-lite'),
                    'type' => 'text',
                    'class' => 'widefat',
                ),
            );
            parent::__construct('suffix-lite-social-layout', __('SFX: Social Menu Widget', 'suffix-lite'), $opts, array(), $fields);
        }
        /**
         * Outputs the content for the current widget instance.
         *
         * @since 1.0.0
         *
         * @param array $args Display arguments.
         * @param array $instance Settings for the current widget instance.
         */
        function widget($args, $instance)
        {
            $params = $this->get_params($instance);
            echo $args['before_widget'];
            echo "<div class='widget-header-wrapper'>";
            if (!empty($params['title'])) {
                echo $args['before_title'] . $params['title'] . $args['after_title'];
            }
            if (!empty($params['description'])) {
                echo "<p class='widget-description'>";
                echo esc_html($params['description']);
                echo "</p>";
            }
            echo "</div>";
            ?>
            <div class="social-widget-menu">
                <?php
                if ( has_nav_menu( 'social' ) ) {
                    wp_nav_menu( array(
                        'theme_location' => 'social',
                        'link_before' => '<span class="screen-reader-text">',
                        'link_after'     => '</span>',
                    ) );
                } ?>
            </div>
            <?php if ( ! has_nav_menu( 'social' ) ) : ?>
            <p>
                <?php esc_html_e( 'Social menu is not set. You need to create menu and assign it to Social Menu on Menu Settings.', 'suffix-lite' ); ?>
            </p>
        <?php endif; ?>
            <?php echo $args['after_widget'];
        }
    }
endif;
if (!class_exists('Suffix_Lite_Widget_Slider')) :
    /**
     * Latest news widget Class.
     *
     * @since 1.0.0
     */
    class Suffix_Lite_Widget_Slider extends Suffix_Lite_Widget_Base
    {
        /**
         * Sets up a new widget instance.
         *
         * @since 1.0.0
         */
        function __construct()
        {
            $opts = array(
                'classname' => 'suffix_lite_slider_widget',
                'description' => __('Displays posts from selected category in slider', 'suffix-lite'),
                'customize_selective_refresh' => true,
            );
            $fields = array(
                'post_category' => array(
                    'label' => __('Select Category:', 'suffix-lite'),
                    'type' => 'dropdown-taxonomies',
                    'show_option_all' => __('All Categories', 'suffix-lite'),
                ),
                'disable_content_on_slider' => array(
                    'label' => __('Enable Content on Main Slider', 'suffix-lite'),
                    'type' => 'checkbox',
                    'default' => true,
                ),
                'post_number' => array(
                    'label' => __('Number of Posts:', 'suffix-lite'),
                    'type' => 'number',
                    'default' => 4,
                    'css' => 'max-width:60px;',
                    'min' => 1,
                    'max' => 10,
                ),
                'select_image_size' => array(
                    'label' => __('Select Image Size', 'suffix-lite'),
                    'type' => 'select',
                    'default' => 'suffix-lite-725-480',
                    'options' => array(
                        'thumbnail' => esc_html__( 'Thumbnail', 'suffix-lite' ),
                        'medium' => esc_html__( 'Medium', 'suffix-lite' ),
                        'medium_large' => esc_html__( 'Medium Large', 'suffix-lite' ),
                        'large' => esc_html__( 'Large', 'suffix-lite' ),
                        'full' => esc_html__( 'Full', 'suffix-lite' ),
                        'suffix-lite-400-260'    => esc_html__( 'Image 400 x 260', 'suffix-lite' ),
                        'suffix-lite-725-480'    => esc_html__( 'Image 720 x 480', 'suffix-lite' ),
                        ),
                    
                ),
                'enable_slider_nav' => array(
                    'label' => __('Enable Slider Nav', 'suffix-lite'),
                    'type' => 'checkbox',
                    'default' => true,
                ),
                'enable_meta' => array(
                    'label' => __('Enable Post Meta', 'suffix-lite'),
                    'type' => 'checkbox',
                    'default' => false,
                ),
                'disable_content_on_slider_nav' => array(
                    'label' => __('Enable Content on Main Slider Nav', 'suffix-lite'),
                    'type' => 'checkbox',
                    'default' => false,
                ),
            );
            parent::__construct('suffix-lite-slider-layout', __('SFX: Slider Widget', 'suffix-lite'), $opts, array(), $fields);
        }
        /**
         * Outputs the content for the current widget instance.
         *
         * @since 1.0.0
         *
         * @param array $args Display arguments.
         * @param array $instance Settings for the current widget instance.
         */
        function widget($args, $instance)
        {
            $params = $this->get_params($instance);
            echo $args['before_widget'];
            $qargs = array(
                'posts_per_page' => esc_attr($params['post_number']),
                'no_found_rows' => true,
            );
            if (absint($params['post_category']) > 0) {
                $qargs['category'] = absint($params['post_category']);
            }
            $all_posts = get_posts($qargs);
            ?>
            <?php if (!empty($all_posts)) : ?>
            <?php global $post;
            $author_id = $post->post_author;
            ?>
            <?php $rtl_class_c = 'false';
            if(is_rtl()){ 
                $rtl_class_c = 'true';
            }?>
            <div class="twp-slider-widget" <?php if (true == $params['enable_slider_nav']) { ?>data-slick='{"asNavFor": ".slider-nav" , "rtl": <?php echo($rtl_class_c); ?>}'<?php } ?>>
                <?php foreach ($all_posts as $key => $post) : ?>
                    <?php setup_postdata($post); ?>
                    <?php if (has_post_thumbnail()) {
                        $select_image_size = esc_attr($params['select_image_size']);
                        $thumb = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), $select_image_size);
                        $url = $thumb['0'];
                    } else {
                        $url = '';
                    }
                    ?>
                    <figure class="slick-item">
                        <div class="data-bg data-bg-slide" data-background="<?php echo esc_url($url); ?>">
                            <?php if (true == $params['disable_content_on_slider']) { ?>
                                <figcaption class="slider-figcaption">
                                    <div class="slider-figcaption-wrapper">
                                        <div class="title-wrap">
                                            <div class="item-metadata twp-meta-categories">
                                                <?php suffix_lite_entry_category(); ?>
                                            </div>
                                            <h2 class="slide-title">
                                                <a href="<?php the_permalink(); ?>">
                                                    <?php the_title(); ?>
                                                </a>
                                            </h2>
                                            <div class="post-meta">
                                                <span>
                                                    <?php echo esc_html__('Posted on: ', 'suffix-lite'); ?><?php the_time('F j, Y'); ?>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </figcaption>
                        <?php } ?>
                        </div>
                    </figure>
                <?php endforeach; ?>
            </div>

            <?php if (true == $params['enable_slider_nav']) { ?>
            <!-- Slider Pagination-->
            <div class="slider-nav" data-slick='{"asNavFor": ".twp-slider-widget"}'>
                <?php foreach ($all_posts as $key => $post) : ?>
                    <?php setup_postdata($post); ?>
                    <?php if (has_post_thumbnail()) {
                        $select_image_size = esc_attr($params['select_image_size']);
                    } ?>
                        <div class="slide-nav-item">
                            <?php if (has_post_thumbnail()) { ?>
                                <div class="post-image">
                                    <div class="bg-image carousal-bg-image">
                                        <?php
                                           the_post_thumbnail($select_image_size, array(
                                               'alt' => the_title_attribute(array(
                                                   'echo' => false,
                                               )),
                                           ));
                                        ?>
                                    </div>
                                </div>
                            <?php } ?>
                            <?php if (true == $params['disable_content_on_slider_nav']) { ?>
                                <div class="post-content post-content-1">
                                    <?php if (true === $params['enable_meta']) { ?>
                                        <div class="post-meta">
                                            <span><?php echo esc_html__('Posted on: ', 'suffix-lite'); ?><?php the_time('F j, Y'); ?></span>
                                        </div>
                                    <?php } ?>
                                    <h3 class="small-title">
                                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                    </h3>
                                </div>
                            <?php } ?>
                        </div>
                    <?php endforeach; ?>
            </div>
            <!-- Slider Pagination-->
            <?php } ?>


            <?php wp_reset_postdata(); ?>
            <?php endif; ?>
            <?php echo $args['after_widget'];
        }
    }
endif;
/*author widget*/
if (!class_exists('Suffix_Lite_Author_Post_Widget')):

    /**
     * Author widget Class.
     *
     * @since 1.0.0
     */
    class Suffix_Lite_Author_Post_Widget extends Suffix_Lite_Widget_Base {

        /**
         * Sets up a new widget instance.
         *
         * @since 1.0.0
         */
        function __construct() {
            $opts = array(
                'classname'                   => 'suffix_lite_author_widget',
                'description'                 => __('Displays authors details in post.', 'suffix-lite'),
                'customize_selective_refresh' => true,
            );
            $fields = array(
                'title'  => array(
                    'label' => __('Title:', 'suffix-lite'),
                    'type'  => 'text',
                    'class' => 'widefat',
                ),
                'author-name' => array(
                    'label'      => __('Name:', 'suffix-lite'),
                    'type'       => 'text',
                    'class'      => 'widefat',
                ),
                'discription' => array(
                    'label'      => __('Description:', 'suffix-lite'),
                    'type'       => 'textarea',
                    'class'      => 'widget-content widefat',
                ),
                'image_url' => array(
                    'label'    => __('Author Image:', 'suffix-lite'),
                    'type'     => 'image',
                ),
                'url-fb' => array(
                    'label' => __('Facebook URL:', 'suffix-lite'),
                    'type'  => 'url',
                    'class' => 'widefat',
                ),
                'url-tw' => array(
                    'label' => __('Twitter URL:', 'suffix-lite'),
                    'type'  => 'url',
                    'class' => 'widefat',
                ),
                'url-gp' => array(
                    'label' => __('Googleplus URL:', 'suffix-lite'),
                    'type'  => 'url',
                    'class' => 'widefat',
                ),
                'url-ins' => array(
                    'label'  => __('Instagram URL:', 'suffix-lite'),
                    'type'   => 'url',
                    'class'  => 'widefat',
                ),
            );

            parent::__construct('suffix-lite-author-layout', __('SFX: Author Widget', 'suffix-lite'), $opts, array(), $fields);
        }

        /**
         * Outputs the content for the current widget instance.
         *
         * @since 1.0.0
         *
         * @param array $args Display arguments.
         * @param array $instance Settings for the current widget instance.
         */
        function widget($args, $instance) {

            $params = $this->get_params($instance);

            echo $args['before_widget'];
            echo '<div class="author-widget-title">';
            if (!empty($params['title'])) {
                echo esc_html($params['title']);
            }
            echo '</div>';
            ?>
            <div class="author-info">
                <div class="author-image">
                    <?php if (!empty($params['image_url'])) {?>
                        <div class="profile-image bg-image">
                            <img src="<?php echo esc_url($params['image_url']);?>">
                        </div>
                    <?php }?>
                </div> <!-- /#author-image -->
                <div class="author-details">
                    <?php if (!empty($params['author-name'])) {?>
                        <h3 class="author-name"><?php echo esc_html($params['author-name']);?></h3>
                    <?php }?>
                    <?php if (!empty($params['discription'])) {?>
                        <p><?php echo wp_kses_post($params['discription']);?></p>
                    <?php }?>
                </div> <!-- /#author-details -->
                <div class="author-social">
                    <?php if (!empty($params['url-fb'])) {?>
                        <a href="<?php echo esc_url($params['url-fb']);?>" target="_blank">
                            <i class="meta-icon fa fa-facebook"></i>
                        </a>
                    <?php }?>
                    <?php if (!empty($params['url-tw'])) {?>
                        <a href="<?php echo esc_url($params['url-tw']);?>" target="_blank">
                            <i class="meta-icon fa fa-twitter"></i>
                        </a>
                    <?php }?>
                    <?php if (!empty($params['url-gp'])) {?>
                        <a href="<?php echo esc_url($params['url-gp']);?>" target="_blank">
                            <i class="meta-icon fa fa-google-plus"></i>
                        </a>
                    <?php }?>
                    <?php if (!empty($params['url-ins'])) {?>
                        <a href="<?php echo esc_url($params['url-ins']);?>" target="_blank">
                            <i class="meta-icon fa fa-instagram"></i>
                        </a>
                    <?php }?>
                </div>
            </div>
            <?php echo $args['after_widget'];
        }
    }
endif;
