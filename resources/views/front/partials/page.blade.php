@extends('layouts.front')

@section('content')

    <div class="main-wrapper-first">
        @include('front.partials.header')
        @include('front.partials.banner-area')
        @yield('content-page')
    </div>
    @include('front.partials.footer')
@endsection
