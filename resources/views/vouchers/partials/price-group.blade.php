<div slot="price" class="form-group">
    <label for="price">Price</label>
    <input type="number" class="form-control" id="price" name="price" dusk="price" placeholder="Price" value="{{ $price }}">
    @if($errors->first('price'))
        <span>{{ $errors->first('price') }}</span>
    @endif
</div>
