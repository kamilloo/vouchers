<div class="form-group">
    <input type="text" class="form-control" id="title" name="category_title" dusk="category_title" placeholder="{{ __('New Category') }}" value="{{ old('category_title') }}">
    @if($errors->first('category_title'))
    <span>{{ $errors->first('category_title') }}</span>
    @endif
</div>
