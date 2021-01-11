<?php 

if ( ! function_exists( 'suffix_lite_add_breadcrumb' ) ) :

	/**
	 * Add breadcrumb.
	 *
	 * @since 1.0.0
	 */
	function suffix_lite_add_breadcrumb() {

		// Bail if Breadcrumb disabled.
		$breadcrumb_type = suffix_lite_get_option( 'breadcrumb_type' );
		if ( 'disabled' === $breadcrumb_type ) {
			return;
		}
		// Bail if Home Page.
		if ( is_front_page() || is_home() ) {
			return;
		}
		// Render breadcrumb.
		switch ( $breadcrumb_type ) {
			case 'simple':
				suffix_lite_simple_breadcrumb();
			break;

			case 'advanced':
				if ( function_exists( 'bcn_display' ) ) {
					bcn_display();
				}
			break;

			default:
			break;
		}
		return;

	}

endif;

add_action( 'suffix_lite_action_breadcrumb', 'suffix_lite_add_breadcrumb' , 10 );
