@php
// Support custom "anchor" values.
$anchor = '';
if ( ! empty( $block['anchor'] ) ) {
    $anchor = 'id="' . esc_attr( $block['anchor'] ) . '" ';
}

$taxonomy = get_field('taxonomy');
$terms = wp_get_post_terms(get_the_id(), $taxonomy);

@endphp
<section {{$anchor}}>
    <div id="fnopi-terms">
        @if (!empty($terms) && !is_wp_error($terms))
            <ul class="flex gap-3 flex-wrap">
                @foreach ($terms as $term)
                    <li>
                        <span class="block uppercase text-xs whitespace-nowrap border border-solid border-fnopi-black rounded-full px-3 py-1">
                        {{$term->name}}</span>
                    </li>
                @endforeach
            </ul>
        @else
        No Tags Found, add some
        @endif
    </div>
</section>