@extends('profile.layout')


@section('logo')
    <file-upload  file-preview-width="200" file-name="logo" file-src="/storage/logos/7wP5bh7oA2tAANeIztCMvhUtjJQwSPe9J3YAXQTl.jpeg"></file-upload>
@endsection

@section('form.button')
    <input type="submit" class="profile-edit-btn" name="btnAddMore" value="Save"/>
@endsection

@section('about')
    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
        <div class="row input-group mb-3">
            <div class="col-md-4">
                <label>Last Name</label>
            </div>
            <div class="col-md-8">
                <input type="text" class="form-control" placeholder="Last Name" name="last_name" value="{{ $guard->user()->profile->last_name }}">
            </div>
        </div>
        <div class="row input-group mb-3">
            <div class="col-md-4">
                <label>First Name</label>
            </div>
            <div class="col-md-8">
                <input type="text" class="form-control" placeholder="First Name" name="first_name" value="{{ $guard->user()->profile->first_name }}">
            </div>
        </div>
        <div class="row input-group mb-3">
            <div class="col-md-4">
                <label for="company_name">Company Name</label>
            </div>
            <div class="col-md-8">
                <input type="text" class="form-control" placeholder="Company Name" id="company_name" name="company_name" value="{{ $guard->user()->profile->company_name }}">
            </div>
        </div>
        <div class="row input-group mb-3">
            <div class="col-md-4">
                <label for="phone">Phone</label>
            </div>
            <div class="col-md-8">
                <input type="text" class="form-control" placeholder="Phone" id="phone" name="phone" value="{{ $guard->user()->profile->phone }}">
            </div>
        </div>
        <div class="row input-group mb-3">
            <div class="col-md-4">
                <label for="address">__('Address')</label>
            </div>
            <div class="col-md-8">
                <input type="text" id="address" class="form-control" placeholder="__('Address')" name="address" value=" {{ $guard->user()->profile->address }}">
            </div>
        </div>
        <div class="row input-group mb-3">
            <div class="col-md-4">
                <label for="postcode">__('Postcode')</label>
            </div>
            <div class="col-md-8">
                <input type="text" id="postcode" class="form-control" placeholder="__('Postcode')" name="postcode" value=" {{ $guard->user()->profile->postcode }}">
            </div>
        </div>
        <div class="row input-group mb-3">
            <div class="col-md-4">
                <label for="city">__('City')</label>
            </div>
            <div class="col-md-8">
                <input type="text" id="city" class="form-control" placeholder="__('City')" name="city" value=" {{ $guard->user()->profile->city }}">
            </div>
        </div>
    </div>
    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
        <div class="row input-group mb-3">
            <div class="col-md-4">
                <label for="description">__('Description')</label>
            </div>
            <div class="col-md-8">
                <input type="text" id="description" class="form-control" placeholder="__('Description')" name="description" value=" {{ $guard->user()->profile->description }}">
            </div>
        </div>
        <div class="row input-group mb-3">
            <div class="col-md-4">
                <label for="homepage">__('Home Page')</label>
            </div>
            <div class="col-md-8">
                <input type="text" id="homepage" class="form-control" placeholder="__('Home Page')" name="homepage" value=" {{ $guard->user()->profile->homepage }}">
            </div>
        </div>
        <div class="row input-group mb-3">
            <div class="col-md-4">
                <label for="social_media">__('Socia Media')</label>
            </div>
            <div class="col-md-8">
                <input type="text" id="social_media" class="form-control" placeholder="__('Socia Media')" name="social_media" value=" {{ $guard->user()->profile->social_media }}">
            </div>
        </div>
    </div>

@endsection

@section('branches.and.skills')
    @include('profile.partials.profile_work_edit')
@endsection
<script>
    import Avatar from "../../js/components/Avatar";
    export default {
        components: {Avatar}
    }
</script>
