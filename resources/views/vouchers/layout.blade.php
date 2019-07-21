@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center pb-md-5  pb-1">
            <div class="col-md-8">
                @yield('list')
                @yield('form')
            </div>
        </div>
    </div>
@endsection
