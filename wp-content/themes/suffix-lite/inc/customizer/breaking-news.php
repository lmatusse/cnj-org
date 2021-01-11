<?php
/**
 * breaking-news section
 *
 * @package suffix
 */

$default = suffix_lite_get_default_theme_options();

// Breaking News Main Section.
$wp_customize->add_section( 'breaking_news_section_settings',
	array(
		'title'      => esc_html__( 'Breaking News Section', 'suffix-lite' ),
		'priority'   => 60,
		'capability' => 'edit_theme_options',
		'panel'      => 'theme_front_page_section',
	)
);


// Setting - show_breaking_news_section.
$wp_customize->add_setting( 'show_breaking_news_section',
	array(
		'default'           => $default['show_breaking_news_section'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'suffix_lite_sanitize_checkbox',
	)
);
$wp_customize->add_control( 'show_breaking_news_section',
	array(
		'label'    => esc_html__( 'Enable Breaking News', 'suffix-lite' ),
		'section'  => 'breaking_news_section_settings',
		'type'     => 'checkbox',
		'priority' => 50,
	)
);

// Setting - breaking_news_title.
$wp_customize->add_setting( 'breaking_news_title',
	array(
		'default'           => $default['breaking_news_title'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'wp_kses_post',
	)
);
$wp_customize->add_control( 'breaking_news_title',
	array(
		'label'    => esc_html__( 'Breaking News Title', 'suffix-lite' ),
        'description'     => esc_html__( 'Use html tag <em> to bring different color on breaking news eg, <em> News </em> ', 'suffix-lite' ),
		'section'  => 'breaking_news_section_settings',
		'type'     => 'textarea',
		'priority' => 70,
	)
);

// Setting - show_breaking_news_meta_data.
$wp_customize->add_setting( 'show_breaking_news_meta_data',
	array(
		'default'           => $default['show_breaking_news_meta_data'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'suffix_lite_sanitize_checkbox',
	)
);
$wp_customize->add_control( 'show_breaking_news_meta_data',
	array(
		'label'    => esc_html__( 'Enable Meta Data on Breaking News', 'suffix-lite' ),
		'section'  => 'breaking_news_section_settings',
		'type'     => 'checkbox',
		'priority' => 80,
	)
);

// Setting - drop down category for breaking-news.
$wp_customize->add_setting( 'select_category_for_breaking_news',
	array(
		'default'           => $default['select_category_for_breaking_news'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'absint',
	)
);
$wp_customize->add_control( new Suffix_Lite_Dropdown_Taxonomies_Control( $wp_customize, 'select_category_for_breaking_news',
	array(
        'label'           => esc_html__( 'Category for Breaking News', 'suffix-lite' ),
        'description'     => esc_html__( 'Select category to be shown on breaking news ', 'suffix-lite' ),
        'section'         => 'breaking_news_section_settings',
        'type'            => 'dropdown-taxonomies',
        'taxonomy'        => 'category',
		'priority'    	  => 130,
    ) ) );