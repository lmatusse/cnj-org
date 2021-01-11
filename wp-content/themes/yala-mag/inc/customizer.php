<?php
/**
 * yala mag Theme Customizer
 *
 * @package yala_mag
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function yala_mag_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial( 'blogname', array(
			'selector'        => '.site-title a',
			'render_callback' => 'yala_mag_customize_partial_blogname',
		) );
		$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
			'selector'        => '.site-description',
			'render_callback' => 'yala_mag_customize_partial_blogdescription',
		) );
	}
}
add_action( 'customize_register', 'yala_mag_customize_register' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function yala_mag_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function yala_mag_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function yala_mag_customize_preview_js() {
	wp_enqueue_script( 'yala-mag-customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}

add_action( 'customize_preview_init', 'yala_mag_customize_preview_js' );
/**
 * Yala_Mag Header Settings panel at Theme Customizer
 *
 * @package Yala_Mag
 * @since 1.0.0
 */

function yala_mag_header_settings_register( $wp_customize ) {

	 /**
     * Add Header Settings Panel
     *
     * @since 1.0.0
     */
	$wp_customize->add_panel(
	   'yala_mag_header_settings_panel',
	   array(
	     'priority'       => 10,
	     'capability'     => 'edit_theme_options',
	     'theme_supports' => '',
	     'title'          => __( 'Header Settings', 'yala-mag' ),
	   )
	 );

  	/*----------------------------------------------------------------------------------------------------------------------------------------*/
	/**
     * Header section
     *
     * @since 1.0.0
     */
  	$wp_customize->add_section(
    	'yala_mag_top_header_section',
	    array(
	     'priority'       => 5,
	     'panel'          => 'yala_mag_header_settings_panel',
	     'capability'     => 'edit_theme_options',
	     'theme_supports' => '',
	     'title'          => __( 'Header Section', 'yala-mag' ),
	     'description'    => __( 'Managed the content display at top header section.', 'yala-mag' ),
	   	)
  	);

  	/*----------------------------------------------------------------------------------------------------------------------------------------*/
    /**
     *Enable/Disable Top Header section
     *
     * @since 1.0.0
     */
    $wp_customize->add_setting(
      'yala_mag_top_header_enable',
      array(
        'default'           => 0,
        'sanitize_callback' => 'yala_mag_sanitize_checkbox',
      )
    );
    
    $wp_customize->add_control(
      'yala_mag_top_header_enable',
      array(
        'section'     => 'yala_mag_top_header_section',
        'label'       => __( 'Enable/Disable top header', 'yala-mag' ),
        'type'        => 'checkbox'
      )       
    );

  /**
   *Enable/Disable Top Header date
   *
   * @since 1.0.0
   */

    $wp_customize->add_setting(
      'yala_mag_top_header_date_enable',
      array(
        'default'           => 0,
        'sanitize_callback' => 'yala_mag_sanitize_checkbox',
      )
    );
    
    $wp_customize->add_control(
      'yala_mag_top_header_date_enable',
      array(
        'section'     => 'yala_mag_top_header_section',
        'label'       => __( 'Enable/Disable Top Header Date', 'yala-mag' ),
        'type'        => 'checkbox'
      )       
    );

    /**
     *Enable/Disable Top Header section
     *
     * @since 1.0.0
     */

    $wp_customize->add_setting(
      'yala_mag_top_header_top_menu_enable',
      array(
        'default'           => 0,
        'sanitize_callback' => 'yala_mag_sanitize_checkbox',
      )
    );
    
    $wp_customize->add_control(
      'yala_mag_top_header_top_menu_enable',
      array(
        'section'     => 'yala_mag_top_header_section',
        'label'       => __( 'Enable/Disable Top Menu', 'yala-mag' ),
        'type'        => 'checkbox'
      )       
    );

    /**
     *Enable/Disable Top Header section
     *
     * @since 1.0.0
     */

    $wp_customize->add_setting(
      'yala_mag_top_header_searchform_enable',
      array(
        'default'           => 0,
        'sanitize_callback' => 'yala_mag_sanitize_checkbox',
      )
    );
    
    $wp_customize->add_control(
      'yala_mag_top_header_searchform_enable',
      array(
        'section'     => 'yala_mag_top_header_section',
        'label'       => __( 'Enable/Disable Top Header search Form', 'yala-mag' ),
        'type'        => 'checkbox'
      )       
    );

    /**
     *Enable/Disable Main Menu Social Links
     *
     * @since 1.0.0
     */

    $wp_customize->add_setting(
      'yala_mag_top_header_social_enable',
      array(
        'default'           => 0,
        'sanitize_callback' => 'yala_mag_sanitize_checkbox',
      )
    );
    
    $wp_customize->add_control(
      'yala_mag_top_header_social_enable',
      array(
        'section'     => 'yala_mag_top_header_section',
        'label'       => __( 'Enable/Disable Main Menu Social Links', 'yala-mag' ),
        'type'        => 'checkbox'
      )       
    );

    //Start

  $wp_customize->add_setting('yala_mag_facebook_url',array(
      'capability'     => 'edit_theme_options',
      'sanitize_callback' => 'esc_url_raw',
      'default' =>  __( '#', 'yala-mag' )
    )
  );

  $wp_customize->add_control(new WP_Customize_Control($wp_customize,'yala_mag_facebook_url',array(
      'label' => __('Facebook URL','yala-mag'),
      'type' => 'url',
      'section' => 'yala_mag_top_header_section',
      'settings' => 'yala_mag_facebook_url',
    )
  ));
    
  $wp_customize->add_setting('yala_mag_twitter_url',array(
            'capability'     => 'edit_theme_options',
      'sanitize_callback' => 'esc_url_raw',
      'default' =>  __( '#', 'yala-mag' )
    )
  );

  $wp_customize->add_control(new WP_Customize_Control($wp_customize,'yala_mag_twitter_url',array(
      'label' => __('Twitter URL','yala-mag'),
      'type' => 'url',
      'section' => 'yala_mag_top_header_section',
      'settings' => 'yala_mag_twitter_url',
    )
  ));
    
      $wp_customize->add_setting('yala_mag_linkedin_url',array(
            'capability'     => 'edit_theme_options',
      'sanitize_callback' => 'esc_url_raw',
      'default' =>  __( '#', 'yala-mag' )
    )
  );

  $wp_customize->add_control(new WP_Customize_Control($wp_customize,'yala_mag_linkedin_url',array(
      'label' => __('Linkedin URL','yala-mag'),
      'type' => 'url',
      'section' => 'yala_mag_top_header_section',
      'settings' => 'yala_mag_linkedin_url',
    )
  ));
    
    $wp_customize->add_setting('yala_mag_pinterest_url',array(
      'capability'     => 'edit_theme_options',
      'sanitize_callback' => 'esc_url_raw',
      'default' =>  __( '#', 'yala-mag' )
    )
  );

  $wp_customize->add_control(new WP_Customize_Control($wp_customize,'yala_mag_pinterest_url',array(
      'label' => __('Pinterest URL','yala-mag'),
      'type' => 'url',
      'section' => 'yala_mag_top_header_section',
      'settings' => 'yala_mag_pinterest_url',
    )
  ));
     $wp_customize->add_setting('yala_mag_youtube_url',array(
            'capability'     => 'edit_theme_options',  
      'sanitize_callback' => 'esc_url_raw',
      'default' =>  __( '#', 'yala-mag' )
    )
  );

  $wp_customize->add_control(new WP_Customize_Control($wp_customize,'yala_mag_youtube_url',array(
      'label' => __('Youtube URL','yala-mag'),
      'type' => 'url',
      'section' => 'yala_mag_top_header_section',
      'settings' => 'yala_mag_youtube_url',
    )
  ));

    //End 

	/*----------------------------------------------------------------------------------------------------------------------------------------*/
	/**
	* Slider section
	*
	* @since 1.0.0
	*/

	$wp_customize->add_section(
	  'yala_mag_slider_section',
	  array(
	   'priority'       => 8,
	   'panel'          => 'yala_mag_header_settings_panel',
	   'capability'     => 'edit_theme_options',
	   'theme_supports' => '',
	   'title'          => __( 'Slider section', 'yala-mag' ),
	   'description'    => __( 'Managed the content display at Slider section.', 'yala-mag' ),
	 )
	);

	/**
	 *Enable/Disable Slider section
	*
	* @since 1.0.0
	*/
	$wp_customize->add_setting(
	  'yala_mag_slider_enable',
	  array(
	    'default'           => 1,
	    'sanitize_callback' => 'yala_mag_sanitize_checkbox',
	  )
	);

	$wp_customize->add_control(
	  'yala_mag_slider_enable',
	  array(
	    'section'     => 'yala_mag_slider_section',
	    'label'       => __( 'Enable/Disable Main news slider Section', 'yala-mag' ),
	    'type'        => 'checkbox'
	  )       
	);

	/** select category for Slider */
	$wp_customize->add_setting('yala_mag_slider_category_id',array(
    'sanitize_callback' => 'yala_mag_sanitize_category',
    'default' =>  '1',
       )
   );
    
	$wp_customize->add_control(new Yala_Mag_Customize_Dropdown_Taxanomies_Control($wp_customize,'yala_mag_slider_category_id',
	    array(
               'label' => __('Select Category for Slider','yala-mag'),
                'section' => 'yala_mag_slider_section',
                'settings' => 'yala_mag_slider_category_id',
                'type'=> 'dropdown-taxonomies',
	        )
	));

	/** select Number of SLider to show in Frontpage */
	$wp_customize->add_setting( 'yala_mag_slider_number', array(
	  'capability'            => 'edit_theme_options',
	  'default'               => '3',
	  'sanitize_callback'     => 'absint'
	));

	$wp_customize->add_control( 'yala_mag_slider_number', array(
	  'label'                 =>  __( 'Number of Slider to Show in Frontpage', 'yala-mag' ),
	  'description'           =>  __( 'input 3,4,5,6,7,8,9,10', 'yala-mag' ),
	  'section'               => 'yala_mag_slider_section',
	  'type'                  => 'number',
	  'settings' => 'yala_mag_slider_number',
	) );
}

add_action( 'customize_register', 'yala_mag_header_settings_register' );


/**
 * Yala_Mag Other Settings panel at Theme Customizer
 *
 * @package Yala_Mag
 * @since 1.0.0
 */

function yala_mag_other_settings_register( $wp_customize ) {


 /*----------------------------------------------------------------------------------------------------------------------------------------*/
  /**
     * Other Section
     *
     * @since 1.0.0
     */
  $wp_customize->add_section(
    'yala_mag_other_section',
    array(
      'priority'       => 40,
      'capability'     => 'edit_theme_options',
      'theme_supports' => '',
      'title'          => __( 'Theme Options', 'yala-mag' )
    )
  );

   // Enable/Disable Preloader
  $wp_customize->add_setting(
    'yala_mag_preloader_enable',
    array(
      'default'           => 0,
      'sanitize_callback' => 'yala_mag_sanitize_checkbox',
    )
  );

  $wp_customize->add_control(
    'yala_mag_preloader_enable',
    array(
      'section'     => 'yala_mag_other_section',
      'label'       => __( 'Enable/Disable for Preloader', 'yala-mag' ),
      'type'        => 'checkbox'
    )       
  );

     // Enable/Disable Footer Top
     $wp_customize->add_setting(
      'yala_mag_footer_top_enable',
      array(
        'default'           => 0,
        'sanitize_callback' => 'yala_mag_sanitize_checkbox',
      )
    );
  
    $wp_customize->add_control(
      'yala_mag_footer_top_enable',
      array(
        'section'     => 'yala_mag_other_section',
        'label'       => __( 'Enable/Disable for Footer Top Section', 'yala-mag' ),
        'type'        => 'checkbox'
      )       
    );
}

add_action( 'customize_register', 'yala_mag_other_settings_register' );

require get_template_directory() . '/inc/sanitize.php';