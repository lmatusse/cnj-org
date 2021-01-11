<?php
/**
 * top-bar section
 *
 * @package suffix
 */

$default = suffix_lite_get_default_theme_options();

// Top Bar Main Section.
$wp_customize->add_section( 'top_bar_section_settings',
	array(
		'title'      => esc_html__( 'Top Bar Settings', 'suffix-lite' ),
		'priority'   => 50,
		'capability' => 'edit_theme_options',
		'panel'      => 'theme_front_page_section',
	)
);


// Setting - show_top_bar_section.
$wp_customize->add_setting( 'show_top_bar_section',
	array(
		'default'           => $default['show_top_bar_section'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'suffix_lite_sanitize_checkbox',
	)
);
$wp_customize->add_control( 'show_top_bar_section',
	array(
		'label'    => esc_html__( 'Enable Top Bar', 'suffix-lite' ),
		'section'  => 'top_bar_section_settings',
		'type'     => 'checkbox',
		'priority' => 100,
	)
);

// Setting - show_off_canvas.
$wp_customize->add_setting( 'show_off_canvas',
	array(
		'default'           => $default['show_off_canvas'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'suffix_lite_sanitize_checkbox',
	)
);
$wp_customize->add_control( 'show_off_canvas',
	array(
		'label'    => esc_html__( 'Enable Off Canvas', 'suffix-lite' ),
		'section'  => 'top_bar_section_settings',
		'type'     => 'checkbox',
		'priority' => 100,
	)
);

// Setting - ticker_title.
$wp_customize->add_setting( 'ticker_title',
	array(
		'default'           => $default['ticker_title'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control( 'ticker_title',
	array(
		'label'    => esc_html__( 'Ticker Title', 'suffix-lite' ),
		'section'  => 'top_bar_section_settings',
		'type'     => 'text',
		'priority' => 100,
	)
);


$wp_customize->add_setting('ticker_slider_number',
	array(
		'default'           => $default['ticker_slider_number'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'suffix_lite_sanitize_positive_integer',
	)
);
$wp_customize->add_control('ticker_slider_number',
	array(
		'label'       => esc_html__('Select no of Ticker News', 'suffix-lite'),
        'description'     => esc_html__( 'Number of ticker news to be shown the allowed range is 1 - 15', 'suffix-lite' ),

		'section'     => 'top_bar_section_settings',
		'type'     => 'number',
		'priority' => 105,
		'input_attrs' => array('min' => 1, 'max' => 15, 'style' => 'width: 150px;'),
	)
);

// Setting - drop down category for ticker-news.
$wp_customize->add_setting( 'select_category_for_ticker_section',
	array(
		'default'           => $default['select_category_for_ticker_section'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'absint',
	)
);
$wp_customize->add_control( new Suffix_Lite_Dropdown_Taxonomies_Control( $wp_customize, 'select_category_for_ticker_section',
	array(
        'label'           => esc_html__( 'Category for Ticker News', 'suffix-lite' ),
        'description'     => esc_html__( 'Select category to be shown on ticker news ', 'suffix-lite' ),
        'section'         => 'top_bar_section_settings',
        'type'            => 'dropdown-taxonomies',
        'taxonomy'        => 'category',
		'priority'    	  => 130,
    ) ) );


// Setting - show_top_date.
$wp_customize->add_setting( 'show_top_date',
	array(
		'default'           => $default['show_top_date'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'suffix_lite_sanitize_checkbox',
	)
);
$wp_customize->add_control( 'show_top_date',
	array(
		'label'    => esc_html__( 'Enable Date on Top Bar', 'suffix-lite' ),
		'section'  => 'top_bar_section_settings',
		'type'     => 'checkbox',
		'priority' => 140,
	)
);