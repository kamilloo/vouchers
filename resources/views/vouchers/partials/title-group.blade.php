<div slot="title" class="form-group">
    <label for="title">{{ __('Title') }}</label>
    <input type="text" class="form-control" id="title" name="title" dusk="title" placeholder="{{ __('Title') }}" value="{{ $title }}">
    @if($errors->first('title'))
        <span class="text-danger">{{ $errors->first('title') }}</span>
    @endif
</div>
