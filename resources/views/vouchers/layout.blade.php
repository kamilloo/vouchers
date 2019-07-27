@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="container emp-profile">
            <div class="col-md-12">
                @yield('list')
                @yield('form')
            </div>
        </div>
    </div>
@endsection
