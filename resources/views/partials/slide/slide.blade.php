<div id="{{$slide['content']->title_slug}}" class="l-slide step db-slide"
    data-x="{{$slide['impress']->offset_x}}"
    data-y="{{$slide['impress']->offset_y}}"
    data-rotate="{{$slide['impress']->rotation}}"
    data-scale="{{$slide['impress']->scale}}"
    >
    <article class="c-slide js-gallery">
        @if($slide['content']->type != 'video' && $slide['content']->imageposition == 'top')
            <div class="c-slide__container c-slide__container--column">
                @include('partials.slide.slide__visual', array('slide' => $slide))
                @include('partials.slide.slide__body', array('slide' => $slide))
            </div>
        @else
            <div class="c-slide__container {{$slide['content']->imageposition == 'top' ? 'c-slide__container--column' : ''}}">
                @include('partials.slide.slide__body', array('slide' => $slide))
            </div>
        @endif
        @include('partials.slide.slide__gallery', array('slide' => $slide))
    </article>
</div>


