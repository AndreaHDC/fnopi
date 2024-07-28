<?php

/**
 * Theme filters.
 */

namespace App;

/**
 * Add "… Continued" to the excerpt.
 *
 * @return string
 */
add_filter('excerpt_more', function () {
    return sprintf(' &hellip; <a href="%s">%s</a>', get_permalink(), __('Continued', 'sage'));
});


// add_image_size('portfolio-thumb', 300, 390, true);
    

// ACF Theme settings
if (function_exists('acf_add_options_page')) {
    acf_add_options_page(
        array(
            'page_title' => 'Theme Settings',
            'menu_title' => 'Theme Settings',
            'menu_slug' => 'theme-general-settings',
            'capability' => 'edit_posts',
            'redirect' => false
        )
    );
}


// acf blocks
add_action('init', 'App\\register_acf_blocks');
function register_acf_blocks()
{
    $custom_blocks = ['fnopi_grid'];
    foreach ($custom_blocks as $custom_block) {
        register_block_type(__DIR__ . '/Blocks/'.$custom_block);
        $function = $custom_block.'_block_render_callback';
    }
}



