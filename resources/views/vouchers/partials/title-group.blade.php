<div slot="title" class="form-group">
    <label for="title">{{ __('Title') }}</label>
    <input type="text" class="form-control" id="title" name="title" dusk="title" placeholder="Title" value="{{ $title }}">
    @if($errors->first('title'))
        <span>{{ $errors->first('title') }}</span>
    @endif
</div>
