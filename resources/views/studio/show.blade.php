@extends('layouts.front')

@section('extra-head')

    <meta property="og:url"                content="" />
    <meta property="og:type"               content="" />
    <meta property="og:title"              content="" />
    <meta property="og:description"        content="" />
    <meta property="og:image"              content="" />
    <meta name="twitter:image" content="">
    <meta name="twitter:title" content="">
    <meta name="twitter:description" content="">
    <meta name="twitter:card" content="summary">

    <link href="{{ mix('studio.css') }}" rel="stylesheet">

    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link rel="stylesheet" href="//fonts.googleapis.com/css?family=Karla|Merriweather:400,700">

    <script src="https://cdn.jsdelivr.net/gh/highlightjs/cdn-release@9.18.1/build/highlight.min.js"></script>
    <script src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/highlightjs/cdn-release@9.18.1/build/styles/github.min.css">
@endsection()


@section('content')
    <vue-headful
        :title="post.title + ' — MyVouchers'"
        :description="post.summary"
        :image="post.featured_image"
        :url="meta.canonical_link"
    />

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

