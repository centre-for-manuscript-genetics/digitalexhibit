<footer class="l-footer is-loading">
    <div class="c-footer {{$isMainGrid ? 't-theme--1' : 't-theme--2'}}">
        <div class="c-footer__legal">
            <span>
                © 2016 - UA afdeling Letterkunde -
                @php($rootUrl = Request::root())
                <a class="c-footer__link" href="{{$rootUrl}}{{$root}}/general/about">About</a> - <a class="c-footer__link" href="{{$rootUrl}}{{$root}}/general/disclaimer">Disclaimer</a>
            </span>
        </div>
        <div class="c-footer__sponsors">
            @include('partials.footer.sponsor', array(
                'url' => 'https://www.uantwerpen.be/',
                'title' => 'University of Antwerp',
                'img' => '/images/svg/ua.svg',
                'alt' => 'University of Antwerp'
            ))
            @include('partials.footer.sponsor', array(
                'url' => 'https://www.uantwerpen.be/en/rg/centre-for-manuscript-genetics/',
                'title' => 'Centre for Manuscript Genetics',
                'img' => '/images/svg/cmg.svg',
                'alt' => 'Centre for Manuscript Genetics'
            ))
            @include('partials.footer.sponsor', array(
                'url' => 'http://www.letterenhuis.be/',
                'title' => 'Letterenhuis',
                'img' => '/images/svg/letterenhuis.svg',
                'alt' => 'Letterenhuis'
            ))
            @include('partials.footer.sponsor', array(
                'url' => 'http://dixit.uni-koeln.de/',
                'title' => 'DiXiT',
                'img' => '/images/svg/dixit.svg',
                'alt' => 'DiXiT'
            ))
            @include('partials.footer.sponsor', array(
                'url' => 'http://ec.europa.eu/research/mariecurieact',
                'title' => 'Marie Curie Actions',
                'img' => '/images/svg/marie-curie.svg',
                'alt' => 'Marie Curie Actions'
            ))
        </div>
            <div class="c-footer__navigation">
                @if(!$isMainGrid)
                    <div class="c-footer__back-to-home">
                        <a class="c-footer__back-to-home-link c-footer__link" href="<?php echo Request::root() ?>{{$root}}/{{$mainGridNav['mainGrid']->name_slug}}">
                            @include('partials.icon', ['icon' => 'arrow--left'])
                            {{$mainGridNav['mainGrid']->name}}
                        </a>
                    </div>
                @endif
                @if($grid != null)
                    <h4 class="c-footer__navigation-title">{{$grid->name}}</h4>
                    <nav class="c-navigation c-navigation--footer">
                        @foreach($slides as $key => $slide)
                            <button class="c-navigation__button" data-slide="{{$slide['content']->title_slug}}">{{ $key + 1 }}</button>
                        @endforeach
                        <button class="c-navigation__button c-navigation__button--isolated" data-slide="overview">
                            @include('partials.icon', ['icon' => 'home'])
                        </button>
                    </nav>
                @endif
            </div>
    </div>
</footer>

@if(!$isLimited)
    <!-- Go to www.addthis.com/dashboard to customize your tools -->
    <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-57e92f97cb185679"></script>
@endif