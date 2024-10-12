<div class="post-card">
   

        <div style="margin-bottom:0;" class="has-text-align-center wp-block-post-date">
            <time datetime="{{ get_the_date('c') }}">{{ get_the_date() }}</time>
        </div>

        <a href="{{get_the_permalink()}}">
        <figure class="mb-6">
            {!! get_the_post_thumbnail(null, 'news-thumb', ['class' => 'w-full h-auto']) !!}
        </figure>
        </a>

        <h3 class="has-text-align-center has-link-color wp-block-post-title has-text-color has-fnopi-green-color">
            <a href="{{ get_permalink() }}" target="_self">{{ get_the_title() }}</a>
        </h3>

        <div class="has-text-align-center wp-block-post-excerpt">
            <p class="wp-block-post-excerpt__excerpt">{{ get_the_excerpt() }}</p>
        </div>


   
</div>