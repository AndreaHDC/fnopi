<?php

/**
 * Theme setup.
 */

namespace App;
use App\FnopiRest;
use function Roots\bundle;

/**
 * Register the theme assets.
 *
 * @return void
 */
add_action('wp_enqueue_scripts', function () {
    bundle('app')->enqueue();
    $ajax_vars = [
		'ajax_url' => admin_url( 'admin-ajax.php' )
	];
	bundle('app')->enqueue()->localize('localVars', $ajax_vars);
}, 100);



add_action('init', 'App\\fnopi_init_rest');
function fnopi_init_rest()
{
    $fnopiRest = new FnopiRest();
    $fnopiRest->init();
}

/**
 * Register the theme assets with the block editor.
 *
 * @return void
 */
add_action('enqueue_block_editor_assets', function () {
    bundle('editorscripts')->enqueue();
}, 100);



function enqueue_fslightbox_assets() {
    // Enqueue FsLightbox CSS
    wp_enqueue_style( 'fslightbox-css', 'https://cdn.jsdelivr.net/npm/fslightbox/index.css' );

    // Enqueue FsLightbox JS
    wp_enqueue_script( 'fslightbox-js', 'https://cdn.jsdelivr.net/npm/fslightbox/index.js', array(), null, true );

    // Enqueue Vimeo API JS
    wp_enqueue_script( 'vimeo-api-js', 'https://player.vimeo.com/api/player.js', array(), null, true );
}
add_action( 'wp_enqueue_scripts', 'App\\enqueue_fslightbox_assets' );

/**
 * Register the theme assets with the block editor.
 *
 * @return void
 */
add_action('enqueue_block_editor_assets', function () {
    bundle('editor')->enqueue();
}, 100);

/**
 * Register the initial theme setup.
 *
 * @return void
 */
add_action('after_setup_theme', function () {
    /**
     * Disable full-site editing support.
     *
     * @link https://wptavern.com/gutenberg-10-5-embeds-pdfs-adds-verse-block-color-options-and-introduces-new-patterns
     */
    remove_theme_support('block-templates');

    /**
     * Register the navigation menus.
     *
     * @link https://developer.wordpress.org/reference/functions/register_nav_menus/
     */
    register_nav_menus([
        'primary_navigation' => __('Primary Navigation', 'sage'),
        'footer_navigation' => __('Footer Navigation', 'sage'),
    ]);

    /**
     * Disable the default block patterns.
     *
     * @link https://developer.wordpress.org/block-editor/developers/themes/theme-support/#disabling-the-default-block-patterns
     */
    remove_theme_support('core-block-patterns');

    /**
     * Enable plugins to manage the document title.
     *
     * @link https://developer.wordpress.org/reference/functions/add_theme_support/#title-tag
     */
    add_theme_support('title-tag');

    /**
     * Enable post thumbnail support.
     *
     * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
     */
    add_theme_support('post-thumbnails');

    add_theme_support( 'align-wide' );
    
	add_theme_support( 'wp-block-styles' );


    /**
     * Enable responsive embed support.
     *
     * @link https://developer.wordpress.org/block-editor/how-to-guides/themes/theme-support/#responsive-embedded-content
     */
    add_theme_support('responsive-embeds');

    /**
     * Enable HTML5 markup support.
     *
     * @link https://developer.wordpress.org/reference/functions/add_theme_support/#html5
     */
    add_theme_support('html5', [
        'caption',
        'comment-form',
        'comment-list',
        'gallery',
        'search-form',
        'script',
        'style',
    ]);

    /**
     * Enable selective refresh for widgets in customizer.
     *
     * @link https://developer.wordpress.org/reference/functions/add_theme_support/#customize-selective-refresh-widgets
     */
    add_theme_support('customize-selective-refresh-widgets');


    //editor styles
    add_theme_support('editor-styles');
    add_editor_style(asset('editor.css')->relativePath(get_theme_file_path()));



}, 20);

/**
 * Register the theme sidebars.
 *
 * @return void
 */
add_action('widgets_init', function () {
    $config = [
        'before_widget' => '<section class="widget %1$s %2$s">',
        'after_widget' => '</section>',
        'before_title' => '<h3>',
        'after_title' => '</h3>',
    ];

    register_sidebar([
        'name' => __('Primary', 'sage'),
        'id' => 'sidebar-primary',
    ] + $config);

    register_sidebar([
        'name' => __('Footer', 'sage'),
        'id' => 'sidebar-footer',         
    ] + $config);
});






function fnopi_register_story_block_template() {
    $post_type_object = get_post_type_object( 'story' );
    $post_type_object->template = array( 
        array( 'core/pattern', array(
            'slug' => 'fnopi/story-layout',
        ) )
    );
}
add_action( 'init', 'App\\fnopi_register_story_block_template' );

function fnopi_register_milestone_block_template() {
    $post_type_object = get_post_type_object( 'milestone' );
    $post_type_object->template = array( 
        array( 'core/pattern', array(
            'slug' => 'fnopi/milestone-layout',
        ) )
    );
}
add_action( 'init', 'App\\fnopi_register_milestone_block_template' );



function fnopi_register_news_block_template() {
    $post_type_object = get_post_type_object( 'post' );
    $post_type_object->template = array( 
        array( 'core/pattern', array(
            'slug' => 'fnopi/news-layout',
        ) )
    );
}
add_action( 'init', 'App\\fnopi_register_news_block_template' );





function custom_tag_list_shortcode() {
    $tags = get_tags();
    $output = '<ul class="custom-tag-list">';
    foreach ($tags as $tag) {
        $output .= '<li>' . esc_html($tag->name) . '</li>';
    }
    $output .= '</ul>';
    return $output;
}
add_shortcode('tag_list', 'App\\custom_tag_list_shortcode');