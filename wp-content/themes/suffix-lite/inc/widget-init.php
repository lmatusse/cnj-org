<?php
/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function suffix_lite_widgets_init()
{

    register_sidebar(array(
        'name' => esc_html__('Off-canvas Area', 'suffix-lite'),
        'id' => 'slide-menu',
        'description' => esc_html__('Add widgets here.', 'suffix-lite'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h2 class="widget-title">',
        'after_title' => '</h2>',
    ));

    register_sidebar(array(
        'name' => esc_html__('Header Advertisement', 'suffix-lite'),
        'id' => 'top-header-add',
        'description' => esc_html__('Add widgets here.', 'suffix-lite'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h2 class="widget-title">',
        'after_title' => '</h2>',
    ));

    register_sidebar(array(
        'name' => esc_html__('Home Page Sidebar One', 'suffix-lite'),
        'id' => 'sidebar-home-1',
        'description' => esc_html__('Add widgets here.', 'suffix-lite'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h2 class="widget-title">',
        'after_title' => '</h2>',
    ));

    register_sidebar(array(
        'name' => esc_html__('Home Page Sidebar Two', 'suffix-lite'),
        'id' => 'sidebar-home-2',
        'description' => esc_html__('Add widgets here.', 'suffix-lite'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h2 class="widget-title">',
        'after_title' => '</h2>',
    ));

    register_sidebar(array(
        'name' => esc_html__('Sidebar column Three', 'suffix-lite'),
        'id' => 'sidebar-2',
        'description' => esc_html__('Add widgets here.', 'suffix-lite'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h2 class="widget-title">',
        'after_title' => '</h2>',
    ));

    register_sidebar(array(
        'name' => esc_html__('Sitewide Sidebar', 'suffix-lite'),
        'id' => 'sidebar-1',
        'description' => esc_html__('Add widgets here.', 'suffix-lite'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h2 class="widget-title">',
        'after_title' => '</h2>',
    ));


    register_sidebar(array(
        'name' => esc_html__('Footer Full-width Area', 'suffix-lite'),
        'id' => 'footer-full-width-2',
        'description' => esc_html__('Add widgets here.', 'suffix-lite'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h2 class="widget-title">',
        'after_title' => '</h2>',
    ));

    $suffix_lite_footer_widgets_number = suffix_lite_get_option('number_of_footer_widget');
    if ($suffix_lite_footer_widgets_number > 0) {
        register_sidebar(array(
            'name' => esc_html__('Footer column One', 'suffix-lite'),
            'id' => 'footer-col-one',
            'description' => esc_html__('Displays items on footer section.', 'suffix-lite'),
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget' => '</div>',
            'before_title' => '<h2 class="widget-title">',
            'after_title' => '</h2>',
        ));
        if ($suffix_lite_footer_widgets_number > 1) {
            register_sidebar(array(
                'name' => esc_html__('Footer column Two', 'suffix-lite'),
                'id' => 'footer-col-two',
                'description' => esc_html__('Displays items on footer section.', 'suffix-lite'),
                'before_widget' => '<div id="%1$s" class="widget %2$s">',
                'after_widget' => '</div>',
                'before_title' => '<h2 class="widget-title">',
                'after_title' => '</h2>',
            ));
        }
        if ($suffix_lite_footer_widgets_number > 2) {
            register_sidebar(array(
                'name' => esc_html__('Footer column Three', 'suffix-lite'),
                'id' => 'footer-col-three',
                'description' => esc_html__('Displays items on footer section.', 'suffix-lite'),
                'before_widget' => '<div id="%1$s" class="widget %2$s">',
                'after_widget' => '</div>',
                'before_title' => '<h2 class="widget-title">',
                'after_title' => '</h2>',
            ));
        }
        if ($suffix_lite_footer_widgets_number > 3) {
            register_sidebar(array(
                'name' => esc_html__('Footer column Four', 'suffix-lite'),
                'id' => 'footer-col-four',
                'description' => esc_html__('Displays items on footer section.', 'suffix-lite'),
                'before_widget' => '<div id="%1$s" class="widget %2$s">',
                'after_widget' => '</div>',
                'before_title' => '<h2 class="widget-title">',
                'after_title' => '</h2>',
            ));
        }
    }
}

add_action('widgets_init', 'suffix_lite_widgets_init');
