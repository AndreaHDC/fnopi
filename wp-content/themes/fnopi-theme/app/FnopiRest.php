<?php
namespace App;
use WP_REST_Server;
use WP_REST_Response;
use WP_REST_Request;
use WP_Error;
use WP_Query;

class FnopiRest
{



    public function __construct() {
	}

    public function init() {
        add_action('rest_api_init', [$this,'fnopi_rest_endpoints']);
	}
   
   
    //rest catalogo
    public function fnopi_rest_endpoints() {
        register_rest_route( 'api/v1/fnopi/', '/stories/(?P<page>\d+)/', array(
            'methods' => WP_REST_Server::READABLE,
            'callback' => [$this,'fnopi_rest_get_stories'],
            'permission_callback' =>[$this,'fnopi_rest_verify_user']
        ));
    }

    public function fnopi_rest_get_stories(WP_REST_Request $request) {
        $page = $request->get_param('page');
        $term = $request->get_param('term');
        global $wp_query;
        $stories = [];
        $args = array(
            'post_type' => 'story',
            'posts_per_page' => 24,
            'paged' => $page,
            'post_status' => 'publish',
        );
        if($term != 'all'){
            $args['tax_query'] = array(
                array(
                    'taxonomy' => 'stories-tax',
                    'field'    => 'slug',
                    'terms'    => $term,
                ),
            );
        }
        $temp = $wp_query;
        $wp_query = null;
        $wp_query = new WP_Query($args);
    
        if ($wp_query->have_posts()) :
            while ($wp_query->have_posts()) :
                $wp_query->the_post();
                $post_id = get_the_id();
                $story = [
                    'id' => $post_id,
                ];
                $stories[] = $story;
            endwhile;
        endif;
    
        // Get total number of pages
        $pagination['total_pages'] = $wp_query->max_num_pages;
        $pagination['current_page'] = $page;
    
        // Generate pagination links
        $pagination['links'] = paginate_links(array(
            'total' => $wp_query->max_num_pages,
            'current' => $page,
            'type' => 'array',
            'prev_next' => true,
            'prev_text' => __('« Prev'), 
            'next_text' => __('Next »'),
        ));
    
        $home_url = home_url();

        // Check if the domain contains "test"
        if (strpos($home_url, 'test') !== false) {
            // Logic for "test" domain
            if (!empty($pagination['links'])) {
                foreach ($pagination['links'] as &$link) {
                    // Replace the base URL with the desired structure for all pages
                    $link = preg_replace(
                        '/https:\/\/fnopi\.test\/wp-json\/api\/v1\/fnopi\/stories\/\d+\/page\//', 
                        'https://fnopi.test/infermieri/page/', 
                        $link
                    );

                    // Special handling for page 1
                    $link = preg_replace(
                        '/https:\/\/fnopi\.test\/wp-json\/api\/v1\/fnopi\/stories\/\d+\//', 
                        'https://fnopi.test/infermieri/page/1/', 
                        $link
                    );
                }
            }
        } else {
            // Logic for "production" domain
            if (!empty($pagination['links'])) {
                foreach ($pagination['links'] as &$link) {
                    // Replace the base URL with the desired structure for all pages
                    $link = preg_replace(
                        '/https:\/\/fnopi.vivastaging\.com\/wp-json\/api\/v1\/fnopi\/stories\/\d+\/page\//', 
                        'https://wewentfast.com/venues/page/', 
                        $link
                    );

                    // Special handling for page 1
                    $link = preg_replace(
                        '/https:\/\/fnopi.vivastaging\.com\/wp-json\/api\/v1\/fnopi\/stories\/\d+\//', 
                        'https://wewentfast.com/venues/page/1/', 
                        $link
                    );
                }
            }
        }
    
        $content = '';
        if (count($stories)) {
            foreach ($stories as $story) {
                $content .= view('partials.infermieri-box', ['story_id' => $story['id']])->render();
            }
        }
    
        $data = [
            'stories' => $content,
            'pagination' => $pagination,
        ];
    
        return new WP_REST_Response($data);
    }
    // /wp-json/api/v1/wwf/venues/

    public function fnopi_rest_verify_user(WP_REST_Request $request) {

        return true;


        $referer = $request->get_header('referer');
    
        // Allow only requests coming from your website's domain
        if ($referer && strpos($referer, home_url()) === 0) {
            return true;
        }
        
        return false; // Block access if the referer is not from your site
    }
}