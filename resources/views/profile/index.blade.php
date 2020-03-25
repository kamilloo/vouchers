@extends('profile.layout')

@section('form.button')
    <div class="profile-edit-btn" onmouseover="editButtonFocusIn(this)" onmouseout="editButtonFocusOut(this)">
        <a href="{{ route('profile.edit') }}" >{{ __('Edit Profile') }}</a>
    </div>
@endsection

@section('logo')
    <div class="profile-img">
        <img class="img-fluid rounded-circle" src="{{ $guard->user()->profile->presenter->avatar() }}" alt=""/>
    </div>
@endsection

@section('about')
    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
        <div class="row">
            <div class="col-md-4">
                <label>{{ __('Address') }}</label>
            </div>
            <div class="col-md-8">
                <p>{{ $guard->user()->profile->address }}</p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <label>{{ __('Postcode') }}</label>
            </div>
            <div class="col-md-8">
                <p>{{ $guard->user()->profile->postcode }}</p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <label>{{ __('City') }}</label>
            </div>
            <div class="col-md-8">
                <p>{{ $guard->user()->profile->city }}</p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <label>{{ __('Phone') }}</label>
            </div>
            <div class="col-md-8">
                <p>{{ $guard->user()->profile->phone }}</p>
            </div>
        </div>
    </div>
    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
        <div class="row">
            <div class="col-md-4">
                <label>{{ __('Description') }}</label>
            </div>
            <div class="col-md-8">
                <p>{!! $guard->user()->profile->presenter->description() !!}</p>
            </div>
        </div>
    </div>


@endsection

@section('branches.and.skills')
    @include('profile.partials.profile_work')
@endsection
