<div class="c-slide__action-container">
    @if(isset($slide['content']->subgrid))
        <a href="<?php echo Request::root() ?>{{$root}}{{$slide['content']->subgrid}}" class="c-slide__action o-button o-button--theme-primary o-button--inline-block">{{$slide['content']->button}}</a>
    @else
        <button class="c-slide__action o-button o-button--theme-primary o-button--block js-grid--next">{{$slide['content']->button}}</button>
    @endif
</div>