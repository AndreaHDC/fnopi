@php
// Support custom "anchor" values.
$anchor = '';
if ( ! empty( $block['anchor'] ) ) {
    $anchor = 'id="' . esc_attr( $block['anchor'] ) . '" ';
}
// $title = get_field('title');
// $stories = get_field('stories');
$categories = get_field('categories');
$term_tax = isset($_GET['term']) ? $_GET['term']:false;
@endphp

<section {{$anchor}} class="my-[50px] lg:my-[100px] animate-opacity">
    <div class="mb-12 ">
        <p class="text-center">Esplora per:</p>
        @if (count($categories))
                <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-3 md:gap-6 mt-3" id="categories-container">
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
                             if ($loop->index == 3) {
                                $color = ' bg-fnopi-light-green';
                             }
                        @endphp
                        <button type="button" data-term="{{$term->slug}}" class="{{$color}} {{$term_tax == $term->slug ? 'active':''}} fnopi-category-button">
                            <span class="text-center text-sm uppercase font-light">{{$term->name}}</span>
                        </button>
                    @endforeach
                </div>
        @endif
    </div>
    <div  class="alignfull py-12 lg:py-[100px] bg-fnopi-black">
        <div class="alignwide mx-auto px-6 lg:px-[60px] 2xl:px-[120px]">
            <div id="fnopi-loader-container" class="flex justify-center">
                <span class="fnopi-loader"></span>
            </div>
            <div id="fnopi-stories-archive" class="grid md:grid-cols-3 lg:grid-cols-4 gap-10"></div>
            <div class="justify-center text-white mt-16 hidden">
                <div id="fnopi-pagination"></div>
            </div>
        </div>
    </div>
</section>