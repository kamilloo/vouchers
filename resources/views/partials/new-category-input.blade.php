<div class="form-group">
    @if($service_categories->count())
    <label for="category_title">{{ __('Or add new Categories')}}</label>
    @endif
    <input type="text" class="form-control" id="title" name="category_title" dusk="category_title" placeholder="{{ __('Add new Categories') }}" value="{{ old('category_title') }}">
    @if($errors->first('category_title'))
    <span class="text-danger">{{ $errors->first('category_title') }}</span>
    @endif
</div>
