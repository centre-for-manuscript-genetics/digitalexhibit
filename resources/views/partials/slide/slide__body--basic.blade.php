<div class="c-slide__body
    @if($slide['content']->imageposition != 'top')
        c-slide__body--{{$slide['content']->imageposition == 'left' ? 'right' : 'left'}}
    @endif
">
    <div class="c-slide__heading {{ ($slide['content']->imageposition == 'top' ? "u-sr-only" : "") }}">
        <h2>{{$slide['content']->title}}</h2>
        @if(!empty($slide['content']->subtitle))
            <h3>{{$slide['content']->subtitle}}</h3>
        @endif
    </div>
    <div class="c-slide__body-content">
        @if(!empty($slide['content']->text))
            {!!$slide['content']->text!!}
        @endif

        @if(!empty($slide['content']->type == 'action'))
            @include('partials.slide.slide__action', array('slide' => $slide))
        @endif
    </div>
    @if(isset($slide['content']->audio) && strlen($slide['content']->audio) > 0)
        @include('partials.slide.slide__audio', array('slide' => $slide))
    @endif
</div>