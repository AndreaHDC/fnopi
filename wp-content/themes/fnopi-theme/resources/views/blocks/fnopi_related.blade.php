@php
// Support custom "anchor" values.
$anchor = '';
if ( ! empty( $block['anchor'] ) ) {
    $anchor = 'id="' . esc_attr( $block['anchor'] ) . '" ';
}
$title = get_field('title');
$related = get_field('related');
@endphp
<section {{$anchor}}>
    @if (count($related))
        <div id="fnopi-related" class="pb-[50px] lg:pb-[100px] mx-auto max-w-screen-xl">
            <h3 class="italic text-4xl mb-6">{!!$title!!}</h3>
            @foreach ($related as $id)
            
            <div class="flex items-center gap-6 mb-3 pb-3 border-b border-solid border-fnopi-black">
                @if ($image = get_field('image',$id))
                    <a href="{{get_the_permalink($id)}}">
                        <div class="max-w-[100px] md:max-w-[200px] w-full overflow-hidden ">
                            {!! wp_get_attachment_image($image, 'square', false, ['class' => 'w-full h-auto transition-transform hover:scale-110 duration-500']) !!}
                        </div>
                    </a>
                @endif
                @php
                    $year = false;
                    $date = get_field('date',$id);
                    if($date){
                        $dateParts = explode('/', $date);
                        $year = $dateParts[2];
                    }
                   
                @endphp
                <div>
                    <p class="font-bold">{{$year}}</p>
                    <h6 class="font-bold uppercase">{!!get_the_title($id)!!}</h6>
                </div>
                
            </div>
            

               
            @endforeach
        </div>
    @endif
</section>