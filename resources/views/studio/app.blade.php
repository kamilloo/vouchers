@extends('layouts.front')

@section('extra-head')

    <link href="{{ mix('studio.css') }}" rel="stylesheet">

    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link rel="stylesheet" href="//fonts.googleapis.com/css?family=Karla|Merriweather:400,700">

    <script src="https://cdn.jsdelivr.net/gh/highlightjs/cdn-release@9.18.1/build/highlight.min.js"></script>
    <script src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/highlightjs/cdn-release@9.18.1/build/styles/github.min.css">
@endsection()


@section('content')

    <div class="main-wrapper-first">
        @include('front.partials.header')
        <section class="service-area">
            <div class="container">
                @yield('content-page')

                <div id="studio">
                    <router-view></router-view>
                </div>
            </div>
        </section>



        <script>
            window.Studio = @json($scripts);
        </script>

        <script src="{{ asset('studio.js') }}" defer></script>

    </div>
    @include('front.partials.footer')
@endsection

