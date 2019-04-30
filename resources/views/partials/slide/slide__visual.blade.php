@if(!empty($slide['content']->image))
    <div class="c-slide__visual c-slide__visual--{{$slide['content']->imageposition}}">
        @if(strpos($slide['content']->image,'.svg') !== false)
            <img src="/{{ str_replace("site:", "", $slide['content']->image) }}" alt="{{$slide['content']->title}}" />
        @else
            <?php thumbnail($slide['content']->image, 400, 400, ["mode" => 'best_fit']); ?>
        @endif
    </div>
@endif