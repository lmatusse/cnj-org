<?php
/**
 * yala mag functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package yala_mag
 */

if ( ! function_exists( 'yala_mag_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function yala_mag_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on yala mag, use a find and replace
		 * to change 'yala-mag' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'yala-mag', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );
		add_theme_support( 'align-wide' );
		add_theme_support( 'editor-styles' );
		add_theme_support( 'wp-block-styles' );
		add_theme_support( 'responsive-embeds' );

		// Thumbnail sizes 
		add_image_size( 'yala-mag-101_80', 101, 80, true );
		add_image_size( 'yala-mag-350_270', 350, 270, true );
		add_image_size( 'yala-mag-690_460', 690, 460, true );
		add_image_size( 'yala-mag-50_50', 50, 50, true );
		add_image_size( 'yala-mag-334_417', 334, 417, true );
		
		// News slider sidebar 
		add_image_size( 'mag-thumbnail-12', 80, 80, true );
		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'primary' => esc_html__( 'Primary', 'yala-mag' ),
			'top-menu' => esc_html__( 'Top Menu', 'yala-mag' ),
			'footer-menu' => esc_html__( 'Footer Menu', 'yala-mag' ),
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'yala_mag_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 60,
			'width'       => 320,
			'flex-width'  => true,
			'flex-height' => true,
		) );
	}
endif;
add_action( 'after_setup_theme', 'yala_mag_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function yala_mag_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'yala_mag_content_width', 640 );
}
add_action( 'after_setup_theme', 'yala_mag_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function yala_mag_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'yala-mag' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'yala-mag' ),
		'before_widget' => '<div id="%1$s" class="single-sidebar %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h2 class="widget-title"><i class="fa fa-pencil"> </i><span>',
		'after_title'   => '</span></h2>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Frontpage Layouts Area', 'yala-mag' ),
		'id'            => 'frontpage-layout',
		'description'   => esc_html__( 'Add widgets here.', 'yala-mag' ),
		'before_widget' => '',
		'after_widget'  => '',
		'before_title'  => '<h2 class="cat-title"><span>',
		'after_title'   => '</span></h2>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer widget Area', 'yala-mag' ),
		'id'            => 'footer-widget',
		'description'   => esc_html__( 'Add widgets here.', 'yala-mag' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s col-lg-4 col-md-6 col-12">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3>',
		'after_title'   => '</h3>',
	) );
}
add_action( 'widgets_init', 'yala_mag_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function yala_mag_scripts() {
	// Google font
	wp_enqueue_style( 'google-font', 'https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700', array(), '' );

	// Bootstrap CSS
	wp_enqueue_style( 'bootstrap', get_template_directory_uri() .'/css/bootstrap.css', array(), '4.0.0' );

	// animate CSS
	wp_enqueue_style( 'animate', get_template_directory_uri() .'/css/animate.css', array(), '1.0.0' );

	// fontawesome CSS
	wp_enqueue_style( 'font-awesome', get_template_directory_uri() .'/css/font-awesome.css', array(), '4.7.0' );

	// jquery fancybox CSS
	wp_enqueue_style( 'jquery-fancybox', get_template_directory_uri() .'/css/jquery.fancybox.css', array(), '1.0.0' );

	//Magnific CSS
	wp_enqueue_style( 'magnific-popup', get_template_directory_uri() .'/css/magnific-popup.css', array(), '1.0.0' );

	// Slicknav CSS
	wp_enqueue_style( 'slicknav', get_template_directory_uri() .'/css/slicknav.css', array(), '1.0.10' );

	// Owl Carausel CSS
	wp_enqueue_style( 'owl-carousel', get_template_directory_uri() .'/css/owl-carousel.css', array(), '2.2.1' );

	// Reset CSS
	wp_enqueue_style( 'mag-reset', get_template_directory_uri() .'/css/reset.css', array(), '1.0.0' );

	wp_enqueue_style( 'mag-style', get_stylesheet_uri() );

	// Responsive CSS
	wp_enqueue_style( 'mag-responsive', get_template_directory_uri() .'/css/responsive.css', array(), '1.0.0' );

	// Popper JS
	wp_enqueue_script( 'popper', get_template_directory_uri() . '/js/popper.js', array('jquery'), '3.3.1', true );

	// Bootstrap JS
	wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/js/bootstrap.js', array('jquery'), '4.4.1', true );

	// modernizr JS
	wp_enqueue_script( 'modernizr', get_template_directory_uri() . '/js/modernizr.js', array('jquery'), '2.8.3', true );

	// ScrollUp JS
	wp_enqueue_script( 'jquery-scrollUp', get_template_directory_uri() . '/js/jquery.scrollUp.js', array('jquery'), '2.4.1', true );

	// FacnyBox JS 
	wp_enqueue_script( 'jquery-fancybox', get_template_directory_uri() . '/js/jquery.fancybox.js', array('jquery'), '3.1.20', true );

	// Slick Nav JS
	wp_enqueue_script( 'jquery-slicknav', get_template_directory_uri() . '/js/jquery.slicknav.js', array('jquery'), '1.0.10', true );

	// Owl Slider JS
	wp_enqueue_script( 'owl-carousel', get_template_directory_uri() . '/js/owl.carousel.js', array('jquery'), '2.2.1', true );

	// easing JS
	wp_enqueue_script( 'easing', get_template_directory_uri() . '/js/easing.js', array('jquery'), '1.4.1', true );

	//Magnific Popup JS
	wp_enqueue_script( 'magnific-popup', get_template_directory_uri() . '/js/magnific-popup.js', array('jquery'), '1.1.0', true );

	// Active JS
	wp_enqueue_script( 'mag-active', get_template_directory_uri() . '/js/active.js', array('jquery'), '1.1.0', true );

	wp_enqueue_script( 'mag-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );

	wp_enqueue_script( 'mag-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'yala_mag_scripts' );

function yala_mag_excerpt_length( $length ) {
    return 20;
}
add_filter( 'excerpt_length', 'yala_mag_excerpt_length', 999 );

/*Bootstrap Pagination Function*/
function yala_mag_pagination($pages = '', $range = 4)
{  
	$showitems = ($range * 2) + 1;  
	$paged = get_query_var( 'paged');

	if(empty($paged)) $paged = 1;
	if($pages == '')
	{
		global $wp_query; 
		$pages = $wp_query->max_num_pages;
		if(!$pages)
		{
			$pages = 1;
		}
	}   

	if(1 != $pages)
	{
		echo '<ul class="pagination">';
		if($paged > 1 ) echo "<li class='prev'><a href='".esc_url(get_pagenum_link($paged - 1))."'><i class='fa fa-angle-double-left'></i></a></li>";
		for ($i=1; $i <= $pages; $i++)
		{
			if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
			{
				echo ($paged == $i)? "<li class=\"active\"><a href='".esc_url(get_pagenum_link($i))."'>".esc_html($i)."</a></li>":"<li><a href='".esc_url(get_pagenum_link($i))."'>".esc_html($i)."</a></li>";
			}
		}

		if ($paged < $pages ) echo "<li class='next'><a href=\"".esc_url(get_pagenum_link($paged + 1))."\"><i class='fa fa-angle-double-right'></i></a></li>";  
		echo "</ul>";
	}
}
/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
* Breadcrumbs
*/
require_once get_template_directory() . '/inc/breadcrumbs.php';

/**
 * Widgets
 */
require get_template_directory() . '/inc/widgets/widgets.php';

/**
 * Recommended Plugins
 */

require get_template_directory() . '/inc/recommended-plugins.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

/**
 * Bootstrap Navwalker
 */
require get_template_directory() . '/inc/wp-bootstrap-navwalker.php';