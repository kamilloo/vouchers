<div slot="price" class="form-group">
    <label for="price">{{__('Price')}}&nbsp;zł</label>
    <input type="number" class="form-control" id="price" name="price" dusk="price" placeholder="{{__('Price')}}" value="{{ $price }}">
    @if($errors->first('price'))
        <span class="text-danger">{{ $errors->first('price') }}</span>
    @endif
</div>
