@php
// Support custom "anchor" values.
$anchor = '';
if ( ! empty( $block['anchor'] ) ) {
    $anchor = 'id="' . esc_attr( $block['anchor'] ) . '" ';
}
$poster = get_field('poster');
$video = get_field('video');
@endphp
<div {{$anchor}} class="fnopi-video">
    <a style="margin-top:0" data-fslightbox="virtual-{{$video}}" href="#virtual-{{$video}}">
        <div class="aspect-video relative overflow-hidden">
            {!! wp_get_attachment_image($poster, 'full', false, ['class' => 'w-full h-full object-cover']) !!}
                <div class="absolute inset-0 flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="77" height="77" viewBox="0 0 77 77">
                        <g id="Icon_feather-play-circle" data-name="Icon feather-play-circle" transform="translate(-1.5 -1.5)">
                        <path id="Path_1" data-name="Path 1" d="M77,40A37,37,0,1,1,40,3,37,37,0,0,1,77,40Z" fill="none" stroke="#a5be3a" stroke-linecap="round" stroke-linejoin="round" stroke-width="3"/>
                        <path id="Path_2" data-name="Path 2" d="M15,12,37.2,26.8,15,41.6Z" transform="translate(17.6 13.2)" fill="none" stroke="#a5be3a" stroke-linecap="round" stroke-linejoin="round" stroke-width="3"/>
                        </g>
                    </svg>
                </div>
            
        </div>
    </a>
    <div class="hidden">
        <iframe
            src="https://player.vimeo.com/video/{{$video}}"
            id="virtual-{{$video}}"
            width="1920px"
            height="1080px"
            frameBorder="0"
            allow="autoplay; fullscreen"
            allowFullScreen
        ></iframe>
    </div>
</div>