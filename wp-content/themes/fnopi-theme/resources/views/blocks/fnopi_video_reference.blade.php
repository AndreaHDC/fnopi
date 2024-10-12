@php
// Support custom "anchor" values.
$anchor = '';
if ( ! empty( $block['anchor'] ) ) {
    $anchor = 'id="' . esc_attr( $block['anchor'] ) . '" ';
}

$button_title = get_field('button_title');
$reference_video = get_field('reference');
@endphp
<section {{$anchor}} class="">
    <div id="fnopi-video-reference" class="">
        @if ($reference_video)
        <div class="border-b border-b-fnopi-black">
            <button type="button" class="fnopi-video-reference-button">
                <span>{{$button_title}}</span>
            </button>
        </div>
           
        <div id="fnopi-video-reference-content" class="fnopi-video-reference-content pt-3 overflow-hidden h-0" aria-hidden="true">
            {!! $reference_video !!}
        </div>
        @endif
        
    </div>
</section>