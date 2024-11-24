@php
// Support custom "anchor" values.
$anchor = '';
if ( ! empty( $block['anchor'] ) ) {
    $anchor = 'id="' . esc_attr( $block['anchor'] ) . '" ';
}
@endphp

<section {{$anchor}}>
    <div id="fnopi-press-archive" class="my-12 flex flex-col gap-12">
        @if($press && count($press) > 0)
            @foreach($press as $item)   
                <div class="press-item flex flex-col md:flex-row gap-6 md:gap-12">
                    
                    
                    <div class="press-item-image aspect-video md:aspect-[396/497] relative w-full md:max-w-[396px]">
                        {!! get_the_post_thumbnail($item['id'], 'full', ['class' => 'absolute inset-0 object-cover w-full h-full']) !!}
                    </div>

                    <div class="press-item-content flex-grow flex flex-col gap-8 justify-between">   
                        <div>
                            <ul class="press-item-terms flex gap-4 mb-6">
                                @foreach($item['terms'] as $term)
                                    <li class="inline-block px-4 py-2 uppercase text-xs border border-fnopi-dark-blue rounded-full">    
                                        <span>{{$term->name}}</span>
                                    </li>
                                @endforeach
                            </ul>
                            <h3 class="mb-3 text-fnopi-dark-green">{{$item['title']}}</h3>
                            <p class="max-w-prose">{!! nl2br($item['excerpt']) !!}</p>
                        </div>

                        <div class="flex gap-6 flex-col">
                            @if($item['pdf_link'])
                                <div class="border-b border-fnopi-green pb-4 font-bold transition-colors duration-300 hover:text-fnopi-green">
                                    <a target="_blank" href="{{$item['pdf_link']}}" class="flex items-center gap-4">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="37.882" height="46" viewBox="0 0 37.882 46"><path d="M45.382,20.735H34.559V4.5H18.324V20.735H7.5L26.441,39.676ZM7.5,45.088V50.5H45.382V45.088Z" transform="translate(-7.5 -4.5)" fill="#a5be3a"/></svg>
                                        <span>Scarica PDF</span>
                                    </a>
                                </div>
                            @endif
                            @if($item['images_link'])
                                <div class="border-b border-fnopi-green pb-4 font-bold transition-colors duration-300 hover:text-fnopi-green">
                                    <a target="_blank" href="{{$item['images_link']}}" class="flex items-center gap-4">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="37.882" height="46" viewBox="0 0 37.882 46"><path d="M45.382,20.735H34.559V4.5H18.324V20.735H7.5L26.441,39.676ZM7.5,45.088V50.5H45.382V45.088Z" transform="translate(-7.5 -4.5)" fill="#a5be3a"/></svg>
                                        <span>Scarica immagini</span>
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
    </div>
</section>