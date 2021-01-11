<?php 

/**
 * Theme Options Panel.
 *
 * @package suffix
 */

$default = suffix_lite_get_default_theme_options();

// Setting footer_secondary_logo.
$wp_customize->add_setting('footer_secondary_logo',
	array(
		'default'           => $default['footer_secondary_logo'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'suffix_lite_sanitize_image',
	)
);
$wp_customize->add_control(
	new WP_Customize_Image_Control($wp_customize, 'footer_secondary_logo',
		array(
			'label'       => esc_html__('Footer Secondary Logo', 'suffix-lite'),
			'section'     => 'title_tagline',
			'priority'    => 120,
		)
	)
);

// Add Theme Options Panel.
$wp_customize->add_panel( 'theme_front_page_section',
	array(
		'title'      => esc_html__( 'Home/Front Page Settings', 'suffix-lite' ),
		'priority'   => 200,
		'capability' => 'edit_theme_options',
	)
);

	/*homepage section*/
	require get_template_directory() . '/inc/customizer/breaking-news.php';
	require get_template_directory() . '/inc/customizer/top-bar.php';
	require get_template_directory() . '/inc/customizer/slider.php';
	require get_template_directory() . '/inc/customizer/featured-post.php';