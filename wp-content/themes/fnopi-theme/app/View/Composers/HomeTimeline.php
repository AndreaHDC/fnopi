<?php

namespace App\View\Composers;

use WP_Query;
use DateTime;
use Roots\Acorn\View\Composer;

class HomeTimeline extends Composer
{
    /**
     * List of views served by this composer.
     *
     * @var array
     */
    protected static $views = [
        'blocks/fnopi_home_timeline',
        
    ];

    /**
     * Data to be passed to view before rendering, but after merging.
     *
     * @return array
     */
    public function override()
    {
        return [
            'steps' => $this->getMilestones(),
        ];
    }

    public function getMilestones()
    {
        $ids = get_field('milestones');
        $milestones = [];
        global $wp_query;
        $args = array(
            'post_type'      => 'milestone',
            'post_status'    => array('publish'),
            'posts_per_page' => -1,
            'post__in'       => $ids,  // Add this line to filter by IDs
            'meta_key'       => 'date',
            'orderby'        => 'meta_value',
            'order'          => 'DESC',
            'meta_type'      => 'DATE',  // Specify the meta_type as DATE for proper date handling
        );

        $temp = $wp_query;
        $wp_query= null;
        $wp_query = new WP_Query($args);
        if ($wp_query->have_posts()) :
            while ($wp_query->have_posts()) :
            $wp_query->the_post();
                $date = get_field('date',get_the_id());
                $dateParts = explode('/', $date);
                $year = $dateParts[2];
                $milestone = [
                    'id' => get_the_id(),
                    'title' => get_the_title(),
                    'year' => $year,
                    'date' => $date,
                    'image' => get_field('image',get_the_id()),
                ];
            $milestones[] = $milestone;
            endwhile;
        endif;
        $wp_query = null;
        $wp_query = $temp;
        wp_reset_query();

        return $milestones;
    }

    
}
