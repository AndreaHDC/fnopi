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

add_image_size('square', 600, 600, true);
add_image_size('news-thumb', 400, 700, true);


// acf blocks
add_action('init', 'App\\register_acf_blocks');
function register_acf_blocks()
{
    $custom_blocks = ['fnopi_press_archive','fnopi_related_news','fnopi_video_reference','fnopi_related','fnopi_terms','fnopi_story_video','fnopi_stories_archive','fnopi_timeline_archive','fnopi_timeline_home','fnopi_video','fnopi_grid','fnopi_stories'];
    foreach ($custom_blocks as $custom_block) {
        register_block_type(__DIR__ . '/Blocks/'.$custom_block);
        $function = $custom_block.'_block_render_callback';
    }
}


// Register custom block patterns

function fnopi_block_patterns() {
    register_block_pattern_category('fnopi-patterns', array('label' => __('FNOPI Patterns', 'fnopi-theme')));

    register_block_pattern(
		'fnopi/story-layout',
		array(
			'title'       => __( 'Story Layout', 'fnopi' ),
			'description' => _x( 'The Layout for Single Story', 'fnopi' ),
			'categories'  => array( 'fnopi-patterns' ),
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
            <div class="wp-block-group story-content">
            
            <!-- wp:fnopi/video-reference {"name":"fnopi/video-reference","data":{"button_title":"Video reference","_button_title":"field_670a6507d3b96","reference":"Lorem Ipsum\r\n\u003cstrong\u003eLorem Ipusm\u003c/strong\u003e","_reference":"field_670a6517d3b97"},"mode":"edit"} /-->

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
			'categories'  => array( 'fnopi-patterns' ),
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


    register_block_pattern(
		'fnopi/news-layout',
		array(
			'title'       => __( 'News Layout', 'fnopi' ),
			'description' => _x( 'The Layout for the News', 'fnopi' ),
			'categories'  => array( 'fnopi-patterns' ),
			'content'     => '<!-- wp:group {"metadata":{"name":"News Hero"},"className":"news-hero","style":{"spacing":{"margin":{"top":"var:preset|spacing|70"}}},"layout":{"type":"constrained"}} -->
            <div class="wp-block-group news-hero" style="margin-top:var(--wp--preset--spacing--70)"><!-- wp:columns -->
            <div class="wp-block-columns"><!-- wp:column -->
            <div class="wp-block-column"><!-- wp:post-featured-image {"aspectRatio":"1"} /--></div>
            <!-- /wp:column -->

            <!-- wp:column {"className":"right"} -->
            <div class="wp-block-column right"><!-- wp:group {"layout":{"type":"default"}} -->
            <div class="wp-block-group"><!-- wp:post-date /-->

            <!-- wp:post-title {"level":1,"className":"h2","style":{"elements":{"link":{"color":{"text":"var:preset|color|fnopi-green"}}}},"textColor":"fnopi-green"} /--></div>
            <!-- /wp:group --></div>
            <!-- /wp:column --></div>
            <!-- /wp:columns --></div>
            <!-- /wp:group -->

            <!-- wp:group {"metadata":{"name":"News Content"},"className":"news-content","style":{"spacing":{"margin":{"top":"var:preset|spacing|70"}}},"layout":{"type":"constrained"}} -->
            <div class="wp-block-group news-content" style="margin-top:var(--wp--preset--spacing--70)"><!-- wp:columns -->
            <div class="wp-block-columns"><!-- wp:column {"className":"left"} -->
            <div class="wp-block-column left"><!-- wp:heading {"level":3,"style":{"elements":{"link":{"color":{"text":"var:preset|color|fnopi-green"}}}},"textColor":"fnopi-green"} -->
            <h3 class="wp-block-heading has-fnopi-green-color has-text-color has-link-color">Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua.</h3>
            <!-- /wp:heading --></div>
            <!-- /wp:column -->

            <!-- wp:column {"className":"right"} -->
            <div class="wp-block-column right"><!-- wp:paragraph -->
            <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.</p>
            <!-- /wp:paragraph --></div>
            <!-- /wp:column --></div>
            <!-- /wp:columns --></div>
            <!-- /wp:group -->

            <!-- wp:group {"metadata":{"name":"Title"},"className":"related-title","layout":{"type":"constrained"}} -->
            <div class="wp-block-group related-title"><!-- wp:heading {"textAlign":"left"} -->
            <h2 class="wp-block-heading has-text-align-left">Ultime Notizie</h2>
            <!-- /wp:heading --></div>
            <!-- /wp:group -->

            <!-- wp:fnopi/related-news {"name":"fnopi/related-news","mode":"preview"} /-->',
		)
	);

     

   
}
add_action( 'init', 'App\\fnopi_block_patterns' );



// add_action('init', 'App\\register_block_patterns');
// function register_block_patterns() {
//     register_block_pattern_category('fnopi-patterns', array('label' => __('FNOPI Patterns', 'fnopi-theme')));
    
//     // register_block_pattern(
//     //     'fnopi-theme/query-loop',
//     //     array(
//     //         'title'       => __('Custom Query Loop', 'fnopi-theme'),
//     //         'description' => _x('A custom query loop pattern.', 'Block pattern description', 'fnopi-theme'),
//     //         'content'     => view('patterns.news-query-loop')->render(),
//     //         'categories'  => array('fnopi-patterns', 'query'),
//     //     )
//     // );
//     register_block_pattern(
//         'fnopi-theme/post-template',
//         array(
//             'title'       => __('FNOPI Post Template', 'fnopi-theme'),
//             'description' => _x('A custom post template pattern.', 'Block pattern description', 'fnopi-theme'),
//             'content'     => view('patterns.news-post-template')->render(),
//             'categories'  => array('fnopi-patterns'),
//             'postTypes'   => array('post'),
//             'viewportWidth' => 1000,
//         )
//     );
// }



