@extends('masters.default')

@section('main')
    <div class="o-loading-animation is-loading">
        <img
            src="/images/svg/loading-text.svg"
            width="528"
            height="201"
            alt=""
            style="
                display: block;
                margin: auto;
                margin-bottom: 20px;"
        />
        <div class="u-hidden-from u-hidden-from--md">
            <p>
                Deze website is niet geoptimaliseerd voor gebruik met kleine devices.
            </p>
            <p>
                Voor het beste resultaat kan je best een groter device gebruiken.
            </p>
        </div>
        <div class="u-hidden-to--md">
            <img
                class="o-loading-animation__pulser"
                src="/images/loading.png"
                style="
                    display: block;
                    margin: auto;
                    margin-bottom: 20px;"
            />
            <p>even wachten...</p>
        </div>
    </div>
    @include('partials.main-nav', ['grids' => $grids])
    <section class="c-grid {{$isMainGrid ? 't-theme--1' : 't-theme--2'}} is-loading">
        <div class="c-grid__slides" id="impress">
            @foreach($slides as $slide)
                @include('partials.slide.slide', array('slide' => $slide, 'isLimited' => $isLimited))
            @endforeach
            <div id="overview" class="step" data-x="100" data-y="150" data-scale="1.4"></div>
        </div>
        <button class="is-loading c-grid__nav c-grid__nav--left o-button o-button--theme-primary-inverted o-button--round-large js-grid--prev">
            @include('partials.icon', ['icon' => 'arrow--left'])
        </button>
        <button class="is-loading c-grid__nav c-grid__nav--right o-button o-button--theme-primary-inverted o-button--round-large js-grid--next">
            @include('partials.icon', ['icon' => 'arrow--right'])
        </button>
    </section>
    @include('partials.footer.footer', ['grid' => $grid, 'slides' => $slides, 'isMainGrid' => $isMainGrid, 'isLimited' => $isLimited])

    <div class="db-transparant">
        <!--<pre>
            <?php var_dump($grid) ?>
        </pre>-->
        <!--<pre>
            <?php var_dump($slides) ?>
        </pre>-->
    </div>
@stop