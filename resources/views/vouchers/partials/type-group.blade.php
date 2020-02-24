<label slot="type-label" for="type">{{ __('Select Type') }}</label>
<div slot="type-error">
    @if($errors->first('type'))
        <span class="text-danger">{{ $errors->first('type') }}</span>
    @endif
</div>
