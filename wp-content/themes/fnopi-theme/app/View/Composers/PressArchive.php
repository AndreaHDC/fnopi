<?php

namespace App\View\Composers;

use WP_Query;
use Roots\Acorn\View\Composer;

class PressArchive extends Composer
{
    /**
     * List of views served by this composer.
     *
     * @var array
     */
    protected static $views = [
        'blocks/fnopi_press_archive',
        
    ];

    /**
     * Data to be passed to view before rendering, but after merging.
     *
     * @return array
     */
    public function override()
    {
        return [
            'press' => $this->getPress(),
        ];
    }

    public function getPress()
    {
        $press = [];
        global $wp_query;
        $args = array(  
            'post_type'      => 'press',
            'post_status'    => array('publish'),
            'posts_per_page' => -1,
        );

        $temp = $wp_query;
        $wp_query= null;
        $wp_query = new WP_Query($args);
        if ($wp_query->have_posts()) :
            while ($wp_query->have_posts()) :
            $wp_query->the_post();
                $terms = get_the_terms(get_the_id(),'press-tax');
                $item = [
                    'id' => get_the_id(),
                    'title' => get_the_title(),
                    'excerpt' => get_the_excerpt(),
                    'images_link' => get_field('pdf_file',get_the_id()),
                    'pdf_link' => get_field('images_file',get_the_id()),
                    'terms' => $terms,
                ];
            $press[] = $item;
            endwhile;
        endif;
        $wp_query = null;
        $wp_query = $temp;
        wp_reset_query();

        return $press;
    }

    
}
