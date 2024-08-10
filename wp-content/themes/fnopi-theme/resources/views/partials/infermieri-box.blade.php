<div class="infermieri-box">
    <div class="image aspect-video overflow-hidden rounded-xl">
        <a href="{{get_the_permalink($story_id)}}">
        {!! wp_get_attachment_image(get_post_thumbnail_id($story_id), 'full', false, ['class' => 'w-full h-full object-cover', 'alt' => get_the_title($story_id)]) !!}
        </a>
    </div>
    <h3 class="text-fnopi-green uppercase font-bold my-3 font-fnopi-body text-base">{!!get_the_title($story_id)!!}</h3>
    <p class="text-white">{!!get_the_excerpt($story_id)!!}</p>
    <a class="text-white font-bold mt-3 inline-block underline hover:no-underline" href="{{get_the_permalink($story_id)}}">Leggi Tutto</a>
</div>