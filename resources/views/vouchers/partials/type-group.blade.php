<label slot="type-label" for="type">Select Type</label>
<div slot="type-error">
    @if($errors->first('type'))
        <span>{{ $errors->first('type') }}</span>
    @endif
</div>
