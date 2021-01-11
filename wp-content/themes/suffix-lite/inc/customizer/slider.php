<?php
/**
 * slider section
 *
 * @package suffix
 */

$default = suffix_lite_get_default_theme_options();

// Slider Main Section.
$wp_customize->add_section( 'slider_section_settings',
	array(
		'title'      => esc_html__( 'Slider Section', 'suffix-lite' ),
		'priority'   => 60,
		'capability' => 'edit_theme_options',
		'panel'      => 'theme_front_page_section',
	)
);


// Setting - show_slider_section.
$wp_customize->add_setting( 'show_slider_section',
	array(
		'default'           => $default['show_slider_section'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'suffix_lite_sanitize_checkbox',
	)
);
$wp_customize->add_control( 'show_slider_section',
	array(
		'label'    => esc_html__( 'Enable Slider', 'suffix-lite' ),
		'section'  => 'slider_section_settings',
		'type'     => 'checkbox',
		'priority' => 100,
	)
);

$wp_customize->add_setting( 'slider_style_option',
	array(
		'default'           => $default['slider_style_option'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'suffix_lite_sanitize_select',
	)
);
$wp_customize->add_control( 'slider_style_option',
	array(
		'label'    => esc_html__( 'Slider Structure', 'suffix-lite' ),
		'section'  => 'slider_section_settings',
		'choices'  => array(
                'single-slider' => esc_html__( 'Single Slider', 'suffix-lite' ),
                'carousel-slider' => esc_html__( 'Carousel Slider', 'suffix-lite' ),
                'slider-text' => esc_html__( 'Slider with content left', 'suffix-lite' ),
                'text-slider' => esc_html__( 'Slider with content right', 'suffix-lite' ),
		    ),
		'type'     => 'select',
		'priority' => 100,
	)
);


$wp_customize->add_setting( 'slider_layout_option',
	array(
		'default'           => $default['slider_layout_option'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'suffix_lite_sanitize_select',
	)
);
$wp_customize->add_control( 'slider_layout_option',
	array(
		'label'    => esc_html__( 'Slider Layout', 'suffix-lite' ),
		'section'  => 'slider_section_settings',
		'choices'  => array(
                'full-width' => esc_html__( 'Full Width', 'suffix-lite' ),
                'boxed' => esc_html__( 'Boxed', 'suffix-lite' ),
		    ),
		'type'     => 'select',
		'priority' => 100,
	)
);


$wp_customize->add_setting('main_slider_number',
	array(
		'default'           => $default['main_slider_number'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'suffix_lite_sanitize_positive_integer',
	)
);
$wp_customize->add_control('main_slider_number',
	array(
		'label'       => esc_html__('Select no of Slider', 'suffix-lite'),
        'description'     => esc_html__( 'Number of Slider to be shown the allowed range is 1 - 6', 'suffix-lite' ),

		'section'     => 'slider_section_settings',
		'type'     => 'number',
		'priority' => 105,
		'input_attrs' => array('min' => 1, 'max' => 6, 'style' => 'width: 150px;'),
	)
);

$wp_customize->add_setting( 'show_slider_content',
	array(
		'default'           => $default['show_slider_content'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'suffix_lite_sanitize_checkbox',
	)
);
$wp_customize->add_control( 'show_slider_content',
	array(
		'label'    => esc_html__( 'Enable Slider Content', 'suffix-lite' ),
		'section'  => 'slider_section_settings',
		'type'     => 'checkbox',
		'priority' => 105,
	)
);
$wp_customize->add_setting('number_of_content_home_slider',
    array(
        'default' => $default['number_of_content_home_slider'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'suffix_lite_sanitize_positive_integer',
    )
);
$wp_customize->add_control('number_of_content_home_slider',
    array(
        'label' => esc_html__('Select no words of slider', 'suffix-lite'),
        'section' => 'slider_section_settings',
        'type' => 'number',
        'priority' => 105,
        'input_attrs' => array('min' => 0, 'max' => 200, 'style' => 'width: 150px;'),

    )
);
$wp_customize->add_setting( 'show_slider_post_meta',
	array(
		'default'           => $default['show_slider_post_meta'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'suffix_lite_sanitize_checkbox',
	)
);
$wp_customize->add_control( 'show_slider_post_meta',
	array(
		'label'    => esc_html__( 'Enable Slider Post Meta', 'suffix-lite' ),
		'section'  => 'slider_section_settings',
		'type'     => 'checkbox',
		'priority' => 105,
	)
);

// Setting - drop down category for slider.
$wp_customize->add_setting( 'select_category_for_slider',
	array(
		'default'           => $default['select_category_for_slider'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'absint',
	)
);
$wp_customize->add_control( new Suffix_Lite_Dropdown_Taxonomies_Control( $wp_customize, 'select_category_for_slider',
	array(
        'label'           => esc_html__( 'Category for slider', 'suffix-lite' ),
        'description'     => esc_html__( 'Select category to be shown on tab ', 'suffix-lite' ),
        'section'         => 'slider_section_settings',
        'type'            => 'dropdown-taxonomies',
        'taxonomy'        => 'category',
		'priority'    	  => 130,
    ) ) );


$wp_customize->add_setting( 'slider_article_background_color',
	array(
		'default'           => $default['slider_article_background_color'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_hex_color',
	)
);
$wp_customize->add_control( 'slider_article_background_color',
	array(
		'label'    => __( 'Section Article Background Color', 'suffix-lite' ),
		'section'  => 'slider_section_settings',
		'type'     => 'color',
		'priority' => 150,
	)
);
$wp_customize->add_setting( 'slider_article_title_color',
	array(
		'default'           => $default['slider_article_title_color'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_hex_color',
	)
);
$wp_customize->add_control( 'slider_article_title_color',
	array(
		'label'    => __( 'Section Article Title Color', 'suffix-lite' ),
		'section'  => 'slider_section_settings',
		'type'     => 'color',
		'priority' => 150,
	)
);

$wp_customize->add_setting( 'show_slider_pagination',
	array(
		'default'           => $default['show_slider_pagination'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'suffix_lite_sanitize_checkbox',
	)
);
$wp_customize->add_control( 'show_slider_pagination',
	array(
		'label'    => esc_html__( 'Enable Pagination Dots', 'suffix-lite' ),
		'section'  => 'slider_section_settings',
		'type'     => 'checkbox',
		'priority' => 160,
	)
);

$wp_customize->add_setting( 'show_slider_control',
	array(
		'default'           => $default['show_slider_control'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'suffix_lite_sanitize_checkbox',
	)
);
$wp_customize->add_control( 'show_slider_control',
	array(
		'label'    => esc_html__( 'Enable Arrow key navigation', 'suffix-lite' ),
		'section'  => 'slider_section_settings',
		'type'     => 'checkbox',
		'priority' => 170,
	)
);
