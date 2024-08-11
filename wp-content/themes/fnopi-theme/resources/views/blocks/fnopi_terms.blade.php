@php
// Support custom "anchor" values.
$anchor = '';
if ( ! empty( $block['anchor'] ) ) {
    $anchor = 'id="' . esc_attr( $block['anchor'] ) . '" ';
}
$terms = wp_get_post_terms(get_the_id(), 'stories-tax');

@endphp
<section {{$anchor}}>
    <div id="fnopi-terms">
        @if (!empty($terms) && !is_wp_error($terms))
            <ul class="flex gap-3 flex-wrap">
                @foreach ($terms as $term)
                    <li>
                        <a class="block uppercase text-xs whitespace-nowrap border border-solid border-fnopi-black rounded-full p-3 transition-colors hover:bg-fnopi-green hover:text-white" 
                        href="/infermieri/?term={{$term->slug}}">
                        {{$term->name}}</a>
                    </li>
                @endforeach
            </ul>
        @endif
    </div>
</section>