<?php
global $post;
if (!function_exists('suffix_lite_single_page_title')) :
    function suffix_lite_single_page_title()
    {
        global $post;
        // Check if single.
        ?>
        <?php if (is_singular()) { ?>
        <div class="inner-banner inner-banner-1">
            <header class="entry-header">
                <div class="suffix-lite-wrapper">
                    <div class="grid-row">
                        <div class="column column-full">
                            <div class="twp-bredcrumb">
                                <?php
                                /**
                                 * Hook - suffix_lite_add_breadcrumb.
                                 */
                                do_action('suffix_lite_action_breadcrumb');
                                ?>
                            </div>
                        </div>
                        <div class="column column-full">
                            <div class="item-metadata twp-meta-categories twp-meta-categories-bg">
                                <?php suffix_lite_entry_category(); ?>
                            </div>
                            <?php the_title('<h1 class="entry-title">', '</h1>'); ?>
                            <?php if (!is_page()) { ?>
                                <div class="entry-meta entry-inner">
                                    <?php
                                    suffix_lite_posted_on(); ?>
                                </div>
                            <?php } ?>
                        </div>

                    </div>
                </div>
            </header>
        </div>
    <?php } else { ?>
        <div class="inner-banner inner-banner-1">
            <header class="entry-header">
                <div class="suffix-lite-wrapper">
                    <div class="grid-row">
                        <div class="column column-full">
                            <?php if (is_404()) { ?>
                                <h1 class="entry-title"><?php esc_html_e('Oops! That page can&rsquo;t be found.', 'suffix-lite'); ?></h1>
                            <?php } elseif (is_archive()) {
                                the_archive_title('<h1 class="entry-title">', '</h1>');
                                the_archive_description('<div class="taxonomy-description">', '</div>');
                            } elseif (is_search()) { ?>
                                <h1 class="entry-title"><?php printf(esc_html__('Search Results for: %s', 'suffix-lite'), '<span>' . get_search_query() . '</span>'); ?></h1>
                            <?php } else { ?>
                            <?php }
                            ?>
                        </div>
                        <div class="column column-full">
                            <div class="twp-bredcrumb">
                                <?php
                                /**
                                 * Hook - suffix_lite_add_breadcrumb.
                                 */
                                do_action('suffix_lite_action_breadcrumb');
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </header>
        </div>
    <?php } ?>

        <?php
    }
endif;
add_action('suffix-lite-page-inner-title', 'suffix_lite_single_page_title', 15);
