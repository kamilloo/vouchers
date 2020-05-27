@extends('layouts.front')

@section('extra-head')

    <meta property="og:url"                content="{{ route('welcome') }}" />
    <meta property="og:type"               content="website" />
    <meta property="og:title"              content="MyVouchers" />
    <meta property="og:description"        content="Sprzedajemy bony upominkowe" />
    <meta property="og:image"              content="{{ asset('welcome/img/body-bg.jpg') }}" />
@endsection

@section('content')
    @include('front.partials.welcome.first-wrapper')
    @include('front.partials.welcome.second-wrapper')
    @include('front.partials.welcome.third-wrapper')
@endsection
