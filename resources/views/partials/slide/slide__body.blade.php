<div class="c-slide__body-container">
    @if($slide['content']->type == 'video')
        @include('partials.slide.slide__body--video', array('slide' => $slide))
    @else
        @include('partials.slide.slide__body--basic', array('slide' => $slide))
    @endif
</div>