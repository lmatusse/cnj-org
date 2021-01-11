<?php
/**
 * slider section
 *
 * @package suffix
 */

$default = suffix_lite_get_default_theme_options();

// Featured News Section.
$wp_customize->add_section( 'featured_news_section_settings',
	array(
		'title'      => esc_html__( 'Featured News Section', 'suffix-lite' ),
		'priority'   => 70,
		'capability' => 'edit_theme_options',
		'panel'      => 'theme_front_page_section',
	)
);


// Setting - show_featured_news_section.
$wp_customize->add_setting( 'show_featured_news_section',
	array(
		'default'           => $default['show_featured_news_section'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'suffix_lite_sanitize_checkbox',
	)
);
$wp_customize->add_control( 'show_featured_news_section',
	array(
		'label'    => esc_html__( 'Enable Featured News', 'suffix-lite' ),
		'section'  => 'featured_news_section_settings',
		'type'     => 'checkbox',
		'priority' => 10,
	)
);


// Setting - featured_news_title.
$wp_customize->add_setting( 'featured_news_title',
	array(
		'default'           => $default['featured_news_title'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control( 'featured_news_title',
	array(
		'label'    => esc_html__( 'Section Title', 'suffix-lite' ),
		'section'  => 'featured_news_section_settings',
		'type'     => 'text',
		'priority' => 15,

	)
);

// Setting - drop down category for Featured Newssection.
$wp_customize->add_setting( 'select_category_for_featured_news',
	array(
		'default'           => $default['select_category_for_featured_news'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'absint',
	)
);
$wp_customize->add_control( new Suffix_Lite_Dropdown_Taxonomies_Control( $wp_customize, 'select_category_for_featured_news',
	array(
        'label'           => esc_html__( 'Category for Featured News', 'suffix-lite' ),
        'description'     => esc_html__( 'Select category to be shown below slider ', 'suffix-lite' ),
        'section'         => 'featured_news_section_settings',
        'type'            => 'dropdown-taxonomies',
        'taxonomy'        => 'category',
		'priority'    	  => 20,
    ) ) );

$wp_customize->add_setting( 'featured_post_image_option',
	array(
		'default'           => $default['featured_post_image_option'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'suffix_lite_sanitize_select',
	)
);
$wp_customize->add_control( 'featured_post_image_option',
	array(
		'label'    => esc_html__( 'Image Size', 'suffix-lite' ),
		'section'  => 'featured_news_section_settings',
		'choices'  => array(
            'medium' => esc_html__( 'Medium', 'suffix-lite' ),
            'large' => esc_html__( 'Large', 'suffix-lite' ),
            'suffix-lite-400-260'    => esc_html__( 'Image 400 x 260', 'suffix-lite' ),
            'suffix-lite-725-480'    => esc_html__( 'Image 720 x 480', 'suffix-lite' ),
		    ),
		'type'     => 'select',
		'priority' => 20,
	)
);


$wp_customize->add_setting( 'show_post_meta_featured_news',
	array(
		'default'           => $default['show_post_meta_featured_news'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'suffix_lite_sanitize_checkbox',
	)
);
$wp_customize->add_control( 'show_post_meta_featured_news',
	array(
		'label'    => esc_html__( 'Enable Post Meta on Featured News', 'suffix-lite' ),
		'section'  => 'featured_news_section_settings',
		'type'     => 'checkbox',
		'priority' => 20,
	)
);

$wp_customize->add_setting( 'featured_article_title_color',
	array(
		'default'           => $default['featured_article_title_color'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_hex_color',
	)
);
$wp_customize->add_control( 'featured_article_title_color',
	array(
		'label'    => __( 'Section Article Title Color', 'suffix-lite' ),
		'section'  => 'featured_news_section_settings',
		'type'     => 'color',
		'priority' => 150,
	)
);