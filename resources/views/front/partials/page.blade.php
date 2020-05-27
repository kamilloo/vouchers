@extends('layouts.front')

@section('extra-head')

    <meta property="og:url"                content="{{ route('welcome') }}" />
    <meta property="og:type"               content="website" />
    <meta property="og:title"              content="MyVouchers" />
    <meta property="og:description"        content="Sprzedajemy bony upominkowe" />
    <meta property="og:image"              content="{{ asset('welcome/img/body-bg.jpg') }}" />
@endsection

@section('content')

    <div class="main-wrapper-first">
        @include('front.partials.header')
        @include('front.partials.banner-area')
        @yield('content-page')
    </div>
    @include('front.partials.footer')
@endsection
