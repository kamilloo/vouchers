<add-voucher-service-select slot="service" value="{{ $product_id }}" name="product_id" :products="{{ $services }}" label="{{__('Service')}}">
    <label for="service" slot="label">{{__('Service')}}</label>
    <div slot="error">
        @if($errors->first('product_id'))
            <span class="text-danger">{{ $errors->first('product_id') }}</span>
        @endif
    </div>
</add-voucher-service-select>
