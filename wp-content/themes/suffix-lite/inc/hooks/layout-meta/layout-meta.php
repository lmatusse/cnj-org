<?php
/**
 * Implement theme metabox.
 *
 * @package Suffix Lite
 */

if (!function_exists('suffix_lite_add_theme_meta_box')) :

    /**
     * Add the Meta Box
     *
     * @since 1.0.0
     */
    function suffix_lite_add_theme_meta_box()
    {

        $apply_metabox_post_types = array('post', 'page');

        foreach ($apply_metabox_post_types as $key => $type) {
            add_meta_box(
                'suffix-lite-theme-settings',
                esc_html__('Single Page/Post Settings', 'suffix-lite'),
                'suffix_lite_render_theme_settings_metabox',
                $type
            );
        }

    }

endif;

add_action('add_meta_boxes', 'suffix_lite_add_theme_meta_box');

add_action( 'admin_enqueue_scripts', 'suffix_lite_backend_scripts');
if ( ! function_exists( 'suffix_lite_backend_scripts' ) ){
    function suffix_lite_backend_scripts( $hook ) {
        wp_enqueue_style( 'wp-color-picker');
        wp_enqueue_script( 'wp-color-picker');
    }
}

if (!function_exists('suffix_lite_render_theme_settings_metabox')) :

    /**
     * Render theme settings meta box.
     *
     * @since 1.0.0
     */
    function suffix_lite_render_theme_settings_metabox($post, $metabox)
    {

        $post_id = $post->ID;

        // Meta box nonce for verification.
        wp_nonce_field(basename(__FILE__), 'suffix_lite_meta_box_nonce');
        // Fetch Options list.
        $page_layout = get_post_meta($post_id, 'suffix-lite-meta-select-layout', true);
        $page_image_layout = get_post_meta($post_id, 'suffix-lite-meta-image-layout', true);
        ?>

        <div class="suffix-lite-tab-main">

            <div class="suffix-lite-metabox-tab">
                <ul>
                    <li>
                        <a id="twp-tab-general" class="twp-tab-active" href="javascript:void(0)"><?php esc_html_e('Layout Settings', 'suffix-lite'); ?></a>
                    </li>
                </ul>
            </div>

            <div class="suffix-lite-tab-content">
                
                <div id="twp-tab-general-content" class="suffix-lite-content-wrap suffix-lite-tab-content-active">

                    <div class="suffix-lite-meta-panels">

                         <div class="suffix-lite-opt-wrap suffix-lite-opt-wrap-alt">
                            <label><?php esc_html_e('Single Page/Post Layout', 'suffix-lite'); ?></label>
                            <select name="suffix-lite-meta-select-layout" id="suffix-lite-meta-select-layout">
                                <option value="right-sidebar" <?php selected('right-sidebar', $page_layout); ?>>
                                    <?php _e('Content - Primary Sidebar', 'suffix-lite') ?>
                                </option>
                                <option value="left-sidebar" <?php selected('left-sidebar', $page_layout); ?>>
                                    <?php _e('Primary Sidebar - Content', 'suffix-lite') ?>
                                </option>
                                <option value="no-sidebar" <?php selected('no-sidebar', $page_layout); ?>>
                                    <?php _e('No Sidebar', 'suffix-lite') ?>
                                </option>
                            </select>
                        </div>

                        <div class="suffix-lite-opt-wrap suffix-lite-opt-wrap-alt">
                            <label><?php esc_html_e('Single Page/Post Image Layout', 'suffix-lite'); ?></label>
                            <select name="suffix-lite-meta-image-layout" id="suffix-lite-meta-image-layout">
                                <option value="full" <?php selected('full', $page_image_layout); ?>>
                                    <?php _e('Full', 'suffix-lite') ?>
                                </option>
                                <option value="left" <?php selected('left', $page_image_layout); ?>>
                                    <?php _e('Left', 'suffix-lite') ?>
                                </option>
                                <option value="right" <?php selected('right', $page_image_layout); ?>>
                                    <?php _e('Right', 'suffix-lite') ?>
                                </option>
                                <option value="no-image" <?php selected('no-image', $page_image_layout); ?>>
                                    <?php _e('No Image', 'suffix-lite') ?>
                                </option>
                            </select>
                        </div>


                    </div>
                </div>

            </div>
        </div>

        <?php
    }

endif;


if (!function_exists('suffix_lite_save_theme_settings_meta')) :

    /**
     * Save theme settings meta box value.
     *
     * @since 1.0.0
     *
     * @param int $post_id Post ID.
     * @param WP_Post $post Post object.
     */
    function suffix_lite_save_theme_settings_meta($post_id, $post)
    {

        // Verify nonce.
        if (!isset($_POST['suffix_lite_meta_box_nonce']) || !wp_verify_nonce($_POST['suffix_lite_meta_box_nonce'], basename(__FILE__))) {
            return;
        }

        // Bail if auto save or revision.
        if (defined('DOING_AUTOSAVE') || is_int(wp_is_post_revision($post)) || is_int(wp_is_post_autosave($post))) {
            return;
        }

        // Check the post being saved == the $post_id to prevent triggering this call for other save_post events.
        if (empty($_POST['post_ID']) || $_POST['post_ID'] != $post_id) {
            return;
        }

        // Check permission.
        if ('page' === $_POST['post_type']) {
            if (!current_user_can('edit_page', $post_id)) {
                return;
            }
        } else if (!current_user_can('edit_post', $post_id)) {
            return;
        }


        $suffix_lite_meta_select_layout = isset($_POST['suffix-lite-meta-select-layout']) ? esc_attr($_POST['suffix-lite-meta-select-layout']) : '';
        if (!empty($suffix_lite_meta_select_layout)) {
            update_post_meta($post_id, 'suffix-lite-meta-select-layout', sanitize_text_field($suffix_lite_meta_select_layout));
        }
        $suffix_lite_meta_image_layout = isset($_POST['suffix-lite-meta-image-layout']) ? esc_attr($_POST['suffix-lite-meta-image-layout']) : '';
        if (!empty($suffix_lite_meta_image_layout)) {
            update_post_meta($post_id, 'suffix-lite-meta-image-layout', sanitize_text_field($suffix_lite_meta_image_layout));
        }

    }

endif;

add_action('save_post', 'suffix_lite_save_theme_settings_meta', 10, 3);