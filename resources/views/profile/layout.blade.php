@extends('layouts.app')

@section('content')
    <form method="post" enctype="multipart/form-data" action="{{ route('profile.update') }}">
        @csrf
    <div class="container emp-profile">

        <div class="row pb-5">
            <div class="col-md-4">
                @yield('logo')
            </div>
            <div class="col-md-5">
                <div class="profile-head">
                    <h5>
                        {{ $guard->user()->profile->first_name }} {{ $guard->user()->profile->last_name }}
                    </h5>
                    <h6>
                        {{ $guard->user()->profile->company_name }}
                    </h6>
                    <h5 class="proile-rating">{{ __('Homepage') }}:
                        @if(!empty($guard->user()->profile->homepage))
                            &nbsp;<a href="{{ $guard->user()->profile->homepage }}" target="_blank"><span>{{ $guard->user()->profile->homepage }}</span></a>
                        @else
                        &nbsp;<a href="#"><span><i class="fa fa-close"></i></span></a>
                        @endif
                    </h5>
                    <h5 class="proile-rating">{{ __('Social Media') }}:
                    <div class="footer-social d-inline">
                        @if(!empty($guard->user()->profile->social_media) && count($guard->user()->profile->social_media))
                        @foreach($guard->user()->profile->social_media as $social_media)
                            <a href="{{ $social_media['page'] }}" target="_blank"><i class="fa fa-{{ $social_media['type'] }}"></i></a>
                        @endforeach
                    @else
                        <a href="#"><i class="fa fa-close"></i></a>
                    @endif
                    </div>
                    </h5>

                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">{{ __('About Me') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">{{ __('Description') }}</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-md-3">
                @yield('form.button')
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                @yield('branches.and.skills')
            </div>
            <div class="col-md-8">
                <div class="tab-content profile-tab" id="myTabContent">
                    @yield('about')
                </div>
            </div>
        </div>
    </div>
    </form>
@endsection
