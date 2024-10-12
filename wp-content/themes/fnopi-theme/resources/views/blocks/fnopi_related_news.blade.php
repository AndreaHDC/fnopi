@php
// Support custom "anchor" values.
$anchor = '';
if ( ! empty( $block['anchor'] ) ) {
    $anchor = 'id="' . esc_attr( $block['anchor'] ) . '" ';
}
$current_post_id = get_the_ID();
$args = array(
    'post_type' => 'post',
    'posts_per_page' => 3,
    'post__not_in' => array($current_post_id),
    'orderby' => 'date',
    'order' => 'DESC'
);
$related_posts = new WP_Query($args);

@endphp
<section {{$anchor}}>
    <div id="fnopi-related-news" class="my-12">
        @if ($related_posts->have_posts())
            @while ($related_posts->have_posts()) @php($related_posts->the_post())
                @include('partials.post-card')
            @endwhile
        @endif  
    </div>
</section>