@php
// Support custom "anchor" values.
$anchor = '';
if ( ! empty( $block['anchor'] ) ) {
    $anchor = 'id="' . esc_attr( $block['anchor'] ) . '" ';
}
$title = get_field('title');
$stories = get_field('stories');
$categories = get_field('categories');

if (!$stories) {
    $args = array(
        'post_type' => 'story',  // Replace 'story' with your custom post type slug
        'posts_per_page' => 4,
        'orderby' => 'rand',
        'post__not_in' => array(get_the_ID()) // Exclude the current post ID
    );
    $random_stories = new WP_Query($args);
    if ($random_stories->have_posts()) {
        $stories = array();
        while ($random_stories->have_posts()) {
            $random_stories->the_post();
            $stories[] = get_the_ID();
        }
        wp_reset_postdata(); // Reset post data after custom query
    }
}
@endphp
<section {{$anchor}} class="alignfull py-12 lg:py-[100px] bg-fnopi-black">
    <div id="fnopi-stories">
        <div class="alignwide mx-auto px-6 lg:px-[60px] 2xl:px-[120px]">
            <div class="lg:pl-[100px]">
                <div class="title text-white flex flex-col md:flex-row justify-between">
                    <h2 class="animate-left">{!!$title!!}</h2>
                    <a href="/infermieri/">GUARDA TUTTI I VIDEO</a>
                </div>
            </div>
            @if (count($stories))
                @if (is_admin())
                <div class="grid grid-cols-4 gap-12 mt-12">
                    @foreach ($stories as $story_id)
                        <div class="">
                            <div class="image aspect-video overflow-hidden rounded-xl">
                                <a href="{{get_the_permalink($story_id)}}">
                                {!! wp_get_attachment_image(get_post_thumbnail_id($story_id), 'full', false, ['class' => 'w-full h-full object-cover', 'alt' => get_the_title($story_id)]) !!}
                                </a>
                            </div>
                            <h3 class="text-fnopi-green uppercase font-bold my-3 font-fnopi-body text-base">{!!get_the_title($story_id)!!}</h3>
                            <p class="text-white">{!!get_the_excerpt($story_id)!!}</p>
                            <a class="text-white font-bold mt-3 inline-block underline hover:no-underline" href="{{get_the_permalink($story_id)}}">Leggi Tutto</a>
                        </div>
                    @endforeach
                </div>
                @else
                <div class="swiper mt-12">
                    <div class="swiper-wrapper pb-[80px]">
                        @foreach ($stories as $story_id)
                            <div class="swiper-slide">
                                @include('partials/infermieri-box')
                            </div>
                        @endforeach
                    </div>
                    <div class="swiper-pagination"></div>
                </div>
                @endif
            @endif
            @if ($categories && count($categories))
                <div class="lg:pl-[100px] mt-12">
                    <div class="title-temi text-white flex flex-col md:flex-row justify-end">
                        <a href="{{home_url()}}/infermieri/">ESPLORA PER TEMI</a>
                    </div>
                </div>
                <div class="grid md:grid-cols-3 gap-10 md:gap-6 mt-12 animate-top">
                    @foreach ($categories as $item)
                        @php
                             $term = get_term_by('id', $item, 'stories-tax');
                             $color = 'bg-fnopi-dark-green text-fnopi-black';
                             if ($loop->index == 1) {
                                $color = 'bg-fnopi-blue text-fnopi-black';
                             }
                             if ($loop->index == 2) {
                                $color = ' bg-fnopi-dark-blue text-white';
                             }
                        @endphp
                        <a href="/infermieri/?term={{$term->slug}}" class="{{$color}} aspect-video  transition-colors  hover:bg-fnopi-gray hover:text-white rounded-xl px-6 flex items-center justify-center">
                            
                            <span class="font-fnopi-heading font-normal text-center text-2xl md:text-lg lg:text-2xl">{{$term->name}}</span>
                        </a>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</section>