<div class="c-slide__body">
    <div class="c-slide__heading">
        <h2>{{$slide['content']->title}}</h2>
        @if(!empty($slide['content']->subtitle))
            <h3>{{$slide['content']->subtitle}}</h3>
        @endif
    </div>
    <div class="c-slide__body-content c-slide__body-content--video">
        @if(!empty($slide['content']->video))
            <iframe width="560" height="315" src="{{$slide['content']->video}}" frameborder="0" allowfullscreen></iframe>
        @endif
    </div>
</div>