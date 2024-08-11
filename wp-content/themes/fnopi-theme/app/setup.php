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



function fnopi_block_patterns() {
    register_block_pattern_category(
        'layout',
        array( 'label' => __( 'Stoty Layouts', 'fnopi' ) )
    );

    register_block_pattern(
		'fnopi/story-layout',
		array(
			'title'       => __( 'Story Layout', 'fnopi' ),
			'description' => _x( 'The Layout for Single Story', 'fnopi' ),
			'categories'  => array( 'layout' ),
			'content'     => '
            <!-- wp:group {"className":"story-title animate-top","style":{"spacing":{"margin":{"bottom":"var:preset|spacing|70"}}},"layout":{"type":"constrained"}} -->
            <div class="wp-block-group story-title animate-top" style="margin-bottom:var(--wp--preset--spacing--70)"><!-- wp:heading {"textAlign":"center","level":1,"style":{"spacing":{"margin":{"bottom":"var:preset|spacing|40"}}}} -->
            <h1 class="wp-block-heading has-text-align-center" style="margin-bottom:var(--wp--preset--spacing--40)"><em>EDOARDO</em> MANZONI</h1>
            <!-- /wp:heading -->

            <!-- wp:heading {"textAlign":"center"} -->
            <h2 class="wp-block-heading has-text-align-center">Sotto titolo Lorem ipsum dolor sit amet, consetetur sadipscing elitr,</h2>
            <!-- /wp:heading --></div>
            <!-- /wp:group -->

            <!-- wp:group {"layout":{"type":"constrained"}} -->
            <div class="wp-block-group"><!-- wp:group {"className":"animate-top","layout":{"type":"constrained"}} -->
            <div class="wp-block-group animate-top"><!-- wp:image {"id":235,"sizeSlug":"large","linkDestination":"none","align":"center"} -->
            <figure class="wp-block-image aligncenter size-large"><img src="'.home_url().'/wp-content/uploads/2024/08/Path-24.svg" alt="" class="wp-image-235"/></figure>
            <!-- /wp:image -->

            <!-- wp:paragraph {"align":"center","style":{"spacing":{"margin":{"top":"var:preset|spacing|50"}}}} -->
            <p class="has-text-align-center" style="margin-top:var(--wp--preset--spacing--50)">Solo dal diverso, noi possiamo mettere alla prova le nostre organizzazioni, le nostre idee, i nostri pensieri”</p>
            <!-- /wp:paragraph --></div>
            <!-- /wp:group -->

            <!-- wp:fnopi/storyvideo {"name":"fnopi/storyvideo","data":{"cuts_0_title":"Perchè ho scelto di fare l’infermiere","_cuts_0_title":"field_66b7a22d05eec","cuts_0_video_id":"650901039","_cuts_0_video_id":"field_66b7a99dfcb55","cuts_0_image":242,"_cuts_0_image":"field_66b7a1472ee60","cuts_1_title":"Il mio primo giorno di lavoro","_cuts_1_title":"field_66b7a22d05eec","cuts_1_video_id":"650901039","_cuts_1_video_id":"field_66b7a99dfcb55","cuts_1_image":247,"_cuts_1_image":"field_66b7a1472ee60","cuts_2_title":"Il mio consiglio alle nuove generazioni","_cuts_2_title":"field_66b7a22d05eec","cuts_2_video_id":"650901039","_cuts_2_video_id":"field_66b7a99dfcb55","cuts_2_image":248,"_cuts_2_image":"field_66b7a1472ee60","cuts":3,"_cuts":"field_66b7a11c2ee5f"},"mode":"preview"} /--></div>
            <!-- /wp:group -->

            <!-- wp:group {"className":"story-content","layout":{"type":"constrained"}} -->
            <div class="wp-block-group story-content"><!-- wp:heading {"level":6} -->
            <h6 class="wp-block-heading">Video reference</h6>
            <!-- /wp:heading -->

            <!-- wp:columns {"className":"maincol"} -->
            <div class="wp-block-columns maincol"><!-- wp:column {"width":"66.66%"} -->
            <div class="wp-block-column" style="flex-basis:66.66%"><!-- wp:paragraph -->
            <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.<br>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.</p>
            <!-- /wp:paragraph -->

            <!-- wp:heading {"level":3} -->
            <h3 class="wp-block-heading">“La cosa che mi dà più gioia è poter andare concretamente nei servizi siano essi educativi o di sanità. Cosa che ho potuto fare durante il periodo del Covid, quando avevo scarsità di operatori: La possibilità di tornare a imboccare le persone in un reparto durante il Covid è stata un’esperienza che ha rivitalizzato la mia radice infermieristica”</h3>
            <!-- /wp:heading -->

            <!-- wp:paragraph -->
            <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.<br>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.</p>
            <!-- /wp:paragraph -->

            <!-- wp:columns -->
            <div class="wp-block-columns"><!-- wp:column -->
            <div class="wp-block-column"><!-- wp:heading {"level":3} -->
            <h3 class="wp-block-heading">“La cosa che mi dà più gioia è poter andare concretamente nei servizi siano essi educativi o di sanità. Cosa che ho potuto fare durante il periodo del Covid, quando avevo scarsità di operatori: La possibilità di tornare a imboccare le persone in un reparto durante il Covid è stata un’esperienza che ha rivitalizzato la mia radice infermieristica”</h3>
            <!-- /wp:heading --></div>
            <!-- /wp:column -->

            <!-- wp:column -->
            <div class="wp-block-column"><!-- wp:paragraph -->
            <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.<br></p>
            <!-- /wp:paragraph --></div>
            <!-- /wp:column --></div>
            <!-- /wp:columns -->

            <!-- wp:buttons {"style":{"spacing":{"margin":{"top":"var:preset|spacing|70"}}}} -->
            <div class="wp-block-buttons" style="margin-top:var(--wp--preset--spacing--70)"><!-- wp:button {"className":"is-style-download"} -->
            <div class="wp-block-button is-style-download"><a class="wp-block-button__link wp-element-button">Scarica la biografia di Edoardo Manzoni</a></div>
            <!-- /wp:button --></div>
            <!-- /wp:buttons --></div>
            <!-- /wp:column -->

            <!-- wp:column {"width":"33.33%"} -->
            <div class="wp-block-column" style="flex-basis:33.33%"><!-- wp:fnopi/terms {"name":"fnopi/terms","data":{"field_66b8d14d91de1":"story-tag"},"mode":"preview"} /--></div>
            <!-- /wp:column --></div>
            <!-- /wp:columns --></div>
            <!-- /wp:group -->

            <!-- wp:fnopi/related {"name":"fnopi/related","data":{"title":"Potrebbe interessarti anche:","_title":"field_66b8b647c0a2e","related":["214","188"],"_related":"field_66b8b29f73c70"},"mode":"edit"} /-->

            <!-- wp:fnopi/stories {"name":"fnopi/stories","data":{"title":"\u003cem\u003eStorie\u003c/em\u003e di infermieri","_title":"field_66ae46e33b609","stories":"","_stories":"field_66ae467dff7de","categories":"","_categories":"field_66ae46abff7df"},"mode":"preview"} /-->

            <!-- wp:group {"align":"full","backgroundColor":"fnopi-blue","layout":{"type":"constrained"}} -->
            <div class="wp-block-group alignfull has-fnopi-blue-background-color has-background"><!-- wp:quote -->
            <blockquote class="wp-block-quote"><!-- wp:paragraph {"align":"center"} -->
            <p class="has-text-align-center">Ciò che mi piacerebbe dire a chi intraprende la carriera infermieristica,<br>oggi, è che fa uno dei lavori più belli del mondo perché è più in linea con i bisogni della gente di oggi<br><strong>Edoardo Manzoni</strong></p>
            <!-- /wp:paragraph --></blockquote>
            <!-- /wp:quote --></div>
            <!-- /wp:group -->',
		)
	);

    register_block_pattern(
		'fnopi/milestone-layout',
		array(
			'title'       => __( 'Milestone Layout', 'fnopi' ),
			'description' => _x( 'The Layout for Milestone', 'fnopi' ),
			'categories'  => array( 'layout' ),
			'content'     => '
            <!-- wp:group {"className":"milestone-title","style":{"spacing":{"margin":{"bottom":"var:preset|spacing|70"}}},"layout":{"type":"constrained"}} -->
            <div class="wp-block-group milestone-title" style="margin-bottom:var(--wp--preset--spacing--70)"><!-- wp:heading {"textAlign":"center","level":1,"style":{"spacing":{"margin":{"bottom":"var:preset|spacing|40"}}}} -->
            <h1 class="wp-block-heading has-text-align-center" style="margin-bottom:var(--wp--preset--spacing--40)"><em><strong>2020.</strong> COVID 19</em></h1>
            <!-- /wp:heading -->

            <!-- wp:heading {"textAlign":"center"} -->
            <h2 class="wp-block-heading has-text-align-center">Inizio della pandemia</h2>
            <!-- /wp:heading -->

            <!-- wp:fnopi/terms {"name":"fnopi/terms","data":{"taxonomy":"milestone-tags","_taxonomy":"field_66b8d14d91de1"},"mode":"preview"} /--></div>
            <!-- /wp:group -->

            <!-- wp:group {"className":"milestone-content-wrapper","layout":{"type":"constrained"}} -->
            <div class="wp-block-group milestone-content-wrapper"><!-- wp:post-featured-image /-->

            <!-- wp:columns {"style":{"spacing":{"margin":{"top":"var:preset|spacing|70"}}}} -->
            <div class="wp-block-columns" style="margin-top:var(--wp--preset--spacing--70)"><!-- wp:column {"width":"80%"} -->
            <div class="wp-block-column" style="flex-basis:80%"><!-- wp:paragraph -->
            <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.</p>
            <!-- /wp:paragraph --></div>
            <!-- /wp:column -->

            <!-- wp:column {"width":"20%"} -->
            <div class="wp-block-column" style="flex-basis:20%"></div>
            <!-- /wp:column --></div>
            <!-- /wp:columns -->

            <!-- wp:columns {"className":"left-columns","style":{"spacing":{"margin":{"top":"var:preset|spacing|70"}}}} -->
            <div class="wp-block-columns left-columns" style="margin-top:var(--wp--preset--spacing--70)"><!-- wp:column {"width":"33.33%"} -->
            <div class="wp-block-column" style="flex-basis:33.33%"><!-- wp:heading {"level":3,"style":{"spacing":{"margin":{"bottom":"var:preset|spacing|70"}}}} -->
            <h3 class="wp-block-heading" style="margin-bottom:var(--wp--preset--spacing--70)">“La cosa che mi dà più gioia è poter andare concretamente nei servizi siano essi educativi o di sanità. Cosa che ho potuto fare durante il periodo del Covid, quando avevo scarsità di operatori: La possibilità di tornare a imboccare le persone in un reparto durante il Covid è stata un’esperienza che ha rivitalizzato la mia radice infermieristica”</h3>
            <!-- /wp:heading -->

            <!-- wp:image {"id":270,"sizeSlug":"full","linkDestination":"none"} -->
            <figure class="wp-block-image size-full"><img src="'.home_url().'/wp-content/uploads/2024/08/02-3.jpg" alt="" class="wp-image-270"/><figcaption class="wp-element-caption">Lorem ipsum dolor sit amet, consetetur sadipscing<br>elitr, sed diam nonumy eirmod temp</figcaption></figure>
            <!-- /wp:image --></div>
            <!-- /wp:column -->

            <!-- wp:column {"width":"66.66%"} -->
            <div class="wp-block-column" style="flex-basis:66.66%"><!-- wp:paragraph -->
            <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.<br>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.<br>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet,</p>
            <!-- /wp:paragraph -->

            <!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"var:preset|spacing|70"}}}} -->
            <p style="margin-top:var(--wp--preset--spacing--70)">Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed di</p>
            <!-- /wp:paragraph --></div>
            <!-- /wp:column --></div>
            <!-- /wp:columns -->

            <!-- wp:image {"id":271,"sizeSlug":"full","linkDestination":"none"} -->
            <figure class="wp-block-image size-full"><img src="'.home_url().'/wp-content/uploads/2024/08/Image-30.jpg" alt="" class="wp-image-271"/><figcaption class="wp-element-caption">Didascalia: Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod temp</figcaption></figure>
            <!-- /wp:image -->

            <!-- wp:columns {"className":"left-columns","style":{"spacing":{"margin":{"top":"var:preset|spacing|70"}}}} -->
            <div class="wp-block-columns left-columns" style="margin-top:var(--wp--preset--spacing--70)"><!-- wp:column {"width":"66.66%"} -->
            <div class="wp-block-column" style="flex-basis:66.66%"><!-- wp:paragraph -->
            <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.<br>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.<br>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet,</p>
            <!-- /wp:paragraph -->

            <!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"var:preset|spacing|70"}}}} -->
            <p style="margin-top:var(--wp--preset--spacing--70)">Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed di</p>
            <!-- /wp:paragraph --></div>
            <!-- /wp:column -->

            <!-- wp:column {"width":"33.33%"} -->
            <div class="wp-block-column" style="flex-basis:33.33%"><!-- wp:heading {"level":3,"style":{"spacing":{"margin":{"bottom":"var:preset|spacing|70"}}}} -->
            <h3 class="wp-block-heading" style="margin-bottom:var(--wp--preset--spacing--70)">“La cosa che mi dà più gioia è poter andare concretamente nei servizi siano essi educativi o di sanità. Cosa che ho potuto fare durante il periodo del Covid, quando avevo scarsità di operatori: La possibilità di tornare a imboccare le persone in un reparto durante il Covid è stata un’esperienza che ha rivitalizzato la mia radice infermieristica”</h3>
            <!-- /wp:heading -->

            <!-- wp:image {"id":270,"sizeSlug":"full","linkDestination":"none"} -->
            <figure class="wp-block-image size-full"><img src="'.home_url().'/wp-content/uploads/2024/08/02-3.jpg" alt="" class="wp-image-270"/><figcaption class="wp-element-caption">Lorem ipsum dolor sit amet, consetetur sadipscing<br>elitr, sed diam nonumy eirmod temp</figcaption></figure>
            <!-- /wp:image --></div>
            <!-- /wp:column --></div>
            <!-- /wp:columns --></div>
            <!-- /wp:group -->

            <!-- wp:fnopi/related {"name":"fnopi/related","data":{"title":"Potrebbe interessarti anche:","_title":"field_66b8b647c0a2e","related":["214","188"],"_related":"field_66b8b29f73c70"},"mode":"edit"} /-->

            <!-- wp:fnopi/stories {"name":"fnopi/stories","data":{"title":"\u003cem\u003eStorie\u003c/em\u003e di infermieri","_title":"field_66ae46e33b609","stories":"","_stories":"field_66ae467dff7de","categories":"","_categories":"field_66ae46abff7df"},"mode":"preview"} /-->

            <!-- wp:group {"align":"full","backgroundColor":"fnopi-blue","layout":{"type":"constrained"}} -->
            <div class="wp-block-group alignfull has-fnopi-blue-background-color has-background"><!-- wp:quote -->
            <blockquote class="wp-block-quote"><!-- wp:paragraph {"align":"center"} -->
            <p class="has-text-align-center">Ciò che mi piacerebbe dire a chi intraprende la carriera infermieristica,<br>oggi, è che fa uno dei lavori più belli del mondo perché è più in linea con i bisogni della gente di oggi<br><strong>Edoardo Manzoni</strong></p>
            <!-- /wp:paragraph --></blockquote>
            <!-- /wp:quote --></div>
            <!-- /wp:group -->',
		)
	);
}
add_action( 'init', 'App\\fnopi_block_patterns' );


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