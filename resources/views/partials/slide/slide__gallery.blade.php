@if(count($slide['content']->gallery) > 0)
    <div class="c-slide__gallery c-slide__gallery--{{$slide['content']->imageposition}}">
        <div class="c-gallery c-gallery--{{$slide['content']->imageposition}}">
            @foreach($slide['content']->gallery as $key => $galleryItem)
                <?php
                    $item = (object)$galleryItem;
                    //$url = str_replace("site:", "", $item->path);
                    $url = thumbnail_url($item->path, null, null, ["attrs" => ['alt' => $item->title]]);
                ?>
                @if($key == 0)
                    <a class="c-gallery__item c-slide__visual c-slide__visual--{{$slide['content']->imageposition}}" href="<?php echo $url; ?>" data-download-url="false">
                        <?php thumbnail($item->path, 400, 400, ["mode" => 'best_fit',"attrs" => ['alt' => $item->title]]); ?>
                        @if(count($slide['content']->gallery) == 1)
                            <span class="c-gallery__magnify">
                                @include('partials.icon', ['icon' => 'magnify'])
                            </span>
                        @endif
                    </a>
                @else
                    <a class="c-gallery__item" href="<?php echo $url; ?>" data-download-url="false">
                        <?php thumbnail($item->path, 130, 130, ["mode" => 'best_fit',"attrs" => ['alt' => $item->title]]); ?>
                        @if($key == count($slide['content']->gallery) - 1)
                            <span class="c-gallery__magnify">
                                @include('partials.icon', ['icon' => 'magnify'])
                            </span>
                        @endif
                    </a>
                @endif
            @endforeach
        </div>
    </div>
@endif