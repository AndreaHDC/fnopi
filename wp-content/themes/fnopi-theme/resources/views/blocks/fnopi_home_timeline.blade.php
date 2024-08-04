@php
// Support custom "anchor" values.
$anchor = '';
if ( ! empty( $block['anchor'] ) ) {
    $anchor = 'id="' . esc_attr( $block['anchor'] ) . '" ';
}

@endphp
<section {{$anchor}} class="mt-12">
    <div id="fnopi-home-timeline" class="alignfull">
        @if (count($steps))
            @if (is_admin())
                <div class="grid grid-cols-5 gap-6">
                    @foreach ($steps as $milestone)
                        @if ($loop->index < 5)
                            
                       
                        <div class="swiper-slide">
                            <div class="border border-solid border-black h-full">
                                {!! wp_get_attachment_image($milestone['image'], 'square', false, ['class' => 'w-full h-auto']) !!}
                                <div class="content p-6 text-center">
                                    <p>{{$milestone['year']}}</p>
                                    <h5>{!!$milestone['title']!!}</h5>
                                </div>
                            </div>
                        </div>
                        @endif
                    @endforeach
                </div>
            @else
                <div class="swiper">
                    <div class="swiper-wrapper">
                        @foreach ($steps as $milestone)
                            <div class="swiper-slide">
                                <div class="border border-solid border-black h-full">
                                    {!! wp_get_attachment_image($milestone['image'], 'square', false, ['class' => 'w-full h-auto']) !!}
                                    <div class="content p-6 text-center">
                                        <p>{{$milestone['year']}}</p>
                                        <h5>{!!$milestone['title']!!}</h5>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="swiper-scrollbar"></div>
                </div>
            @endif
        @endif
    </div>
</section>