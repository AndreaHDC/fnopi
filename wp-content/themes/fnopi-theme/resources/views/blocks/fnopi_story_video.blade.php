@php
// Support custom "anchor" values.
$anchor = '';
if ( ! empty( $block['anchor'] ) ) {
    $anchor = 'id="' . esc_attr( $block['anchor'] ) . '" ';
}

$video = get_field('video',get_the_id());
$cuts = get_field('cuts');
@endphp
<section {{$anchor}}>
    <div id="fnopi-story-single-video" class="mb-[50px]">
        <div class="alignfull px-6 lg:px-[60px] 2xl:px-[120px] bg-fnopi-black py-12 text-white my-[50px]">
            <a class="" style="margin-top:0" data-fslightbox="virtual-{{$video}}" href="#virtual-{{$video}}">
                <div class="max-w-7xl aspect-video mx-auto relative overflow-hidden fnopi-video">
                    {!! wp_get_attachment_image(get_post_thumbnail_id(get_the_id()), 'full', false, ['class' => 'w-full h-full object-cover', 'alt' => get_the_title(get_the_id())]) !!}
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
        

        @if (count($cuts))
            <div class="grid grid-cols-1 md:grid-cols-2 gap-10 xl:grid-cols-4 lg:gap-10">
                @foreach ($cuts as $cut)
                    <div>
                        <a class="fslightbox-trigger" data-videocut="{{$cut['video_id']}}" data-start="{{$cut['start']}}" data-end="{{$cut['end']}}" data-fslightbox="virtual-{{$cut['video_id']}}-{{$loop->index}}" href="#virtual-{{$cut['video_id']}}-{{$loop->index}}">
                            <div class="aspect-video rounded-xl relative overflow-hidden fnopi-video">
                                {!! wp_get_attachment_image($cut['image'], 'full', false, ['class' => 'w-full h-full object-cover', 'alt' => get_the_title(get_the_id())]) !!}
                                <div class="absolute inset-0 flex items-center justify-center">
                                    <div class="w-[50px] h-[50px]">
                                        <svg class="w-full h-auto" xmlns="http://www.w3.org/2000/svg" width="77" height="77" viewBox="0 0 77 77">
                                            <g id="Icon_feather-play-circle" data-name="Icon feather-play-circle" transform="translate(-1.5 -1.5)">
                                            <path id="Path_1" data-name="Path 1" d="M77,40A37,37,0,1,1,40,3,37,37,0,0,1,77,40Z" fill="none" stroke="#a5be3a" stroke-linecap="round" stroke-linejoin="round" stroke-width="3"/>
                                            <path id="Path_2" data-name="Path 2" d="M15,12,37.2,26.8,15,41.6Z" transform="translate(17.6 13.2)" fill="none" stroke="#a5be3a" stroke-linecap="round" stroke-linejoin="round" stroke-width="3"/>
                                            </g>
                                        </svg>
                                    </div>
                                   
                                </div>
                            </div>
                        </a>
                        <h3 class="mt-3 lg:mt-6 text-center text-base lg:text-2xl">{!!$cut['title']!!}</h3>
                        <div class="hidden">
                            <iframe
                                class="story-cut-video"
                                src="https://player.vimeo.com/video/{{$cut['video_id']}}#t={{$cut['start']}}s"
                                id="virtual-{{$cut['video_id']}}-{{$loop->index}}"
                                width="1920px"
                                height="1080px"
                                frameBorder="0"
                                allow="autoplay; fullscreen"
                                allowFullScreen
                            ></iframe>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</section>