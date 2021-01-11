<?php
if (!function_exists('suffix_lite_widget_section')) :
    /**
     *
     * @since Suffix 1.0.0
     *
     * @param null
     * @return null
     *
     */
    function suffix_lite_widget_section()
    {
        ?>
        <!-- Main Content section -->
        <?php
        $sidebar_home_1 = '';
        if (!is_active_sidebar('sidebar-home-2')) {
            $sidebar_home_1 = "full-width";
        } else {
            $sidebar_home_1 = "not-full-width";
        } ?>
        <?php if (is_active_sidebar('sidebar-home-1') || is_active_sidebar('sidebar-home-2')) { ?>
        <div class="twp-upper-block">
            <div id="primary" class="content-area <?php echo esc_attr($sidebar_home_1); ?>">
                <div class="grid-row">
                    <main id="main" class="site-main">
                        <?php dynamic_sidebar('sidebar-home-1'); ?>
                    </main>
                    <aside class="aside-bar">
                        <?php dynamic_sidebar('sidebar-2'); ?>
                    </aside>
                </div>
            </div>
            <?php if (is_active_sidebar('sidebar-home-2')) { ?>
                <aside class="widget-area">
                    <div class="theiaStickySidebar">
                        <?php dynamic_sidebar('sidebar-home-2'); ?>
                    </div>
                </aside>
            <?php } ?>

        </div>
    <?php } ?>
        <?php
    }
endif;
add_action('suffix_lite_action_sidebar_section', 'suffix_lite_widget_section', 50);