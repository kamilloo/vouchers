@extends('profile.layout')


@section('logo')
    <file-upload  file-preview-width="200" file-name="avatar" file-src="{{ $guard->user()->profile->presenter->avatar() }}"></file-upload>
@endsection

@section('form.button')
    <input type="submit" class="profile-edit-btn" name="btnAddMore" value="{{ __('Save') }}"/>
@endsection

@section('about')
    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
        <div class="row input-group mb-3">
            <div class="col-md-4">
                <label>{{ __('Last Name') }}</label>
            </div>
            <div class="col-md-8">
                <input type="text" class="form-control" placeholder="{{ __('Last Name') }}" name="last_name" value="{{ $guard->user()->profile->last_name }}">
            </div>
        </div>
        <div class="row input-group mb-3">
            <div class="col-md-4">
                <label>{{ __('First Name') }}</label>
            </div>
            <div class="col-md-8">
                <input type="text" class="form-control" placeholder="{{ __('First Name') }}" name="first_name" value="{{ $guard->user()->profile->first_name }}">
            </div>
        </div>
        <div class="row input-group mb-3">
            <div class="col-md-4">
                <label for="company_name">{{ __('Company Name') }}</label>
            </div>
            <div class="col-md-8">
                <input type="text" class="form-control" placeholder="{{ __('Company Name') }}" id="company_name" name="company_name" value="{{ $guard->user()->profile->company_name }}">
            </div>
        </div>
        <div class="row input-group mb-3">
            <div class="col-md-4">
                <label for="phone">{{ __('Phone') }}</label>
            </div>
            <div class="col-md-8">
                <input type="text" class="form-control" placeholder="{{ __('Phone') }}" id="phone" name="phone" value="{{ $guard->user()->profile->phone }}">
            </div>
        </div>
        <div class="row input-group mb-3">
            <div class="col-md-4">
                <label for="address">{{ __('Address') }}</label>
            </div>
            <div class="col-md-8">
                <input type="text" id="address" class="form-control" placeholder="{{ __('Address') }}" name="address" value=" {{ $guard->user()->profile->address }}">
            </div>
        </div>
        <div class="row input-group mb-3">
            <div class="col-md-4">
                <label for="postcode">{{ __('Postcode') }}</label>
            </div>
            <div class="col-md-8">
                <input type="text" id="postcode" class="form-control" placeholder="{{ __('Postcode') }}" name="postcode" value=" {{ $guard->user()->profile->postcode }}">
            </div>
        </div>
        <div class="row input-group mb-3">
            <div class="col-md-4">
                <label for="city">{{ __('City') }}</label>
            </div>
            <div class="col-md-8">
                <input type="text" id="city" class="form-control" placeholder="{{ __('City') }}" name="city" value=" {{ $guard->user()->profile->city }}">
            </div>
        </div>
    </div>
    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
        <div class="row input-group mb-3">
            <div class="col-md-4">
                <label for="description">{{ __('Description') }}</label>
            </div>
            <div class="col-md-8">
                    <textarea-with-char-counter
                        value="{{ $guard->user()->profile->description }}"
                        name="description"
                        placeholder="{{ __('Description') }}"
                        max-length-text-helper="{{ __('Max length:') }}"
                        left-text-helper="{{ __('Left:') }}"
                    ></textarea-with-char-counter>
            </div>
        </div>
        <div class="row input-group mb-3">
            <div class="col-md-4">
                <label for="homepage">{{ __('Home Page')}}</label>
            </div>
            <div class="col-md-8">
                <input type="text" id="homepage" class="form-control" placeholder="{{ __('Home Page')}}" name="homepage" value=" {{ $guard->user()->profile->homepage }}">
            </div>
        </div>
        <div class="row input-group mb-3">
            <div class="col-md-4">
                <label for="social_media">{{ __('Social Media')}}</label>
            </div>
            <div class="col-md-8">
                @for($iterator = 0; $iterator < 2; $iterator++)
                <div class="row">
                    <div class="col-5">
                        <select class="form-control" id="social_media" name="social_media[{{$iterator}}][type]" >
                            <option value="">{{ __('Select channel') }}</option>
                            @foreach(config('social-media.list') as $social)
                            <option @if(!empty($guard->user()->profile->social_media) &&  \Illuminate\Support\Arr::has($guard->user()->profile->social_media, $iterator.'.type') && $social == $guard->user()->profile->social_media[$iterator]['type']) selected @endif value="{{ $social }}">{{ $social }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-7">
                        <input type="text" id="social_media" class="form-control" placeholder="{{ __('Address')}}" name="social_media[{{ $iterator }}][page]" value="{{ $guard->user()->profile->social_media[$iterator]['page'] ?? old("social_media[{$iterator}][page]") }}">

                    </div>
                </div>
                @endfor
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
