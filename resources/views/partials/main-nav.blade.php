<nav class="c-main-nav is-loading">
    <ul class="c-main-nav__menu">
        @foreach ($grids as $key => $value)
            <li class="c-main-nav__item {{$value['isMainGrid'] ? 'c-main-nav__item--primary' : 'c-main-nav__item--secondary'}} {{$value['isActive'] ? 'is-active' : ''}}">
                @if (!$value['isActive'])
                    <a href="{{$root}}{{$value['slug']}}" class="c-main-nav__link">{{$value['name']}}</a>
                @else
                    <span class="c-main-nav__link">{{$value['name']}}</span>
                @endif
            </li>
        @endforeach
    </ul>
</nav>