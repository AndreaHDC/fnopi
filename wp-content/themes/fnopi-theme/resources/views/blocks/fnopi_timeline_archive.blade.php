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
    <div id="fnopi-timeline-archive" class="animate-opacity">
        <div class="swiper">
            <div class="scollbar-wrapper flex gap-3 items-center">
                <span>{{reset($years)}}</span>
                <div class="swiper-scrollbar w-full overflow-hidden"></div>
                <span>{{end($years)}}</span>
            </div>

            <div class="swiper-wrapper">
                @foreach ($milestones as $year => $items)
                <div class="swiper-slide">        
                    <div class="main-year">{{$year}}</div>

                    
                    <div class="content">
                        @foreach ($items as $step)
                            <div class="pl-4 pr-10 mb-12">
                                <a href="{{$step['link']}}" class="mb-0">
                                    <h4 class="uppercase font-bold text-sm mt-3 mb-3 text-fnopi-dark-blue hover:underline">{!!$step['title']!!}</h4>
                                </a>
                                {!!$step['content']!!}
                            </div>
                        @endforeach
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>