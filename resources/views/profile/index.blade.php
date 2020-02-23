@extends('profile.layout')

@section('form.button')
    <div class="profile-edit-btn" onmouseover="editButtonFocusIn(this)" onmouseout="editButtonFocusOut(this)">
        <a href="{{ route('profile.edit') }}" >{{ __('Edit Profile') }}</a>
    </div>
@endsection

@section('logo')
    <div class="profile-img">
        <img src="{{ \Storage::url($guard->user()->profile->logo) }}" alt=""/>
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
                <label>{{ __('Phone') }}</label>
            </div>
            <div class="col-md-6">
                <p>{{ $guard->user()->profile->phone }}</p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <label>{{ __('Services') }}</label>
            </div>
            <div class="col-md-6">
                <p>{{ $guard->user()->profile->services }}</p>
            </div>
        </div>
    </div>
    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
        <div class="row">
            <div class="col-md-6">
                <label>{{ __('Branża') }}</label>
            </div>
            <div class="col-md-6">
                <p>{{ $guard->user()->profile->branch }}</p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <label>{{ __('Description') }}</label><br/>
                <p>{{ $guard->user()->profile->description }}</p>
            </div>
        </div>
    </div>


@endsection

@section('branches.and.skills')
    @include('profile.partials.profile_work')
@endsection
