{{-- Retrieve and display ACF block fields --}}
@php
if(isset($term) && $term !== 'all'){
    $post_id = $story_id; // Replace with your actual post ID
    $blocks = parse_blocks(get_post_field('post_content', $post_id));
    $cuts_array = [];
    foreach ($blocks as $block) {

    // Check if the block has inner blocks
    if (isset($block['innerBlocks']) && !empty($block['innerBlocks'])) {
        foreach ($block['innerBlocks'] as $innerBlock) {
            if($innerBlock['blockName'] === 'fnopi/storyvideo'){
                $array = $innerBlock['attrs']['data'];
                $cuts_count = $array['cuts'];
                

                // Loop through each cut
                for ($i = 0; $i < $cuts_count; $i++) {
                    $title_key = "cuts_{$i}_title";
                    $video_id_key = "cuts_{$i}_video_id";
                    $image_key = "cuts_{$i}_image";

                    $start_time_key = "cuts_{$i}_start";
                    $end_time_key = "cuts_{$i}_end";
                    $description_key = "cuts_{$i}_description";
                   

                    // Check if the keys exist in the array to avoid errors
                    if (isset($array[$title_key], $array[$video_id_key], $array[$image_key])) {
                        $title = $array[$title_key];
                        $slug = '';
                        switch($title){
                            // "title": "Perch\u00e8 ho scelto di fare l\u2019infermiere",
                            case 'Perchè ho scelto di fare l’infermiere':
                                $slug = 'la-scelta-di-essere-infermiere';
                                break;
                            case 'Il mio primo giorno di lavoro':
                                $slug = 'il-primo-giorno-di-lavoro';
                                break; 
                            case 'La formazione':
                                $slug = 'la-formazione';
                                break; 

                            case 'Il mio consiglio alle nuove generazioni':
                                $slug = 'i-consigli-alle-nuove-generazioni';
                                break; 
                                

                            default:
                                break;
                        }
                        
                        $video_id = $array[$video_id_key];
                        $image = $array[$image_key];
                        $start_time = $array[$start_time_key];
                        $end_time = $array[$end_time_key];
                        $description = isset($array[$description_key]) ? $array[$description_key] : '';
                        // Get the term of stories-tax by name using $title
                        // $term = get_term_by('name', $title, 'stories-tax');
                        
                        $cuts_array[] = [
                            'slug' => $slug,
                            'video_id' => $video_id,
                            'image' => $image,
                            'start' => $start_time,
                            'end' => $end_time,
                            'description' => $description,
                        ];
                    }
                }
            }
        }
    }
}



$filtered_cuts_array = array_filter($cuts_array, function($cut) use ($term) {
    return $cut['slug'] === $term;
});
$filtered_cuts_array = array_values($filtered_cuts_array);
}

@endphp

@if (isset($term) && $term !== 'all')
    @if (isset($filtered_cuts_array) && count($filtered_cuts_array) > 0)
    <div class="infermieri-box">
        <a class="fslightbox-trigger fslightbox-trigger-cuts" data-videocut="{{$filtered_cuts_array[0]['video_id']}}" data-start="{{$filtered_cuts_array[0]['start']}}" data-end="{{$filtered_cuts_array[0]['end']}}" data-fslightbox="virtual-{{$story_id}}" href="#virtual-{{$story_id}}">
            <div class="image aspect-video overflow-hidden rounded-xl relative">
                {!! wp_get_attachment_image($filtered_cuts_array[0]['image'], 'full', false, ['class' => 'w-full h-full object-cover', 'alt' => get_the_title($story_id)]) !!}
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
        <h3 class="text-fnopi-green uppercase font-bold my-3 font-fnopi-body text-base">{!!get_the_title($story_id)!!}</h3>
        <div class="hidden">
            <iframe
                class="story-cut-video"
                src="https://player.vimeo.com/video/{{$filtered_cuts_array[0]['video_id']}}#t={{$filtered_cuts_array[0]['start']}}s"
                id="virtual-{{$story_id}}"
                width="1920px"
                height="1080px"
                frameBorder="0"
                allow="autoplay; fullscreen"
                allowFullScreen
            ></iframe>
        </div>
        @if ($filtered_cuts_array[0]['description'])
        <p class="text-white">{!! nl2br($filtered_cuts_array[0]['description']) !!}</p>
        @else
        <p class="text-white">{!!get_the_excerpt($story_id)!!}</p>
        @endif
       
        <a class="text-white font-bold mt-3 inline-block underline hover:no-underline" href="{{get_the_permalink($story_id)}}">Leggi Tutto</a>
    </div>

    @endif
    

@else
@php
    $video = get_field('video',$story_id);
@endphp
<div class="infermieri-box">
    
    <div class="image aspect-video overflow-hidden rounded-xl">


        <a data-fslightbox="virtual-{{$video}}" href="#virtual-{{$video}}">
            <div class="image aspect-video overflow-hidden rounded-xl relative">
                {!! wp_get_attachment_image(get_post_thumbnail_id($story_id), 'full', false, ['class' => 'w-full h-full object-cover', 'alt' => get_the_title($story_id)]) !!}
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

        
        
{{--         
        <a href="{{get_the_permalink($story_id)}}">
         {!! wp_get_attachment_image(get_post_thumbnail_id($story_id), 'full', false, ['class' => 'w-full h-full object-cover', 'alt' => get_the_title($story_id)]) !!}
        </a> --}}



    </div>
    <h3 class="text-fnopi-green uppercase font-bold my-3 font-fnopi-body text-base">{!!get_the_title($story_id)!!}</h3>
    <p class="text-white">{!!get_the_excerpt($story_id)!!}</p>
    <a class="text-white font-bold mt-3 inline-block underline hover:no-underline" href="{{get_the_permalink($story_id)}}">Leggi Tutto</a>
    <div class="text-white">
        @if(isset($filtered_cuts_array))
        <pre>{{ json_encode($filtered_cuts_array, JSON_PRETTY_PRINT) }}</pre>
        @endif
    </div>
</div>

@endif