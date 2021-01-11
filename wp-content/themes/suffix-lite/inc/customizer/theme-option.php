<?php 

/**
 * Theme Options Panel.
 *
 * @package suffix
 */

$default = suffix_lite_get_default_theme_options();

// Add Theme Options Panel.
$wp_customize->add_panel( 'theme_option_panel',
	array(
		'title'      => esc_html__( 'Theme Options', 'suffix-lite' ),
		'priority'   => 200,
		'capability' => 'edit_theme_options',
	)
);

/*layout management section start */
$wp_customize->add_section( 'theme_option_section_settings',
	array(
		'title'      => esc_html__( 'Layout Management', 'suffix-lite' ),
		'priority'   => 100,
		'capability' => 'edit_theme_options',
		'panel'      => 'theme_option_panel',
	)
);

/*Home Page Layout*/
$wp_customize->add_setting( 'home_page_content_status',
	array(
		'default'           => $default['home_page_content_status'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'suffix_lite_sanitize_checkbox',
	)
);
$wp_customize->add_control( 'home_page_content_status',
	array(
		'label'    => esc_html__( 'Enable Static Page Content', 'suffix-lite' ),
		'section'  => 'static_front_page',
		'type'     => 'checkbox',
		'priority' => 150,

	)
);

// Header Section.
$wp_customize->add_section( 'header_section',
	array(
	'title'      => esc_html__( 'Header Options', 'suffix-lite' ),
	'priority'   => 10,
	'capability' => 'edit_theme_options',
	'panel'      => 'theme_option_panel',
	)
);


$wp_customize->add_setting( 'enable_logo_center',
	array(
		'default'           => $default['enable_logo_center'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'suffix_lite_sanitize_checkbox',
	)
);
$wp_customize->add_control( 'enable_logo_center',
	array(
		'label'    => esc_html__( 'Move Header to Center', 'suffix-lite' ),
		'section'  => 'header_section',
		'type'     => 'checkbox',
		'priority' => 5,
	)
);

$wp_customize->add_setting( 'enable_menu_center',
	array(
		'default'           => $default['enable_menu_center'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'suffix_lite_sanitize_checkbox',
	)
);
$wp_customize->add_control( 'enable_menu_center',
	array(
		'label'    => esc_html__( 'Move Menu to Center', 'suffix-lite' ),
		'section'  => 'header_section',
		'type'     => 'checkbox',
		'priority' => 10,
	)
);

$wp_customize->add_setting( 'enable_header_search',
	array(
		'default'           => $default['enable_header_search'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'suffix_lite_sanitize_checkbox',
	)
);
$wp_customize->add_control( 'enable_header_search',
	array(
		'label'    => esc_html__( 'Enable Header Search', 'suffix-lite' ),
		'section'  => 'header_section',
		'type'     => 'checkbox',
		'priority' => 10,
	)
);

/*Home Page Layout*/
$wp_customize->add_setting( 'enable_overlay_option',
	array(
		'default'           => $default['enable_overlay_option'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'suffix_lite_sanitize_checkbox',
	)
);
$wp_customize->add_control( 'enable_overlay_option',
	array(
		'label'    => esc_html__( 'Enable Banner Overlay', 'suffix-lite' ),
		'section'  => 'theme_option_section_settings',
		'type'     => 'checkbox',
		'priority' => 150,
	)
);


/*Global Layout*/
$wp_customize->add_setting( 'global_layout',
	array(
		'default'           => $default['global_layout'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'suffix_lite_sanitize_select',
	)
);
$wp_customize->add_control( 'global_layout',
	array(
		'label'    => esc_html__( 'Global Layout', 'suffix-lite' ),
		'section'  => 'theme_option_section_settings',
		'choices'               => array(
                'right-sidebar' => esc_html__( 'Content - Primary Sidebar', 'suffix-lite' ),
                'left-sidebar' => esc_html__( 'Primary Sidebar - Content', 'suffix-lite' ),
                'no-sidebar' => esc_html__( 'No Sidebar', 'suffix-lite' )
		    ),
		'type'     => 'select',
		'priority' => 170,
	)
);


/*content excerpt in global*/
$wp_customize->add_setting( 'excerpt_length_global',
	array(
		'default'           => $default['excerpt_length_global'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'suffix_lite_sanitize_positive_integer',
	)
);
$wp_customize->add_control( 'excerpt_length_global',
	array(
		'label'    => esc_html__( 'Set Global Archive Length', 'suffix-lite' ),
		'section'  => 'theme_option_section_settings',
		'type'     => 'number',
		'priority' => 175,
		'input_attrs'     => array( 'min' => 0, 'max' => 200, 'style' => 'width: 150px;' ),

	)
);

// Setting - read_more_button_text.
$wp_customize->add_setting( 'read_more_button_text',
    array(
        'default'           => $default['read_more_button_text'],
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field',
    )
);
$wp_customize->add_control( 'read_more_button_text',
    array(
        'label'    => esc_html__( 'Read More Button Text', 'suffix-lite' ),
        'section'  => 'theme_option_section_settings',
        'type'     => 'text',
        'priority' => 175,
    )
);
/*Archive Layout text*/
$wp_customize->add_setting( 'archive_layout',
	array(
		'default'           => $default['archive_layout'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'suffix_lite_sanitize_select',
	)
);
$wp_customize->add_control( 'archive_layout',
	array(
		'label'    => esc_html__( 'Archive Layout', 'suffix-lite' ),
		'section'  => 'theme_option_section_settings',
		'choices'               => array(
			'excerpt-only' => esc_html__( 'Excerpt Only', 'suffix-lite' ),
			'full-post' => esc_html__( 'Full Post', 'suffix-lite' ),
		    ),
		'type'     => 'select',
		'priority' => 180,
	)
);

$wp_customize->add_setting( 'enable_widget_middle',
	array(
		'default'           => $default['enable_widget_middle'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'suffix_lite_sanitize_checkbox',
	)
);
$wp_customize->add_control( 'enable_widget_middle',
	array(
		'label'    => esc_html__( "Enable 'Home Page Sidebar Two' Widget on Archive", 'suffix-lite' ),
		'section'  => 'theme_option_section_settings',
		'type'     => 'checkbox',
		'priority' => 175,
	)
);
/*Archive Layout image*/
$wp_customize->add_setting( 'archive_layout_image',
	array(
		'default'           => $default['archive_layout_image'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'suffix_lite_sanitize_select',
	)
);
$wp_customize->add_control( 'archive_layout_image',
	array(
		'label'    => esc_html__( 'Archive Image Alocation', 'suffix-lite' ),
		'section'  => 'theme_option_section_settings',
		'choices'               => array(
			'full' => esc_html__( 'Full', 'suffix-lite' ),
			'right' => esc_html__( 'Right', 'suffix-lite' ),
			'left' => esc_html__( 'Left', 'suffix-lite' ),
			'no-image' => esc_html__( 'No image', 'suffix-lite' )
		    ),
		'type'     => 'select',
		'priority' => 185,
	)
);

$wp_customize->add_setting( 'enable_widget_middle_single',
	array(
		'default'           => $default['enable_widget_middle_single'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'suffix_lite_sanitize_checkbox',
	)
);
$wp_customize->add_control( 'enable_widget_middle_single',
	array(
		'label'    => esc_html__( "Enable 'Home Page Sidebar Two' Widget on Single", 'suffix-lite' ),
		'section'  => 'theme_option_section_settings',
		'type'     => 'checkbox',
		'priority' => 185,
	)
);
/*single post Layout image*/
$wp_customize->add_setting( 'single_post_image_layout',
	array(
		'default'           => $default['single_post_image_layout'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'suffix_lite_sanitize_select',
	)
);
$wp_customize->add_control( 'single_post_image_layout',
	array(
		'label'    => esc_html__( 'Single Post/Page Image Alocation', 'suffix-lite' ),
		'section'  => 'theme_option_section_settings',
		'choices'               => array(
			'full' => esc_html__( 'Full', 'suffix-lite' ),
			'right' => esc_html__( 'Right', 'suffix-lite' ),
			'left' => esc_html__( 'Left', 'suffix-lite' ),
			'no-image' => esc_html__( 'No image', 'suffix-lite' )
		    ),
		'type'     => 'select',
		'priority' => 190,
	)
);


$wp_customize->add_setting('enable_author_info_in_single',
	array(
		'default'           => $default['enable_author_info_in_single'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'suffix_lite_sanitize_checkbox',
	)
);
$wp_customize->add_control('enable_author_info_in_single',
	array(
		'label'    => esc_html__('Enable Post Author Info in Single Post', 'suffix-lite'),
		'section'  => 'theme_option_section_settings',
		'type'     => 'checkbox',
		'priority' => 195,
	)
);


$wp_customize->add_setting('enable_related_post_in_single',
	array(
		'default'           => $default['enable_related_post_in_single'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'suffix_lite_sanitize_checkbox',
	)
);
$wp_customize->add_control('enable_related_post_in_single',
	array(
		'label'    => esc_html__('Enable Related Post in Single Post', 'suffix-lite'),
		'section'  => 'theme_option_section_settings',
		'type'     => 'checkbox',
		'priority' => 195,
	)
);

// Pagination Section.
$wp_customize->add_section( 'pagination_section',
	array(
	'title'      => esc_html__( 'Pagination Options', 'suffix-lite' ),
	'priority'   => 110,
	'capability' => 'edit_theme_options',
	'panel'      => 'theme_option_panel',
	)
);

// Setting pagination_type.
$wp_customize->add_setting( 'pagination_type',
	array(
	'default'           => $default['pagination_type'],
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'suffix_lite_sanitize_select',
	)
);
$wp_customize->add_control( 'pagination_type',
	array(
	'label'       => esc_html__( 'Pagination Type', 'suffix-lite' ),
	'section'     => 'pagination_section',
	'type'        => 'select',
	'choices'               => array(
		'default' => esc_html__( 'Default (Older / Newer Post)', 'suffix-lite' ),
		'numeric' => esc_html__( 'Numeric', 'suffix-lite' ),
	    ),
	'priority'    => 100,
	)
);



// Footer Section.
$wp_customize->add_section( 'footer_section',
	array(
	'title'      => esc_html__( 'Footer Options', 'suffix-lite' ),
	'priority'   => 130,
	'capability' => 'edit_theme_options',
	'panel'      => 'theme_option_panel',
	)
);


// Setting social_content_heading.
$wp_customize->add_setting( 'number_of_footer_widget',
	array(
	'default'           => $default['number_of_footer_widget'],
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'suffix_lite_sanitize_select',
	)
);
$wp_customize->add_control( 'number_of_footer_widget',
	array(
	'label'    => esc_html__( 'Number Of Footer Widget', 'suffix-lite' ),
	'section'  => 'footer_section',
	'type'     => 'select',
	'priority' => 100,
	'choices'               => array(
		0 => esc_html__( 'Disable footer sidebar area', 'suffix-lite' ),
		1 => esc_html__( '1', 'suffix-lite' ),
		2 => esc_html__( '2', 'suffix-lite' ),
		3 => esc_html__( '3', 'suffix-lite' ),
		4 => esc_html__( '4', 'suffix-lite' ),
	    ),
	)
);

// Setting copyright_text.
$wp_customize->add_setting( 'copyright_text',
	array(
	'default'           => $default['copyright_text'],
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control( 'copyright_text',
	array(
	'label'    => esc_html__( 'Footer Copyright Text', 'suffix-lite' ),
	'section'  => 'footer_section',
	'type'     => 'text',
	'priority' => 120,
	)
);

$wp_customize->add_setting('ed_footer_scroll_top',
	array(
		'default'           => $default['ed_footer_scroll_top'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'suffix_lite_sanitize_checkbox',
	)
);
$wp_customize->add_control('ed_footer_scroll_top',
	array(
		'label'    => esc_html__('Enable Scroll To Top Button', 'suffix-lite'),
		'section'  => 'footer_section',
		'type'     => 'checkbox',
		'priority' => 195,
	)
);

// Breadcrumb Section.
$wp_customize->add_section( 'breadcrumb_section',
	array(
	'title'      => esc_html__( 'Breadcrumb Options', 'suffix-lite' ),
	'priority'   => 120,
	'capability' => 'edit_theme_options',
	'panel'      => 'theme_option_panel',
	)
);

// Setting breadcrumb_type.
$wp_customize->add_setting( 'breadcrumb_type',
	array(
	'default'           => $default['breadcrumb_type'],
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'suffix_lite_sanitize_select',
	)
);
$wp_customize->add_control( 'breadcrumb_type',
	array(
	'label'       => esc_html__( 'Breadcrumb Type', 'suffix-lite' ),
	'description' => sprintf( esc_html__( 'Advanced: Requires %1$sBreadcrumb NavXT%2$s plugin', 'suffix-lite' ), '<a href="https://wordpress.org/plugins/breadcrumb-navxt/" target="_blank">','</a>' ),
	'section'     => 'breadcrumb_section',
	'type'        => 'select',
	'choices'               => array(
		'disabled' => esc_html__( 'Disabled', 'suffix-lite' ),
		'simple' => esc_html__( 'Simple', 'suffix-lite' ),
		'advanced' => esc_html__( 'Advanced', 'suffix-lite' ),
	    ),
	'priority'    => 100,
	)
);

// Pre loader Section.
$wp_customize->add_section( 'preloader_section',
	array(
	'title'      => esc_html__( 'Preloader Options', 'suffix-lite' ),
	'priority'   => 125,
	'capability' => 'edit_theme_options',
	'panel'      => 'theme_option_panel',
	)
);

// Setting enable_preloader_option.
$wp_customize->add_setting( 'enable_preloader_option',
	array(
	'default'           => $default['enable_preloader_option'],
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'suffix_lite_sanitize_checkbox',
	)
);
$wp_customize->add_control( 'enable_preloader_option',
	array(
		'label'    => esc_html__( 'Enable Preloader', 'suffix-lite' ),
		'section'  => 'preloader_section',
		'type'     => 'checkbox',
		'priority' => 150,
	)
);
