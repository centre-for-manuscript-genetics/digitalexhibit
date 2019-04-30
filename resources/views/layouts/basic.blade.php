@extends('masters.default')

@yield('main')
    <section class="l-basic-content">
        <h1>{{$data->title}}</h1>

        <div>
            {!! $data->content !!}
        </div>
        <div class="t-theme--1 u-text--center u-separated">
            @php($rootUrl = Request::root())
            <a href="{{$rootUrl}}{{$root}}/{{$mainGridNav['mainGrid']->name_slug}}" class="o-button o-button--theme-primary o-button--inline-block">Terug</a>
        </div>
    </section>

    @include('partials.footer.footer', ['grid' => null, 'slides' => [], 'isMainGrid' => false, 'isLimited' => $isLimited])
@show

