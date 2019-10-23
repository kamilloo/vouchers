@extends('layouts.app')

@section('content')
    <form method="post" enctype="multipart/form-data" action="{{ route('profile.update') }}">
        @csrf
    <div class="container emp-profile">

        <div class="row">
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
                    <p class="proile-rating">RANKINGS : <span>{{ $guard->user()->profile->ranking }}/10</span></p>
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">About</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Description</a>
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
                @include('profile.partials.profile_work')
            </div>
            <div class="col-md-8">
                <div class="tab-content profile-tab" id="myTabContent">
                    @yield('about')
                    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                        <div class="row">
                            <div class="col-md-6">
                                <label>Branża</label>
                            </div>
                            <div class="col-md-6">
                                <p>{{ $guard->user()->profile->branch }}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <label>Description</label><br/>
                                <p>{{ $guard->user()->profile->description }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </form>
@endsection
