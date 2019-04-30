<div class="c-slide__audio">
    <button class="c-slide__audio-toggle o-button o-button--round o-button--theme-primary js-toggle-play">
        @include('partials.icon', ['icon' => 'music'])
    </button>
    <audio preload="metadata" loop>
        <source src="/{{str_replace("site:", "", $slide['content']->audio) }}" type="audio/mpeg">
    </audio>
</div>