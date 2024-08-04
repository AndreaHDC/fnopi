@php
// Support custom "anchor" values.
$anchor = '';
if ( ! empty( $block['anchor'] ) ) {
    $anchor = 'id="' . esc_attr( $block['anchor'] ) . '" ';
}
$years = array_keys($milestones);
sort($years);
// $poster = get_field('poster');
@endphp
<section {{$anchor}} class="">
    <div id="fnopi-timeline-archive">
        <div class="swiper">
            <div class="scollbar-wrapper flex gap-3 items-center">
                <span>{{reset($years)}}</span>
                <div class="swiper-scrollbar w-full overflow-hidden"></div>
                <span>{{end($years)}}</span>
            </div>
           
            <div class="swiper-wrapper">
                @foreach ($milestones as $year => $items)
                <div class="swiper-slide">
                    <span>{{$year}}</span>
                    <div class="content">
                        @foreach ($items as $step)
                            <div class="pl-4 pr-10 mb-12">
                                {!! wp_get_attachment_image($step['image'], 'square', false, ['class' => 'w-full h-auto']) !!}
                                <h4 class="uppercase font-bold text-sm mt-3">{!!$step['title']!!}</h4>
                                <p class="text-sm mt-3">{!!$step['content']!!}</p>
                            </div>
                        @endforeach
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>