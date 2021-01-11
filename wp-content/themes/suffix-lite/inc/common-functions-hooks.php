<?php
if (!function_exists('suffix_lite_the_custom_logo')):
/**
 * Displays the optional custom logo.
 *
 * Does nothing if the custom logo is not available.
 *
 * @since suffix 1.0.0
 */
function suffix_lite_the_custom_logo() {
	if (function_exists('the_custom_logo')) {
		the_custom_logo();
	}
}
endif;

if (!function_exists('suffix_lite_body_class')):

/**
 * body class.
 *
 * @since 1.0.0
 */
function suffix_lite_body_class($suffix_lite_body_class) {
	global $post;
	$global_layout       = suffix_lite_get_option('global_layout');
	$input               = '';
	$home_content_status = suffix_lite_get_option('home_page_content_status');
	if (1 != $home_content_status) {
		$input = 'home-content-not-enabled';
	}
	// Check if single.
	if ($post && is_singular()) {
		$post_options = get_post_meta($post->ID, 'suffix-lite-meta-select-layout', true);
		if (empty($post_options)) {
			$global_layout = esc_attr(suffix_lite_get_option('global_layout'));
		} else {
			$global_layout = esc_attr($post_options);
		}
	}
	if ($global_layout == 'left-sidebar') {
		$suffix_lite_body_class[] = 'left-sidebar '.esc_attr($input);
	} elseif ($global_layout == 'no-sidebar') {
		$suffix_lite_body_class[] = 'no-sidebar '.esc_attr($input);
	} else {
		$suffix_lite_body_class[] = 'right-sidebar '.esc_attr($input);

	}
	return $suffix_lite_body_class;
}
endif;

add_action('body_class', 'suffix_lite_body_class');
/**
 * Returns word count of the sentences.
 *
 * @since suffix 1.0.0
 */
if (!function_exists('suffix_lite_words_count')):
function suffix_lite_words_count($length = 25, $suffix_lite_content = null) {
	$length          = absint($length);
	$source_content  = preg_replace('`\[[^\]]*\]`', '', $suffix_lite_content);
	$trimmed_content = wp_trim_words($source_content, $length, '...');
	return $trimmed_content;
}
endif;

if (!function_exists('suffix_lite_simple_breadcrumb')):

/**
 * Simple breadcrumb.
 *
 * @since 1.0.0
 */
function suffix_lite_simple_breadcrumb() {

	if (!function_exists('breadcrumb_trail')) {

		require_once get_template_directory().'/assets/libraries/breadcrumbs/breadcrumbs.php';
	}

	$breadcrumb_args = array(
		'container'   => 'div',
		'show_browse' => false,
	);
	breadcrumb_trail($breadcrumb_args);

}

endif;

if (!function_exists('suffix_lite_custom_posts_navigation')):
/**
 * Posts navigation.
 *
 * @since 1.0.0
 */
function suffix_lite_custom_posts_navigation() {

	$pagination_type = suffix_lite_get_option('pagination_type');

	switch ($pagination_type) {

		case 'default':
			the_posts_navigation();
			break;

		case 'numeric':
			the_posts_pagination();
			break;

		default:
			break;
	}

}
endif;

add_action('suffix_lite_action_posts_navigation', 'suffix_lite_custom_posts_navigation');

if (!function_exists('suffix_lite_excerpt_length')):

/**
 * Excerpt length
 *
 * @since  suffix 1.0.0
 *
 * @param null
 * @return int
 */
function suffix_lite_excerpt_length($length) {
	if ( is_admin() ) {
	        return $length;
	}
	$excerpt_length = suffix_lite_get_option('excerpt_length_global');
	if (absint($excerpt_length) > 0) {
		$excerpt_length = absint($excerpt_length);
	}

	return absint($excerpt_length);

}

endif;
add_filter('excerpt_length', 'suffix_lite_excerpt_length', 999);

if (!function_exists('suffix_lite_excerpt_more')):

/**
 * Implement read more in excerpt.
 *
 * @since 1.0.0
 *
 * @param string $more The string shown within the more link.
 * @return string The excerpt.
 */
function suffix_lite_excerpt_more($more) {
	if ( is_admin() ) {
	        return $more;
	}
	$flag_apply_excerpt_read_more = apply_filters('suffix_lite_filter_excerpt_read_more', true);
	if (true !== $flag_apply_excerpt_read_more) {
		return $more;
	}

	$output         = $more;
	$read_more_text = esc_html(suffix_lite_get_option('read_more_button_text'));
	if (!empty($read_more_text)) {
		$output = ' <a href="'.esc_url(get_permalink()).'" class="read-more button-fancy -red">'.'<span class="btn-arrow"></span><span class="twp-read-more text">'.esc_html($read_more_text).'</span>'.'</a>';
		$output = apply_filters('suffix_lite_filter_read_more_link', $output);
	}
	return $output;

}

add_filter('excerpt_more', 'suffix_lite_excerpt_more');
endif;

/*related post*/
if (!function_exists('suffix_lite_get_related_posts')) :
    /*
     * Function to get related posts
     */
    function suffix_lite_get_related_posts()
    {
        global $post;

        //$options = suffix_lite_get_theme_options(); // get theme options

        $post_categories = get_the_category($post->ID); // get category object
        $category_ids = array(); // set an empty array

        foreach ($post_categories as $post_category) {
            $category_ids[] = $post_category->term_id;
        }

        if (empty($category_ids)) return;

        $qargs = array(
            'posts_per_page' => 4,
            'category__in' => $category_ids,
            'post__not_in' => array($post->ID),
            'order' => 'ASC',
            'orderby' => 'rand'
        );

        $related_posts = get_posts($qargs); // custom posts
        ?>
        <div class="related-articles">
            <header class="related-header">
                <h2 class="block-title">
                    <?php esc_html_e('You May Also Like', 'suffix-lite'); ?>
                </h2>
            </header>

            <div class="entry-content">
                <?php foreach ($related_posts as $related_post) {
                    $post_title = get_the_title($related_post->ID);
                    $post_url = get_permalink($related_post->ID);
                    $post_date = get_the_date('', $related_post->ID);
                    $post_author = get_the_author_meta( 'display_name', $related_post->ID );
                    $posts_categories = get_the_category($related_post->ID);
                    ?>

                    <div class="suggested-article">
                        <?php if (has_post_thumbnail($related_post->ID)) {
                            $img_array = wp_get_attachment_image_src(get_post_thumbnail_id($related_post->ID), 'thumbnail'); ?>
                          <div class="post-image">
                              <a href="<?php echo esc_url($post_url); ?>" class="twp-image-wrapper">
                                  <img src="<?php echo esc_url($img_array[0]); ?>" alt="<?php echo esc_attr($post_title); ?>">
                              </a>
                          </div>
                        <?php } ?>
                        <div class="related-content">
                            <div class="related-article-title">
                                <h4 class="entry-title entry-title-small">
                                    <a href="<?php echo esc_url($post_url); ?>"><?php echo wp_kses_post($post_title); ?></a>
                                </h4>
                            </div>
                            <div class="entry-meta small-font primary-font">
                                <?php echo esc_html('Posted on: ','suffix-lite').$post_date; ?>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
        <?php
    }
endif;
add_action('suffix_lite_related_posts', 'suffix_lite_get_related_posts');


if (!function_exists('suffix_lite_recommended_plugins')):

/**
 * Recommended plugins
 *
 */
function suffix_lite_recommended_plugins() {
	$suffix_lite_plugins = array(
        array(
            'name'     => __('Social Share With Floating Bar', 'suffix-lite'),
            'slug'     => 'social-share-with-floating-bar',
            'required' => false,
        ),
	);
	$suffix_lite_plugins_config = array(
		'dismissable' => true,
	);

	tgmpa($suffix_lite_plugins, $suffix_lite_plugins_config);
}
endif;
add_action('tgmpa_register', 'suffix_lite_recommended_plugins');