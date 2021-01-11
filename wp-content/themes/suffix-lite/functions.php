<?php
/**
 * suffix functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package suffix
 */

if (!function_exists('suffix_lite_setup')) :
    /**
     * Sets up theme defaults and registers support for various WordPress features.
     *
     * Note that this function is hooked into the after_setup_theme hook, which
     * runs before the init hook. The init hook is too late for some features, such
     * as indicating support for post thumbnails.
     */
    function suffix_lite_setup()
    {
        /*
         * Make theme available for translation.
         * Translations can be filed in the /languages/ directory.
         * If you're building a theme based on suffix, use a find and replace
         * to change 'suffix-lite' to the name of your theme in all the template files.
         */
        load_theme_textdomain( 'suffix-lite', get_template_directory() . '/languages');


        // Add default posts and comments RSS feed links to head.
        add_theme_support('automatic-feed-links');

        /*
         * Let WordPress manage the document title.
         * By adding theme support, we declare that this theme does not use a
         * hard-coded <title> tag in the document head, and expect WordPress to
         * provide it for us.
         */
        add_theme_support('title-tag');

        /*
         * Enable support for custom logo.
         */
        add_theme_support('custom-logo', array(
            'header-text' => array('site-title', 'site-description'),
        ));
        /*
         * Enable support for Post Thumbnails on posts and pages.
         *
         * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
         */
        add_theme_support('post-thumbnails');
        add_image_size('suffix-lite-400-260', 400, 260, true);
        add_image_size('suffix-lite-725-480', 725, 480, true);


        // Set up the WordPress core custom header feature.
        add_theme_support('custom-header', apply_filters('suffix_lite_custom_header_args', array(
            'width' => 1600,
            'height' => 380,
            'flex-height' => true,
            'header-text' => false,
            'default-text-color' => '000',
        )));

        // This theme uses wp_nav_menu() in one location.
        register_nav_menus(array(
            'primary' => esc_html__('Primary Menu', 'suffix-lite'),
            'footer' => esc_html__('Footer Menu', 'suffix-lite'),
            'social' => esc_html__('Social Menu', 'suffix-lite'),
        ));

        /*
         * Switch default core markup for search form, comment form, and comments
         * to output valid HTML5.
         */
        add_theme_support('html5', array(
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
        ));
        /*
         * Enable support for Post Formats.
         *
         * See: https://codex.wordpress.org/Post_Formats
         */
        add_theme_support('post-formats', array(
            'image',
            'video',
            'gallery',
            'audio',
        ));
        
        // Set up the WordPress core custom background feature.
        add_theme_support('custom-background', apply_filters('suffix_lite_custom_background_args', array(
            'default-color' => 'ffffff',
            'default-image' => '',
        )));

        /**
         * Load Init for Hook files.
         */
        require get_template_directory() . '/inc/hooks/hooks-init.php';

    }
endif;
add_action('after_setup_theme', 'suffix_lite_setup');

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function suffix_lite_content_width()
{
    $GLOBALS['content_width'] = apply_filters('suffix_lite_content_width', 640);
}

add_action('after_setup_theme', 'suffix_lite_content_width', 0);

/**
 * function for google fonts
 */
if (!function_exists('suffix_lite_fonts_url')):

/**
 * Return fonts URL.
 *
 * @since 1.0.0
 * @return string Fonts URL.
 */
function suffix_lite_fonts_url() {
    $fonts_url = '';
    $fonts     = array();

    $suffix_lite_primary_font   = suffix_lite_get_option('primary_font');
    $suffix_lite_secondary_font   = suffix_lite_get_option('secondary_font');

    $suffix_lite_fonts   = array();
    $suffix_lite_fonts[] = $suffix_lite_primary_font;
    $suffix_lite_fonts[] = $suffix_lite_secondary_font;

    $suffix_lite_fonts_stylesheet = '//fonts.googleapis.com/css?family=';

    $i = 0;
    for ($i = 0; $i < count($suffix_lite_fonts); $i++) {

        if ('off' !== sprintf(_x('on', '%s font: on or off', 'suffix-lite'), $suffix_lite_fonts[$i])) {
            $fonts[] = $suffix_lite_fonts[$i];
        }

    }

    if ($fonts) {
        $fonts_url = add_query_arg(array(
                'family' => urldecode(implode('|', $fonts)),
            ), 'https://fonts.googleapis.com/css');
    }

    return $fonts_url;
}

endif;
/**
 * Enqueue scripts and styles.
 */
function suffix_lite_scripts()
{
    $min = defined('SCRIPT_DEBUG') && SCRIPT_DEBUG ? '' : '.min';
    wp_enqueue_style('jquery-slick', get_template_directory_uri() . '/assets/libraries/slick/css/slick' . $min . '.css');
    wp_enqueue_style('font-awesome', get_template_directory_uri() . '/assets/libraries/font-awesome/css/font-awesome' . $min . '.css');
    wp_enqueue_style('sidr-nav', get_template_directory_uri().'/assets/libraries/sidr/css/jquery.sidr.dark.css');
    wp_enqueue_style('magnific-popup', get_template_directory_uri().'/assets/libraries/magnific-popup/magnific-popup.css');
    wp_enqueue_style('suffix-lite-style', get_stylesheet_uri());
    wp_add_inline_style('suffix-lite-style', suffix_lite_trigger_custom_css_action());

    $fonts_url = suffix_lite_fonts_url();
    if (!empty($fonts_url)) {
        wp_enqueue_style('suffix-lite-google-fonts', $fonts_url, array(), null);
    }
    wp_enqueue_script('suffix-lite-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true);

    wp_enqueue_script('suffix-lite-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true);

    wp_enqueue_script('jquery-slick', get_template_directory_uri() . '/assets/libraries/slick/js/slick' . $min . '.js', array('jquery'), '', true);
    wp_enqueue_script('headroom', get_template_directory_uri() . '/assets/libraries/headroom/headroom.js', array('jquery'), '', true);
    wp_enqueue_script('jquery-headroom', get_template_directory_uri() . '/assets/libraries/headroom/jQuery.headroom.js', array('jquery'), '', true);
    wp_enqueue_script('jquery-sidr', get_template_directory_uri().'/assets/libraries/sidr/js/jquery.sidr'. $min .'.js', array('jquery'), '', true);
    wp_enqueue_script('jquery-magnific-popup', get_template_directory_uri().'/assets/libraries/magnific-popup/jquery.magnific-popup'. $min .'.js', array('jquery'), '', true);
    wp_enqueue_script('jquery-sticky-sidebar', get_template_directory_uri() . '/assets/libraries/theiaStickySidebar/theia-sticky-sidebar' . $min . '.js', array('jquery'), '', true);
    wp_enqueue_script('marquee', get_template_directory_uri() . '/assets/libraries/marquee/jquery.marquee' . $min . '.js', array('jquery'), '', true);
    wp_enqueue_script('suffix-lite-script', get_template_directory_uri() . '/assets/twp/js/custom-script.js', array('jquery'), '', 1);

    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}

add_action('wp_enqueue_scripts', 'suffix_lite_scripts');

/**
 * Enqueue admin scripts and styles.
 */
function suffix_lite_admin_scripts($hook)
{
    if ('widgets.php' === $hook) {
        wp_enqueue_media();
        wp_enqueue_script('suffix-lite-custom-widgets', get_template_directory_uri() . '/assets/twp/js/widgets.js', array('jquery'), '1.0.0', true);
    }
    wp_enqueue_style('suffix-lite-admin-css', get_template_directory_uri() . '/assets/twp/css/admin.css');


}

add_action('admin_enqueue_scripts', 'suffix_lite_admin_scripts');

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';


/**
 * Customizer control scripts and styles.
 *
 * @since 1.0.5
 */
function suffix_lite_customizer_control_scripts()
{

    wp_enqueue_style('suffix-lite-customize-controls', get_template_directory_uri() . '/assets/twp/css/customize-controls.css');

}

add_action('customize_controls_enqueue_scripts', 'suffix_lite_customizer_control_scripts', 0);

//* Add description to menu items
add_filter( 'walker_nav_menu_start_el', 'suffix_lite_add_description', 10, 2 );
function suffix_lite_add_description( $item_output, $item ) {
    $description = $item->post_content;
    if (('' !== $description) && (' ' !== $description) ) {
        return preg_replace( '/(<a.*)</', '$1' . '<span class="menu-description">' . $description . '</span><', $item_output) ;
    }
    else {
        return $item_output;
    };
}