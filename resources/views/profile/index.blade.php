@extends('profile.layout')

@section('form.button')
    <div class="profile-edit-btn" onmouseover="editButtonFocusIn(this)" onmouseout="editButtonFocusOut(this)">
        <a href="{{ route('profile.edit') }}" >{{ __('Edit Profile') }}</a>
    </div>
@endsection

@section('logo')
    <div class="profile-img">
        <img class="img-fluid" src="@if($guard->user()->profile->avatar){{ asset($guard->user()->profile->avatar) }}@else{{ asset('images/placeholder_512_x_512.png') }}@endif" alt=""/>
    </div>
@endsection

@section('about')
    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
        <div class="row">
            <div class="col-md-6">
                <label>{{ __('Address') }}</label>
            </div>
            <div class="col-md-6">
                <p>{{ $guard->user()->profile->address }}</p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <label>{{ __('Postcode') }}</label>
            </div>
            <div class="col-md-6">
                <p>{{ $guard->user()->profile->postcode }}</p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <label>{{ __('City') }}</label>
            </div>
            <div class="col-md-6">
                <p>{{ $guard->user()->profile->city }}</p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <label>{{ __('Phone') }}</label>
            </div>
            <div class="col-md-6">
                <p>{{ $guard->user()->profile->phone }}</p>
            </div>
        </div>
    </div>
    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
        <div class="row">
            <div class="col-md-12">
                <p>{!! nl2br($guard->user()->profile->description) !!}</p>
            </div>
        </div>
    </div>


@endsection

@section('branches.and.skills')
    @include('profile.partials.profile_work')
@endsection
