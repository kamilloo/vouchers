<div slot="description" class="form-group">
    <label for="description">{{ __('Extra Description') }}</label>
    <input type="text" class="form-control" id="description" name="description" dusk="description" placeholder="{{ __('Extra Description') }}" value="{{ $description }}">
    @if($errors->first('description'))
        <span class="text-danger">{{ $errors->first('description') }}</span>
    @endif
</div>
