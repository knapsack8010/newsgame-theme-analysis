<?php
if (!function_exists('newsgame_theme_enqueue_styles')) {
    add_action('wp_enqueue_scripts', 'newsgame_theme_enqueue_styles');

    function newsgame_theme_enqueue_styles()
    {
        $min = defined('SCRIPT_DEBUG') && SCRIPT_DEBUG ? '' : '.min';
        $newsgame_version = wp_get_theme()->get('Version');
        $parent_style = 'morenews-style';

        // Enqueue Parent and Child Theme Styles
        wp_enqueue_style('bootstrap', get_template_directory_uri() . '/assets/bootstrap/css/bootstrap' . $min . '.css', array(), $newsgame_version);
        wp_enqueue_style($parent_style, get_template_directory_uri() . '/style' . $min . '.css', array(), $newsgame_version);
        wp_enqueue_style(
            'newsgame',
            get_stylesheet_directory_uri() . '/style.css',
            array('bootstrap', $parent_style),
            $newsgame_version
        );

        // Enqueue RTL Styles if the site is in RTL mode
        if (is_rtl()) {
            wp_enqueue_style(
                'morenews-rtl',
                get_template_directory_uri() . '/rtl.css',
                array($parent_style),
                $newsgame_version
            );
        }
    }
}

// Set up the WordPress core custom background feature.
add_theme_support('custom-background', apply_filters('morenews_custom_background_args', array(
    'default-color' => 'f5f5f5',
    'default-image' => '',
)));




function newsgame_filter_default_theme_options($defaults)
{
    $defaults['site_title_font_size'] = 72;
    $defaults['site_title_uppercase']  = 0;
    $defaults['select_header_image_mode']  = 'above';
    $defaults['show_primary_menu_desc']  = 0;
    $defaults['select_popular_tags_mode']  = 'category';
    $defaults['flash_news_title'] = __('Breaking News', 'newsgame');
    $defaults['select_main_banner_layout_section'] = 'layout-1';
    $defaults['select_main_banner_order'] = 'order-3';
    $defaults['aft_custom_title']           = __('Watch', 'newsgame');
    $defaults['secondary_color'] = '#12A86B';
    $defaults['global_show_min_read'] = 'no';
    $defaults['select_update_post_filterby'] = 'cat';
    $defaults['frontpage_content_type']  = 'frontpage-widgets-and-content';
    $defaults['featured_news_section_title'] = __('Featured News', 'newsgame');
    $defaults['show_featured_post_list_section']  = 1;
    $defaults['featured_post_list_section_title_1']           = __('General News', 'newsgame');
    $defaults['featured_post_list_section_title_2']           = __('Global News', 'newsgame');
    $defaults['featured_post_list_section_title_3']           = __('More News', 'newsgame');
    $defaults['single_related_posts_title']     = __('Related News', 'newsgame');
    return $defaults;
}
add_filter('morenews_filter_default_theme_options', 'newsgame_filter_default_theme_options', 1);
