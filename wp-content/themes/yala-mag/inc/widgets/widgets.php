<?php
/**
 * @package Yala_Mag
	=========================
			WIDGET CLASS
	=========================
 */

// Widget News Layouts
require_once trailingslashit( get_template_directory() ) . '/inc/widgets/front-layout-widgets.php';


// widget Footer
require_once trailingslashit( get_template_directory() ) . '/inc/widgets/footer-layout-widgets.php';

// Register Widget
if ( ! function_exists( 'yala_mag_register_widget' ) ) {
    /**
     * Load widget.
     *
     * @since 1.0.0
     */
    function yala_mag_register_widget() {

        // News Block Layout One
        register_widget( 'Yala_Mag_Block_Layout_One' );

        // News Block Layout Two
        register_widget( 'Yala_Mag_Block_Layout_Two' );

        // News Block Layout Threee
        register_widget( 'Yala_Mag_Block_Layout_Three' );

         // News Block Layout Threee
        register_widget( 'Yala_Mag_Block_Layout_Four' );

        // Footer Latest News
        register_widget( 'Yala_Mag_Footer_Latest_News' );

        // Footer Menu 
        register_widget( 'Yala_Mag_Footer_Menu_Widget' );

        // Footer Menu 
        register_widget( 'Yala_Mag_Footer_About_Widget' );

    }
}

add_action( 'widgets_init', 'yala_mag_register_widget' );