@php
// Support custom "anchor" values.
$anchor = '';
if ( ! empty( $block['anchor'] ) ) {
    $anchor = 'id="' . esc_attr( $block['anchor'] ) . '" ';
}
$box_1 = get_field('box_1');
$box_2 = get_field('box_2');
$box_3 = get_field('box_3');
$box_4 = get_field('box_4');
$box_5 = get_field('box_5');
@endphp
<section {{$anchor}} class="alignfull fnopi-grid pt-12">
    <div class="fnopi-grid-grid">
        
        {{-- box1 --}}
        <div class="box-1" id="grid-box-1">
            <div class="swiper h-full">
                <div class="swiper-wrapper h-full">
                    @foreach ($box_1 as $item)
                        <div class="swiper-slide h-full flex flex-col md:grid grid-rows-2 xl:grid-rows-1 xl:grid-cols-2">
                            <div class="content-wrapper order-2 xl:order-1">
                                <div class="content">
                                    <p>{{$item['content']}}</p>
                                </div>
                                <p class="mt-12 pl-[50px]">
                                    <strong class="uppercase">{{$item['name']}}</strong>
                                </p>
                            </div>
                            <div class="order-1 xl:order-2">
                                {!!wp_get_attachment_image( $item['image'], 'full', '', array('class' => 'w-full h-full object-cover'))!!}
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
         {{-- box1 --}}


        {{-- box 2 --}}
        <div class="box-2 hidden md:block" id="grid-box-2">
            <div class="swiper h-full">
                <div class="swiper-wrapper h-full">
                    @foreach ($box_2 as $item)
                    <div class="swiper-slide h-full md:grid  xl:grid-cols-2 xl:grid-rows-2">
                        <div class="">{!!wp_get_attachment_image( $item['image_1'], 'full', '', array('class' => 'w-full h-full object-cover'))!!}</div>
                        <div class="hidden xl:block"></div>
                        <div class="hidden xl:block"></div>
                        <div class="hidden xl:block">{!!wp_get_attachment_image( $item['image_2'], 'full', '', array('class' => 'w-full h-full object-cover'))!!}</div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        {{-- box 2 --}}


        <div class="box-3">
        </div>

        {{-- box 3 --}}
        <div class="box-4" id="grid-box-3">
            <div class="swiper h-full">
                <div class="swiper-wrapper h-full">
                    @foreach ($box_3 as $item)
                        <div class="swiper-slide h-full flex flex-col md:grid grid-rows-2 xl:grid-rows-3">
                            <div class="xl:row-span-2">
                                {!!wp_get_attachment_image( $item['image'], 'full', '', array('class' => 'w-full h-full object-cover'))!!}
                            </div>
                            <div class="row-span-1">
                                <div class="content-wrapper">
                                    <div class="content">
                                        <p>{{$item['content']}}</p>
                                    </div>
                                    <p class="mt-12 pl-[50px]">
                                        <strong class="uppercase">{{$item['name']}}</strong>
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        {{-- box 3 --}}

        {{-- box 4 --}}
        <div class="box-5 hidden xl:block" id="grid-box-4">
            <div class="swiper h-full">
                <div class="swiper-wrapper h-full">
                    @foreach ($box_4 as $item)
                    <div class="swiper-slide h-full xl:grid grid-rows-2">
                        <div>
                            {!!wp_get_attachment_image( $item['image'], 'full', '', array('class' => 'w-full h-full object-cover'))!!}
                        </div>
                        <div>
                            <div class="content-wrapper">
                                <div class="content">
                                    <p>{{$item['content']}}</p>
                                </div>
                                <p class="mt-12 pl-[50px]">
                                    <strong class="uppercase">{{$item['name']}}</strong>
                                </p>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        {{-- box 4 --}}


        {{-- box-5 --}}
        <div class="box-6 hidden xl:block" id="grid-box-5">
            <div class="swiper h-full">
                <div class="swiper-wrapper h-full">
                    @foreach ($box_5 as $item)
                        <div class="swiper-slide h-full">
                            {!!wp_get_attachment_image( $item['image'], 'full', '', array('class' => 'w-full h-full object-cover'))!!}
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
         {{-- box-5 --}}


    </div>
</section>