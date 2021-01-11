<?php
/**
 * Default theme options.
 *
 * @package suffix
 */

if ( ! function_exists( 'suffix_lite_get_default_theme_options' ) ) :

	/**
	 * Get default theme options
	 *
	 * @since 1.0.0
	 *
	 * @return array Default theme options.
	 */
	function suffix_lite_get_default_theme_options() {

		$defaults = array();

		// slider block.
		$defaults['footer_secondary_logo']				= '';
		
		$defaults['show_slider_section']				= 1;
		$defaults['slider_style_option']				= 'single-slider';
		$defaults['slider_layout_option']				= 'boxed';
		$defaults['select_category_for_slider']			= 1;
		$defaults['main_slider_number']			= 6;
		$defaults['show_slider_pagination']			= 1;
		$defaults['show_slider_control']			= 1;
		$defaults['show_slider_post_meta']			= 1;
		$defaults['show_slider_content']			= 0;
		$defaults['number_of_content_home_slider']			= 30;
		
		// ticker block.
		$defaults['show_top_bar_section']				= 1;
		$defaults['show_off_canvas']				= 1;
		$defaults['select_category_for_ticker_section']				= 0;
		$defaults['ticker_slider_number']				= 5;
		$defaults['ticker_title']				= esc_html__('Trending Now','suffix-lite');
		$defaults['show_top_date']				= 1;

		
		$defaults['show_breaking_news_section']				= 1;
		$defaults['show_breaking_news_meta_data']				= 1;
		$defaults['breaking_news_title']		= esc_html__('Breaking News','suffix-lite');
		$defaults['select_category_for_breaking_news']		= 1;


		$defaults['show_post_meta_featured_news']			= 1;
		$defaults['featured_post_image_option']			= 'suffix-lite-400-260';
		
		/*featured news block*/
		$defaults['show_featured_news_section']			= 0;
		$defaults['select_category_for_featured_news']	= 1;
		$defaults['featured_news_title']				= esc_html__('Featured Now','suffix-lite');

		/*layout*/
		$defaults['enable_menu_center']     	= 0;
		$defaults['enable_logo_center']     	= 0;
		$defaults['enable_header_search']     	= 1;

		
		$defaults['home_page_content_status']     	= 0;
		$defaults['enable_overlay_option']			= 1;
		$defaults['enable_author_info_in_single']			= 1;
		$defaults['global_layout']					= 'right-sidebar';
		$defaults['excerpt_length_global']			= 30;
		$defaults['enable_widget_middle']			= 0;
		$defaults['enable_widget_middle_single']			= 0;
		$defaults['archive_layout']					= 'excerpt-only';
		$defaults['archive_layout_image']			= 'full';
		$defaults['single_post_image_layout']		= 'full';
        $defaults['read_more_button_text'] = esc_html__( 'Continue Reading', 'suffix-lite' );
		$defaults['pagination_type']				= 'default';
		$defaults['copyright_text']					= esc_html__( 'Copyright All rights reserved', 'suffix-lite' );
		$defaults['enable_copyright_credit']					= 1;
		$defaults['number_of_footer_widget']		= 3;
		$defaults['breadcrumb_type']				= 'simple';
		$defaults['enable_preloader_option']		= 1;
		$defaults['ed_footer_scroll_top']				= 1;
		
		$defaults['enable_related_post_in_single']    = 1;


		$defaults['primary_font'] = 'Source+Sans+Pro:300,300i,400,400i,700,700i';
		$defaults['secondary_font'] = 'Source+Sans+Pro:300,300i,400,400i,700,700i';
		$defaults['site_title_color'] = '#434343';
		$defaults['text_size_site_title'] = 46;
		$defaults['primary_color'] = '#d60000';
		$defaults['slider_article_title_color'] = '#fff';

		$defaults['slider_article_background_color'] = '#282828';
		$defaults['ticker_background_color'] = '#333';
		$defaults['top_bar_background_color'] = '#212121';
		$defaults['top_bar_text_color'] = '#fff';


		$defaults['featured_article_title_color'] = '#434343';
		$defaults['article_title_color_widget'] = '#434343';

		$defaults['footer_widget_bg_color'] = '#181818';
		$defaults['footer_widget_text_color'] = '#fff';
		$defaults['footer_copyright_bg_color'] = '#111';
		$defaults['footer_copyright_text_color'] = '#fff';

		// Pass through filter.
		$defaults = apply_filters( 'suffix_lite_filter_default_theme_options', $defaults );

		return $defaults;

	}

endif;
