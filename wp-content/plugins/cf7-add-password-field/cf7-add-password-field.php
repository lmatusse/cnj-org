<?php
/*
Plugin Name: Contact Form 7 Add Password field
Plugin URI: https://wordpress.org/plugins/cf7-add-password-field/
Description: The plugin is to add a password filed to Contact form 7 plugin.
Version: 2.5
Author: Kimiya Kitani
Author URI: https://profiles.wordpress.org/kimipooh/
Text Domain: cf7-add-password-field
Domain Path: /languages
*/

require_once( dirname( __FILE__  ) . '/modules/password.php');

// Check whether the functions in modules/password.php exists or not. 
if (!function_exists('wpcf7_add_form_tag_k_password') ||
    !function_exists('wpcf7_k_password_validation_filter')){
        return;
}

// Set a password field (password, password*) to Contact form 7 handler.
add_action( 'wpcf7_init', 'wpcf7_add_form_tag_k_password' );

// Validate a password field (required or optional).
add_filter( 'wpcf7_validate_password', 'wpcf7_k_password_validation_filter', 10, 2 );
add_filter( 'wpcf7_validate_password*', 'wpcf7_k_password_validation_filter', 10, 2 );
