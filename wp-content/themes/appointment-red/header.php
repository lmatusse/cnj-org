<!DOCTYPE html>
<html <?php language_attributes(); ?> >
    <head>
        <meta charset="<?php bloginfo('charset'); ?>">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?php
        $appointment_red_header_settings = wp_parse_args(get_option('appointment_options', array()), appointment_theme_setup_data());
        ?>
        <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">

        <?php wp_head(); ?>
    </head>
    <body <?php body_class(); ?> >
        <?php wp_body_open(); ?>
        <a class="skip-link screen-reader-text" href="#wrap"><?php esc_html_e('Skip to content', 'appointment-red'); ?></a> 
        <!--Logo & Menu Section-->  
        <?php
        $appointment_red_header_setting = wp_parse_args(get_option('appointment_options', array()), appointment_red_default_data());
        if ($appointment_red_header_setting['header_layout_setting'] == 'default') {
            $appointment_red_navbarstyle = 'navbar navbar-default';
        } elseif ($appointment_red_header_setting['header_layout_setting'] == 'sticky') {
            $appointment_red_navbarstyle = 'navbar navbar2 navbar-default navbar2';
        }
        ?>
        <nav class="<?php echo esc_attr($appointment_red_navbarstyle); ?>">
            <div class="container">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <?php
                    if (!has_custom_logo() && $appointment_red_header_settings['enable_header_logo_text'] != 'nomorenow') {
                        $appointment_red_logo = $appointment_red_header_settings['upload_image_logo'];
                        $appointment_red_logo_id = attachment_url_to_postid($appointment_red_logo);
                        $appointment_red_logo_alt = get_post_meta($appointment_red_logo_id, '_wp_attachment_image_alt', true);
                        $appointment_red_logo_title = get_the_title($appointment_red_logo_id);

                        if ($appointment_red_header_settings['enable_header_logo_text'] == '' && $appointment_red_logo != '') {
                            ?>
                            <a class="navbar-brand" href="<?php echo esc_url(home_url('/')); ?>" rel="home" >
                                <img class="img-responsive" src="<?php echo esc_url($appointment_red_logo); ?>" style="height:50px; width:200px;" alt="<?php
                                if (!empty($appointment_red_logo_alt)) {
                                    echo esc_attr($appointment_red_logo_alt);
                                } else {
                                    echo esc_attr(get_bloginfo('name'));
                                }
                                ?>"/></a>
                                <?php
                            }
                        } else {
                            if ($appointment_red_header_settings['enable_header_logo_text'] != 'nomorenow') {
                                $appointment_red_header_settings['enable_header_logo_text'] = 'nomorenow';
                                update_option('appointment_options', $appointment_red_header_settings);
                            }

                            the_custom_logo();
                            ?>

                    <?php } ?>
                    <div class="site-branding-text logo-link-url">

                        <h1 class="site-title" style="margin: 0px;" ><a class="navbar-brand" href="<?php echo esc_url(home_url('/')); ?>" rel="home" >

                                <div class=appointment_title_head>
                                    <?php bloginfo('name'); ?>
                                </div>
                            </a>
                        </h1>

                        <?php
                        $appointment_red_description = get_bloginfo('description', 'display');
                        if ($appointment_red_description || is_customize_preview()) :
                            ?>
                            <p class="site-description"><?php echo $appointment_red_description; ?></p>
                        <?php endif; ?>
                    </div>
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                        <span class="sr-only"><?php esc_html_e('Toggle navigation', 'appointment-red'); ?></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>

                <?php
                $appointment_red_facebook = $appointment_red_header_settings['social_media_facebook_link'];
                $appointment_red_twitter = $appointment_red_header_settings['social_media_twitter_link'];
                $appointment_red_linkdin = $appointment_red_header_settings['social_media_linkedin_link'];

                $appointment_red_social = '<ul id="%1$s" class="%2$s">%3$s';
                if ($appointment_red_header_settings['header_social_media_enabled'] == 0) {

                    if($appointment_red_facebook !='' || $appointment_red_twitter !='' || $appointment_red_linkdin !=''){
                    $appointment_red_social .= '<ul class="head-contact-social">';

                    if ($appointment_red_header_settings['social_media_facebook_link'] != '') {
                        $appointment_red_social .= '<li class="facebook"><a href="' . esc_url($appointment_red_facebook) . '"';
                        if ($appointment_red_header_settings['facebook_media_enabled'] == 1) {
                            $appointment_red_social .= 'target="_blank"';
                        }
                        $appointment_red_social .= '><i class="fa fa-facebook"></i></a></li>';
                    }
                    if ($appointment_red_header_settings['social_media_twitter_link'] != '') {
                        $appointment_red_social .= '<li class="twitter"><a href="' . esc_url($appointment_red_twitter) . '"';
                        if ($appointment_red_header_settings['twitter_media_enabled'] == 1) {
                            $appointment_red_social .= 'target="_blank"';
                        }
                        $appointment_red_social .= '><i class="fa fa-twitter"></i></a></li>';
                    }
                    if ($appointment_red_header_settings['social_media_linkedin_link'] != '') {
                        $appointment_red_social .= '<li class="linkedin"><a href="' . esc_url($appointment_red_linkdin) . '"';
                        if ($appointment_red_header_settings['linkedin_media_enabled'] == 1) {
                            $appointment_red_social .= 'target="_blank"';
                        }
                        $appointment_red_social .= '><i class="fa fa-linkedin"></i></a></li>';
                    }
                    $appointment_red_social .= '</ul>';
                }
            }
                $appointment_red_social .= '</ul>';
                ?>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <?php
                    wp_nav_menu(array(
                        'theme_location' => 'primary',
                        'container' => '',
                        'menu_class' => 'nav navbar-nav navbar-right',
                        'fallback_cb' => 'appointment_fallback_page_menu',
                        'items_wrap' => $appointment_red_social,
                        'walker' => new appointment_nav_walker()
                    ));
                    ?>
                </div><!-- /.navbar-collapse -->
            </div><!-- /.container-fluid -->
        </nav>  
        <!--/Logo & Menu Section--> 
        <div class="clearfix"></div>